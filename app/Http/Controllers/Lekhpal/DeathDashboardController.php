<?php

namespace App\Http\Controllers\Lekhpal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeadPerson;
use App\Models\BenificiaryDetails;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DeathDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Current year
        $year = now()->year;

        // Submitted applications (grouped by month)
        $submitted = DB::table('dead_person')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('count', 'month')->toArray();

        // Processed applications (approved/rejected)
        $processed = DB::table('dead_person')
            ->selectRaw('MONTH(updated_at) as month, COUNT(*) as count')
            ->whereYear('updated_at', $year)
            ->whereIn('application_status', ['approved', 'rejected'])
            ->groupBy('month')
            ->pluck('count', 'month')->toArray();

        // Prepare arrays with 12 months
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $submittedData = [];
        $processedData = [];

        for ($i = 1; $i <= 12; $i++) {
            $submittedData[] = $submitted[$i] ?? 0;
            $processedData[] = $processed[$i] ?? 0;
        }
        $deadpersonscount = DeadPerson::with(['benificiaryDetails', 'user'])->count();
        $deadpersoncountpending = DeadPerson::with(['benificiaryDetails', 'user'])->where('application_status', 'pending')->count();
        $deadpersoncountdelayed = DeadPerson::with(['benificiaryDetails', 'user'])
            ->whereDate('created_at', '<=', Carbon::now()->subDays(7))
            ->where('application_status', 'pending')
            ->count();

        $deadpersoncountapproved = DeadPerson::with(['benificiaryDetails', 'user'])->where('application_status', 'approved')->count();
        $stages = [
            ['title' => 'Revenue Inspector', 'column' => 'approved_rejected_by_ri'],
            ['title' => 'Naib Tahsildar', 'column' => 'approved_rejected_by_naibtahsildar'],
            ['title' => 'Tahsildar', 'column' => 'approved_rejected_by_tahsildar'],
            ['title' => 'Sub Divisional Magistrate', 'column' => 'approved_rejected_by_sdm'],
            ['title' => 'Additional District Magistrate', 'column' => 'approved_rejected_by_adm'],
        ];

        $results = [];

        foreach ($stages as $index => $stage) {
            $pending = DB::table('dead_person')
                ->where($stage['column'], 0)
                ->count();

            $delayed = DB::table('dead_person')
                ->where($stage['column'], 0)
                ->whereRaw('DATEDIFF(NOW(), created_at) > 5') // assuming 5+ days = delayed
                ->count();

            $averageDays = DB::table(table: 'dead_person')
                ->where($stage['column'], '!=', 0)
                ->selectRaw('AVG(DATEDIFF(updated_at, created_at)) as avg_days')
                ->value('avg_days');

            $results[] = [
                'index' => $index + 1,
                'title' => $stage['title'],
                'average' => round($averageDays ?? 0, 1),
                'pending' => $pending,
                'delayed' => $delayed,
            ];
        }
        // This method can be used to return the main dashboard view for the Lekhpal Death section
        return view('lekhpal.deathSection.death_dashboard', compact('months', 'submittedData', 'processedData', 'deadpersoncountapproved', 'deadpersoncountdelayed', 'deadpersonscount', 'deadpersoncountpending', 'results'));
    }


    public function deathForm()
    {
        $districts = DB::table('district_master')->orderBy('dist_name')->get();
        return view('lekhpal.deathSection.deathForm', compact('districts'));
    }

    public function getTehsilsByDistrictCode($district_code)
    {
        $tehsils = DB::table('tehsil_master')
            ->where('district_code', $district_code)
            ->orderBy('tehsil_name')
            ->get(['tehsil_code', 'tehsil_name']);

        return response()->json($tehsils);
    }

    public function getBlockByTehsilCode($tehsil_code)
    {
        $blocks = DB::table('block_master')
            ->where('tehsil_code', $tehsil_code)
            ->orderBy('block_name')
            ->get(['id', 'block_name']);
        return response()->json($blocks);
    }

    public function deathForm_store(Request $request)
    {
        $request->validate([
            'area_type' => 'required|string',
            'name' => 'required|string|max:255',
            'guardian_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'death_date' => 'required|date',
            'death_time' => 'required|date_format:H:i',
            'age' => 'required|numeric',
            'cause_of_death' => 'required|string',
            'disaster_type' => 'required|string',
            'disaster_date' => 'required|date',
            'resident' => 'required|string',
            'state' => 'nullable|string',
            'dead_person_district' => 'nullable|string',
            'dead_person_area_type' => 'nullable|string',
            'dead_person_tehsil' => 'required',
            'pin_code' => 'required',
            'block_id' => 'nullable|string',
            'address' => 'required|string|max:500',
            'dead_person_pic' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // ✅ Combine date and time into one Carbon instance
        $deathDateTime = Carbon::parse($request->death_date . ' ' . $request->death_time);
        $now = Carbon::now();

        // ✅ Calculate time difference in hours
        $diffInHours = $now->diffInHours($deathDateTime, false); // false for signed difference

        // ✅ Handle based on time difference
        if ($diffInHours < -48) {
            return redirect()->back()->with('error', 'मृत्यु की तिथि 48 घंटे से अधिक पुरानी है। कृपया RC ऑफिस से अनुमोदन के बाद ही इसे अपलोड करें।');
        } elseif ($diffInHours < -24) {
            return redirect()->back()->with('error', 'मृत्यु की तिथि 24 घंटे से अधिक पुरानी है। कृपया SDM से अनुमोदन के बाद ही इसे अपलोड करें।');
        }

        // ✅ Upload file if exists
        $deadPersonPicPath = $request->hasFile('dead_person_pic')
            ? $request->file('dead_person_pic')->store('dead_person_pics', 'public')
            : null;

        // ✅ Save record
        $deadPerson = new DeadPerson();
        $deadPerson->area_type = $request->area_type;
        $deadPerson->name = $request->name;
        $deadPerson->guardian_name = $request->guardian_name;
        $deadPerson->gender = $request->gender;
        $deadPerson->death_date = $request->death_date;
        $deadPerson->death_time = $request->death_time;
        $deadPerson->age = $request->age;
        $deadPerson->cause_of_death = $request->cause_of_death;
        $deadPerson->disaster_type = $request->disaster_type;
        $deadPerson->disaster_date = $request->disaster_date;
        $deadPerson->resident = $request->resident;
        $deadPerson->state = $request->state;
        $deadPerson->district_id = $request->dead_person_district;
        $deadPerson->dead_person_area_type = $request->dead_person_area_type;
        $deadPerson->tahsil_id = $request->dead_person_tehsil;
        $deadPerson->pin_code = $request->pin_code;
        $deadPerson->block_id = $request->block_id;
        $deadPerson->address = $request->address;
        $deadPerson->dead_person_pic = $deadPersonPicPath;
        $deadPerson->added_by = auth()->user()->id ?? 0;

        $deadPerson->save();

        $applicationNo = 'APP' . str_pad($deadPerson->id, 8, '0', STR_PAD_LEFT);

        DeadPerson::where('id', $deadPerson->id)->update([
            'application_no' => $applicationNo,
        ]);
        return redirect()->route('lekhpal.death.form.benificiary', $deadPerson->id)->with('success', 'Death person information first stage saved!.');
    }

    public function benificiaryForm($id)
    {
        $deadperson = DeadPerson::where('id', $id)->get();
        return view('lekhpal.deathSection.benificiary_form', compact('deadperson', 'id'));
    }

    public function storeBenificiaryDetails(Request $request)
    {
        // ✅ Validate only fields present in the form
        $request->validate([
            'disaster_t' => 'required',
            'relief_grant' => 'required',
            'relief_type' => 'required|string',
            'grants_type' => 'required|string',
            'death_person_id' => 'required|max:255',
            'aadhaar_no' => 'nullable|string|max:20',
            'beneficiary_name' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'father_husb_name' => 'required|string',
            'age' => 'required|integer|min:0|max:120',
            'mobile' => 'required|max:15',
            'residency' => 'required|in:yes,no',
            'address' => 'required|string',
            'district' => 'required|string',
            'bank_name' => 'required|string',
            'branch' => 'required|string',
            'account_number' => 'required|string',
            'account_holder_name' => 'required|string',
            'ifsc' => 'required|string',
            'upload_bank_passbook' => 'required|file|mimes:jpg|max:2048',
            'panchnama_report' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'postmortem_report' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // ✅ Handle file uploads
        $passbookPath = $request->file('upload_bank_passbook')->store('bank_passbooks', 'public');
        $panchnamaPath = $request->file('panchnama_report')->store('panchnama_reports', 'public');
        $postmortemPath = $request->file('postmortem_report')->store('postmortem_reports', 'public');

        // ✅ Save to database
        BenificiaryDetails::create([
            'disaster_t' => $request->disaster_t,
            'relief_grant' => $request->relief_grant,
            'relief_type' => $request->relief_type,
            'grants_type' => $request->grants_type,
            'death_person_id' => $request->death_person_id,
            'aadhaar_no' => $request->aadhaar_no,
            'beneficiary_name' => $request->beneficiary_name,
            'gender' => $request->gender,
            'father_husb_name' => $request->father_husb_name,
            'age' => $request->age,
            'mobile' => $request->mobile,
            'residency' => $request->residency === 'yes' ? 1 : 0,
            'address' => $request->address,
            'district' => $request->district,
            'bank_name' => $request->bank_name,
            'branch' => $request->branch,
            'account_number' => $request->account_number,
            'account_holder_name' => $request->account_holder_name,
            'ifsc' => $request->ifsc,
            'upload_bank_passbook' => $passbookPath,
            'panchnama_report' => $panchnamaPath,
            'postmortem_report' => $postmortemPath,
        ]);

        return redirect()->back()->with('success', 'Record submitted successfully.');
    }

    public function allDeathApplications()
    {
        $deadpersondetails = DeadPerson::with(['benificiaryDetails', 'user'])->orderBy('id', 'desc')->get();
        return view('lekhpal.deathSection.applications', compact('deadpersondetails'));
    }

    public function approvedDeathApplications()
    {
        $deadpersondetails = DeadPerson::with(['benificiaryDetails', 'user'])->where('application_status', 'approved')->get();
        return view('lekhpal.deathSection.approved_applications', compact('deadpersondetails'));
    }

    public function pendingDeathApplications()
    {
        $deadpersondetails = DeadPerson::with(['benificiaryDetails', 'user'])->where('application_status', 'pending')->get();
        return view('lekhpal.deathSection.pending_applications', compact('deadpersondetails'));
    }

    public function delayedDeathApplications()
    {
        $deadpersondetails = DeadPerson::with(['benificiaryDetails', 'user'])
            ->whereDate('created_at', '<=', Carbon::now()->subDays(7))
            ->where('application_status', 'pending')
            ->get();
        return view('lekhpal.deathSection.delayed_applications', compact('deadpersondetails'));
    }
    public function rejectDeathApplications()
    {
        $deadpersondetails = DeadPerson::with(['benificiaryDetails', 'user'])->where('application_status', 'rejected')->get();
        return view('lekhpal.deathSection.reject_application', compact('deadpersondetails'));
    }

    public function stagePerformanceChart()
    {
        $stages = [
            'RI' => 'approved_rejected_by_ri',
            'Naib Tahsildar' => 'approved_rejected_by_naibtahsildar',
            'Tahsildar' => 'approved_rejected_by_tahsildar',
            'SDM' => 'approved_rejected_by_sdm',
            'ADM' => 'approved_rejected_by_adm',
        ];

        $performance = [];
        $target = [];

        foreach ($stages as $stage => $column) {
            // ✅ Fix: use whereNotNull
            $totalReceived = DB::table('dead_person')->whereNotNull($column)->count();
            $processed = DB::table('dead_person')->whereIn($column, [1, 2])->count(); // approved + rejected

            $percent = ($totalReceived > 0) ? round(($processed / $totalReceived) * 100) : 0;

            $performance[] = $percent;
            $target[] = 90; // fixed target
        }
        return response()->json([
            'labels' => array_keys($stages),
            'performance' => $performance,
            'target' => $target,
        ]);
    }

    public function dailyDelayBreakdown()
    {
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        // Initialize counters
        $minor = array_fill(0, 7, 0);
        $moderate = array_fill(0, 7, 0);
        $major = array_fill(0, 7, 0);

        $applications = DB::table('dead_person')
            ->select('id', 'created_at', 'updated_at')
            ->get();

        foreach ($applications as $app) {
            $created = Carbon::parse($app->created_at);
            $updated = Carbon::parse($app->updated_at);
            $delay = $created->diffInDays($updated);

            $dayIndex = $created->dayOfWeekIso - 1; // Monday = 0, Sunday = 6

            if ($delay <= 2) {
                $minor[$dayIndex]++;
            } elseif ($delay <= 5) {
                $moderate[$dayIndex]++;
            } else {
                $major[$dayIndex]++;
            }
        }

        return response()->json([
            'labels' => $days,
            'minor' => $minor,
            'moderate' => $moderate,
            'major' => $major,
        ]);
    }

    public function stagePerformanceMetrics()
    {
        $stages = [
            'Revenue Inspector' => 'approved_rejected_by_ri',
            'Naib Tahsildar' => 'approved_rejected_by_naibtahsildar',
            'Tahsildar' => 'approved_rejected_by_tahsildar',
            'SDM' => 'approved_rejected_by_sdm',
            'ADM' => 'approved_rejected_by_adm',
        ];

        $labels = [];
        $pending = [];
        $delayed = [];

        foreach ($stages as $stage => $column) {
            $labels[] = $stage;

            if ($column === null) {
                // Lekhpal special logic
                $pendingCount = DB::table('dead_person')
                    ->whereNull('approved_rejected_by_ri') // not moved to RI
                    ->count();

                $delayedCount = DB::table('dead_person')
                    ->whereNull('approved_rejected_by_ri')
                    ->whereRaw('DATEDIFF(NOW(), created_at) > 5')
                    ->count();
            } else {
                $pendingCount = DB::table('dead_person')
                    ->where($column, 0)
                    ->count();

                $delayedCount = DB::table('dead_person')
                    ->where($column, 0)
                    ->whereRaw('DATEDIFF(NOW(), created_at) > 5')
                    ->count();
            }

            $pending[] = $pendingCount;
            $delayed[] = $delayedCount;
        }

        return response()->json([
            'labels' => $labels,
            'pending' => $pending,
            'delayed' => $delayed,
        ]);
    }

    public function weeklyDelayTrend()
    {
        $weeks = [];
        $delayCounts = [];

        $startOfWeek = Carbon::now()->startOfMonth()->startOfWeek();
        $endOfMonth = Carbon::now()->endOfMonth();

        for ($i = 0; $i < 6; $i++) {
            $weekStart = $startOfWeek->copy()->addWeeks($i);
            $weekEnd = $weekStart->copy()->endOfWeek();

            if ($weekStart > $endOfMonth) break;

            $weeks[] = 'Week ' . ($i + 1);

            $count = DB::table('dead_person')
                ->whereDate('created_at', '>=', $weekStart)
                ->whereDate('created_at', '<=', $weekEnd)
                ->whereRaw("DATEDIFF(NOW(), created_at) > 5") // delay logic
                ->count();

            $delayCounts[] = $count;
        }

        return response()->json([
            'labels' => $weeks,
            'data' => $delayCounts,
        ]);
    }

    public function delaySummary()
    {
        $now = \Carbon\Carbon::now();

        $critical = DB::table('dead_person')
            ->whereRaw("DATEDIFF(?, created_at) > 15", [$now])
            ->count();

        $moderate = DB::table('dead_person')
            ->whereRaw("DATEDIFF(?, created_at) BETWEEN 8 AND 15", [$now])
            ->count();

        $minor = DB::table('dead_person')
            ->whereRaw("DATEDIFF(?, created_at) BETWEEN 3 AND 7", [$now])
            ->count();
        return response()->json([
            'critical' => $critical,
            'moderate' => $moderate,
            'minor' => $minor,
        ]);
    }
}
