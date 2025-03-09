<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function manageAdmins()
    {
        $who = 'Admins';
        $users = User::where('role', 'admin')->paginate(5);
        return view('superadmin.manage-users.index', compact('users', 'who'));
    }
    public function manageDoctors()
    {
        $who = 'Doctors';
        $users = User::where('role', 'doctor')->paginate(5);   
        return view('admin.manage-users.index', compact('users', 'who'));
    }

    public function managePatients()
    {
        $who = 'Patients';
        $users = User::where('role', 'patient')->paginate(5);
        return view('admin.manage-users.index', compact('users', 'who'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $userRole = $user->role;
        if($userRole == 'patient') {
            $redirectUrl = 'admin.manage-users.patients';
        }else{
            $redirectUrl = 'admin.manage-users.doctors';
        }

        if($redirectUrl == 'admin.manage-users.patients') {
            $userType = 'Patients';
        }else{
            $userType = 'Doctors';
        }

        return view('admin.manage-users.edit', compact('user', 'userType', 'redirectUrl'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $userRole = $user->role;
        if($userRole == 'patient') {
            $redirectUrl = 'admin.manage-users.patients';
        }else{
            $redirectUrl = 'admin.manage-users.doctors';
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' => ['required', 'string', 'in:patient,doctor', 'max:255'],
        ]);
        $user->update($validated);
        return redirect()->route($redirectUrl)->with('success', 'User updated successfully');
    }
}
