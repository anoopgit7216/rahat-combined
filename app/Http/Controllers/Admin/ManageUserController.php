<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Hash;
use DB;
use Illuminate\Support\Facades\Log;
use App\Models\Role;

class ManageUserController extends Controller
{
    public function index()
    {
        // Logic to fetch and display users
        // $users = User::where('status', 1)->get();
        $users = User::with('role')->where('status', 1)->get();
        return view('admin.manage_user.index', compact('users'));
    }

    public function create()
    {
        $districts = DB::table('district_master')->orderBy('dist_name')->get();
        $roles = Role::pluck('name', 'id'); // id => name
        return view('admin.manage_user.create', compact('roles', 'districts'));
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

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:6|confirmed',
            'role'        => 'required|exists:roles,id',
            'district_id' => 'required',
            'tehsil_id'   => 'required',
            'block_id'    => 'required',
        ]);

        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'district_id' => $request->district_id,
            'tehsil_id'   => $request->tehsil_id,
            'block_id'    => $request->block_id,
            'password'    => Hash::make($request->password),
            'role_id'     => $request->role,
        ]);

        return redirect()->route('admin.manage_users.index')->with('success', 'User created successfully with role.');
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        $districts = DB::table('district_master')->orderBy('dist_name')->get();
        $tehsils = DB::table('tehsil_master')->where('district_code', $user->district_id)->get();
        $blocks = DB::table('block_master')->where('tehsil_code', $user->tehsil_id)->get();

        return view('admin.manage_user.edit', compact('user', 'roles', 'districts', 'tehsils', 'blocks'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,id', // validates based on ID now
            'password' => 'nullable|string|confirmed|min:8',
        ]);

        try {
            $user->name = $validated['name'];
            $user->email = $validated['email'];

            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->role_id = $validated['role']; // custom role assign
            $user->save();

            return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            Log::error('User update failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong.']);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.manage_users.index')->with('success', 'User deleted successfully.');
    }
}
