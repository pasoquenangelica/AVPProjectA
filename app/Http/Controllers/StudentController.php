<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Student;
use App\Models\UserAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::with(['degree', 'userAccount'])->orderBy('lname')->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'html' => view('students.partials.table', compact('students'))->render(),
            ]);
        }

        return view('students.index', compact('students'));
    }

    public function create()
    {
        $degrees = Degree::orderBy('degree_title')->get();

        return view('students.create', compact('degrees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|min:2|max:255',
            'lname' => 'required|string|min:2|max:255',
            'mname' => 'nullable|string|min:2|max:255',
            'contactno' => 'required|digits:11',
            'degree_id' => 'required|exists:degrees,id',
            'email' => 'required|email|unique:user_accounts,email',
            'username' => 'required|string|max:255|unique:user_accounts,username',
            'password' => 'required|string|min:8',
        ]);

        $user = UserAccounts::create([
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'is_active' => true,
            'must_change_password' => true,
        ]);

        $student = Student::create([
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'mname' => $validated['mname'] ?? null,
            'contactno' => $validated['contactno'],
            'degree_id' => $validated['degree_id'],
            'user_account_id' => $user->id,
        ]);

        Log::info('Student created.', ['student_id' => $student->id]);

        if (! $request->expectsJson()) {
            return redirect()
                ->route('students.index')
                ->with('success', 'Student added successfully.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Student added successfully.',
            'student' => $student->load(['degree', 'userAccount']),
            'redirect' => route('students.index'),
        ]);
    }

    public function show(Request $request, string $id)
    {
        $student = Student::with(['degree', 'userAccount'])->findOrFail($id);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'title' => trim($student->fname . ' ' . $student->lname),
                'html' => view('students.partials.details', compact('student'))->render(),
            ]);
        }

        return view('students.show', compact('student'));
    }

    public function edit(string $id)
    {
        $student = Student::with('userAccount')->findOrFail($id);
        $degrees = Degree::orderBy('degree_title')->get();

        return view('students.edit', compact('student', 'degrees'));
    }

    public function update(Request $request, string $id)
    {
        $student = Student::with('userAccount')->findOrFail($id);

        $validated = $request->validate([
            'fname' => 'required|string|min:2|max:255',
            'lname' => 'required|string|min:2|max:255',
            'mname' => 'nullable|string|min:2|max:255',
            'contactno' => 'required|digits:11',
            'degree_id' => 'required|exists:degrees,id',
            'email' => 'required|email|unique:user_accounts,email,' . $student->user_account_id,
            'username' => 'required|string|max:255|unique:user_accounts,username,' . $student->user_account_id,
            'password' => 'nullable|string|min:8',
        ]);

        $student->update([
            'fname' => $validated['fname'],
            'mname' => $validated['mname'] ?? null,
            'lname' => $validated['lname'],
            'contactno' => $validated['contactno'],
            'degree_id' => $validated['degree_id'],
        ]);

        if ($student->userAccount) {
            $accountPayload = [
                'email' => $validated['email'],
                'username' => $validated['username'],
            ];

            if (filled($validated['password'] ?? null)) {
                $accountPayload['password'] = Hash::make($validated['password']);
            }

            $student->userAccount->update($accountPayload);
        }

        Log::info('Student updated.', ['student_id' => $student->id]);

        if (! $request->expectsJson()) {
            return redirect()
                ->route('students.index')
                ->with('success', 'Student updated successfully.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully.',
            'student' => $student->load(['degree', 'userAccount']),
            'redirect' => route('students.index'),
        ]);
    }

    public function destroy(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $userAccountId = $student->user_account_id;

        $student->delete();

        if ($userAccountId) {
            UserAccounts::whereKey($userAccountId)->delete();
        }

        Log::info('Student deleted.', ['student_id' => $id]);

        if (! $request->expectsJson()) {
            return redirect()
                ->route('students.index')
                ->with('success', 'Student deleted successfully.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully.',
        ]);
    }
}
