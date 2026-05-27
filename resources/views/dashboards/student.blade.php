<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #fff8db; color: #3d3200; }
        .wrap { max-width: 760px; margin: 0 auto; padding: 40px 20px; }
        .card { background: #fffdf2; border: 1px solid #f0d36a; border-radius: 18px; padding: 28px; box-shadow: 0 12px 24px rgba(138,106,0,.12); }
        .topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; }
        button { border: 0; border-radius: 10px; padding: 12px 16px; background: #c89c12; color: #fff; cursor: pointer; }
        .row { margin: 12px 0; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="topbar">
            <div>
                <h1>Student Dashboard</h1>
                <p>Welcome back, {{ session('logged_user') }}.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
        <div class="card">
            @if (session('success'))
                <div class="row">{{ session('success') }}</div>
            @endif
            @if ($student)
                <div class="row"><strong>Name:</strong> {{ $student->fname }} {{ $student->mname }} {{ $student->lname }}</div>
                <div class="row"><strong>Contact:</strong> {{ $student->contactno }}</div>
                <div class="row"><strong>Degree:</strong> {{ $student->degree?->degree_title ?? 'Not assigned' }}</div>
                <div class="row"><strong>Email:</strong> {{ $student->userAccount?->email }}</div>
            @else
                <div class="row">No student profile is linked to this account yet.</div>
            @endif
        </div>
    </div>
</body>
</html>
