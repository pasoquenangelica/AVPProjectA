<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\UserAccounts;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function userProfile()
    {
        $userId = Session::get('logged_id');
        $account = UserAccounts::findOrFail($userId);
        $student = Student::with('degree')
            ->where('user_account_id', $userId)
            ->first();
        $teacher = Teacher::where('user_account_id', $userId)->first();

        return view('pages.user-profile', compact('account', 'student', 'teacher'));
    }

    public function userPost()
    {
        return redirect()
            ->route('dashboard')
            ->with('success', 'The posting module is not configured for this deployment.');
    }

    public function studentCourses()
    {
        return redirect()
            ->route('dashboard')
            ->with('success', 'The course enrollment module is not configured for this deployment.');
    }

    public function maintenance()
    {
        return view('maintenance');
    }
}
