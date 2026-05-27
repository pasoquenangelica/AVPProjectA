<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\UserAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('loginPage');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = UserAccounts::where('username', $credentials['username'])
            ->where('is_active', true)
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()
                ->withErrors(['username' => 'Incorrect credentials. Please try again.'])
                ->onlyInput('username');
        }

        Session::put('logged_id', $user->id);
        Session::put('logged_user', $user->username);
        Session::put('logged_role', $user->role);

        if (in_array($user->role, ['student', 'teacher'], true) && $user->must_change_password) {
            return redirect()
                ->route('password.change.form', ['user' => $user->id])
                ->with('success', 'Successful login. Please change your password first.');
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Successful login.');
    }

    public function dashboard()
    {
        return match (Session::get('logged_role')) {
            'student' => redirect()->route('student.dashboard'),
            'teacher' => redirect()->route('teacher.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('login')->withErrors([
                'username' => 'Your session is invalid. Please log in again.',
            ]),
        };
    }

    public function showChangePasswordForm(Request $request)
    {
        $pendingUserId = $request->query('user');

        if (! $pendingUserId) {
            return redirect()->route('dashboard');
        }

        return view('changePassword')->with('userId', $pendingUserId);
    }

    public function updatePassword(Request $request)
    {
        $pendingUserId = $request->input('user_id');

        if (! $pendingUserId) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|different:current_password|confirmed',
        ]);

        $user = UserAccounts::findOrFail($pendingUserId);

        if (! Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ])->withInput();
        }

        $user->update([
            'password' => Hash::make($validated['new_password']),
            'must_change_password' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Password changed successfully.');
    }

    public function studentDashboard()
    {
        $student = Student::with(['degree', 'userAccount'])
            ->where('user_account_id', Session::get('logged_id'))
            ->first();

        return view('dashboards.student', compact('student'));
    }

    public function teacherDashboard()
    {
        $teacher = Teacher::with('userAccount')
            ->where('user_account_id', Session::get('logged_id'))
            ->first();

        return view('dashboards.teacher', compact('teacher'));
    }

    public function adminDashboard()
    {
        $stats = [
            'students' => Student::count(),
            'teachers' => Teacher::count(),
            'admins' => UserAccounts::where('role', 'admin')->count(),
        ];

        return view('dashboards.admin', compact('stats'));
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
