<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\UserAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('userAccount')->orderBy('lname')->paginate(10);

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|min:2|max:255',
            'lname' => 'required|string|min:2|max:255',
            'mname' => 'nullable|string|min:2|max:255',
            'contactno' => 'required|digits:11',
            'email' => 'required|email|unique:user_accounts,email',
            'username' => 'required|string|max:255|unique:user_accounts,username',
            'password' => 'required|string|min:8',
        ]);

        $userAccount = UserAccounts::create([
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'teacher',
            'is_active' => true,
            'must_change_password' => false,
        ]);

        Teacher::create([
            'fname' => $validated['fname'],
            'mname' => $validated['mname'] ?? null,
            'lname' => $validated['lname'],
            'contactno' => $validated['contactno'],
            'user_account_id' => $userAccount->id,
        ]);

        Log::info('Teacher created.', ['username' => $userAccount->username]);

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function show(string $id)
    {
        $teacher = Teacher::with('userAccount')->findOrFail($id);

        return view('teachers.show', compact('teacher'));
    }

    public function edit(string $id)
    {
        $teacher = Teacher::with('userAccount')->findOrFail($id);

        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, string $id)
    {
        $teacher = Teacher::with('userAccount')->findOrFail($id);

        $validated = $request->validate([
            'fname' => 'required|string|min:2|max:255',
            'lname' => 'required|string|min:2|max:255',
            'mname' => 'nullable|string|min:2|max:255',
            'contactno' => 'required|digits:11',
            'email' => 'required|email|unique:user_accounts,email,' . $teacher->user_account_id,
            'username' => 'required|string|max:255|unique:user_accounts,username,' . $teacher->user_account_id,
            'password' => 'nullable|string|min:8',
        ]);

        $teacher->update([
            'fname' => $validated['fname'],
            'mname' => $validated['mname'] ?? null,
            'lname' => $validated['lname'],
            'contactno' => $validated['contactno'],
        ]);

        $teacher->userAccount->update([
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => filled($validated['password'] ?? null)
                ? Hash::make($validated['password'])
                : $teacher->userAccount->password,
        ]);

        Log::info('Teacher updated.', ['teacher_id' => $teacher->id]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $userAccountId = $teacher->user_account_id;

        $teacher->delete();
        UserAccounts::whereKey($userAccountId)->delete();

        Log::info('Teacher deleted.', ['teacher_id' => $id]);

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
