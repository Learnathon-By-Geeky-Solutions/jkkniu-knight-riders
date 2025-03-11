<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class SuperAdminController extends Controller
{
    public function manageAdmins()
    {
        $who = 'Admins';
        $users = User::where('role', 'admin')->paginate(5);
        return view('backend.superadmin.manage-users.index', compact('users', 'who'));
    }

    public function manageDoctors()
    {
        $who = 'Doctors';
        $users = User::where('role', 'doctor')->paginate(5);   
        return view('backend.superadmin.manage-users.index', compact('users', 'who'));
    }

    public function managePatients()
    {
        $who = 'Patients';
        $users = User::where('role', 'patient')->paginate(5);
        return view('backend.superadmin.manage-users.index', compact('users', 'who'));
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $userRole = $user->role;
        if($userRole == 'patient') {
            $redirectUrl = 'superadmin.manage-users.patients';
        }elseif($userRole == 'doctor') {
            $redirectUrl = 'superadmin.manage-users.doctors';
        }else{
            $redirectUrl = 'superadmin.manage-users.admins';
        }

        if($redirectUrl == 'superadmin.manage-users.patients') {
            $userType = 'Patients';
        }else if($redirectUrl == 'superadmin.manage-users.doctors'){
            $userType = 'Doctors';
        }else{
            $userType = 'Admins';
        }

        return view('backend.superadmin.manage-users.edit', compact('user', 'userType', 'redirectUrl'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $userRole = $user->role;
        if($userRole == 'patient') {
            $redirectUrl = 'superadmin.manage-users.patients';
        }else if($userRole == 'doctor') {
            $redirectUrl = 'superadmin.manage-users.doctors';
        }else{
            $redirectUrl = 'superadmin.manage-users.admins';
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', 'string', 'in:patient,doctor,admin', 'max:255'],
        ]);
        $user->update($validated);
        return redirect()->route($redirectUrl)->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
