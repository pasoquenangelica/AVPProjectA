<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f5efe4; color: #2f2214; }
        .wrap { max-width: 760px; margin: 0 auto; padding: 32px 20px; }
        .card { background: #fffaf2; border: 1px solid #dbc7aa; border-radius: 18px; padding: 24px; box-shadow: 0 12px 24px rgba(47, 34, 20, 0.08); }
        .topbar { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 20px; }
        .row { margin: 12px 0; }
        a, button { border: 0; border-radius: 10px; padding: 12px 16px; background: #9a5b2e; color: #fff; text-decoration: none; cursor: pointer; }
        .ghost { background: #eadbc7; color: #53341d; }
        form { margin: 0; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="topbar">
            <div>
                <h1>User Profile</h1>
                <p>Account overview for {{ $account->username }}.</p>
            </div>
            <div>
                <a class="ghost" href="{{ route('dashboard') }}">Back to Dashboard</a>
            </div>
        </div>

        <div class="card">
            <div class="row"><strong>Username:</strong> {{ $account->username }}</div>
            <div class="row"><strong>Email:</strong> {{ $account->email }}</div>
            <div class="row"><strong>Role:</strong> {{ ucfirst($account->role) }}</div>
            <div class="row"><strong>Status:</strong> {{ $account->is_active ? 'Active' : 'Inactive' }}</div>

            @if ($student)
                <hr>
                <div class="row"><strong>Student Name:</strong> {{ $student->fname }} {{ $student->mname }} {{ $student->lname }}</div>
                <div class="row"><strong>Contact:</strong> {{ $student->contactno }}</div>
                <div class="row"><strong>Degree:</strong> {{ $student->degree?->degree_title ?? 'Not assigned' }}</div>
            @endif

            @if ($teacher)
                <hr>
                <div class="row"><strong>Teacher Name:</strong> {{ $teacher->fname }} {{ $teacher->mname }} {{ $teacher->lname }}</div>
                <div class="row"><strong>Contact:</strong> {{ $teacher->contactno }}</div>
            @endif
        </div>
    </div>
</body>
</html>
