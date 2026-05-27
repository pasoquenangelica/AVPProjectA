<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #eef4f1; color: #153126; }
        .wrap { max-width: 760px; margin: 0 auto; padding: 40px 20px; }
        .card { background: #fbfffd; border: 1px solid #bcd5ca; border-radius: 18px; padding: 28px; box-shadow: 0 12px 24px rgba(21,49,38,.08); }
        .topbar { display: flex; justify-content: space-between; gap: 16px; align-items: center; margin-bottom: 20px; }
        button { border: 0; border-radius: 10px; padding: 12px 16px; background: #2d6a4f; color: #fff; cursor: pointer; }
        .row { margin: 12px 0; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="topbar">
            <div>
                <h1>Teacher Dashboard</h1>
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
            @if ($teacher)
                <div class="row"><strong>Name:</strong> {{ $teacher->fname }} {{ $teacher->mname }} {{ $teacher->lname }}</div>
                <div class="row"><strong>Contact:</strong> {{ $teacher->contactno }}</div>
                <div class="row"><strong>Email:</strong> {{ $teacher->userAccount?->email }}</div>
                <div class="row"><strong>Role:</strong> Teacher</div>
            @else
                <div class="row">No teacher profile is linked to this account yet.</div>
            @endif
        </div>
    </div>
</body>
</html>
