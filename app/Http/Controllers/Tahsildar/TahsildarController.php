<?php

namespace App\Http\Controllers\Tahsildar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeadPerson;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TahsildarController extends Controller
{
    public function index()
    {
        return view('tahsildar.tahsildar_dashboard');
    }
    public function ahaitukDashboard()
    {
        return view('tahsildar.ahaituk_dashboard');
    }
    public function revanueInspectorDashboard()
    {
        $deadpersonscount = DeadPerson::with(['benificiaryDetails', 'user'])->count();
        $deadpersoncountpending = DeadPerson::with(['benificiaryDetails', 'user'])->where('application_status', 'pending')->count();
        $deadpersoncountdelayed = DeadPerson::with(['benificiaryDetails', 'user'])
            ->whereDate('created_at', '<=', Carbon::now()->subDays(7))
            ->where('application_status', 'pending')
            ->count();

        $deadpersoncountapproved = DeadPerson::with(['benificiaryDetails', 'user'])->where('application_status', 'approved')->count();
        return view('tahsildar.deathSection.death_dashboard', compact('deadpersoncountapproved', 'deadpersoncountdelayed', 'deadpersonscount', 'deadpersoncountpending'));
    }


    public function allDeathApplications()
    {
        $user = Auth::user();
        $roleId = $user->role_id;

        $roleName = DB::table('roles')->where('id', $roleId)->value('name');

        $query = DB::table('dead_person as dead')
            ->leftJoin('users as u', 'dead.added_by', '=', 'u.id')
            ->select('dead.*', 'u.name as lekhpal_name', 'u.email')
            ->where('dead.approved_rejected_by_ri', 1)
            ->where('dead.approved_rejected_by_naibtahsildar', 1) 
            ->whereIn('dead.approved_rejected_by_tahsildar',[0,1,2]) 
            ->orderByDesc('dead.id');

        $deadpersondetails = $query->get();

        return view('tahsildar.deathSection.applications', compact('deadpersondetails', 'roleName'));
    }


    public function updateStatusByTahsildar(Request $request)
    {
        $request->validate([
            'application_no' => 'required|exists:dead_person,application_no',
            'status' => 'required|in:approved,rejected',
            'remark' => 'required|string|max:500',
        ]);

        $deadPerson = DB::table('dead_person')
            ->where('application_no', $request->application_no)
            ->first();

        if (!$deadPerson) {
            return redirect()->back()->with('error', 'Application not found.');
        }

        $userId = Auth::id();
        $roleId = Auth::user()->role_id;

        $roleName = DB::table('roles')->where('id', $roleId)->value('name');

        $roleColumnMap = [
            'Revenue Inspector'                  => 'approved_rejected_by_ri',
            'Naib Tahsildar'                     => 'approved_rejected_by_naibtahsildar',
            'Tahsildar'                          => 'approved_rejected_by_tahsildar',
            'Sub Divisional Magistrate'          => 'approved_rejected_by_sdm',
            'Additional District Magistrate'     => 'approved_rejected_by_adm',
        ];

        $statusColumn = $roleColumnMap[$roleName] ?? null;

        if (!$statusColumn) {
            return redirect()->back()->with('error', 'Role not authorized to update status.');
        }

        $updateArray = [
            'application_status' => $request->status,
            'updated_at'         => now(),
            $statusColumn        => $request->status === 'approved' ? 1 : 2,
        ];

        DB::table('dead_person')
            ->where('id', $deadPerson->id)
            ->update($updateArray);

        DB::table('death_person_status_records')->insert([
            'death_person_id'   => $deadPerson->id,
            'status'            => $request->status,
            'remark'            => $request->remark,
            'created_by'        => $userId,
            'created_by_role'   => $roleName,
            'created_at'        => now(),
        ]);

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }
}
