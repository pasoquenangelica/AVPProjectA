<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4efe6; color: #2d1f12; }
        .wrap { max-width: 1080px; margin: 0 auto; padding: 32px 20px 48px; }
        .topbar, .grid, .links { display: grid; gap: 16px; }
        .topbar { grid-template-columns: 1fr auto; align-items: center; margin-bottom: 24px; }
        .card, .hero { background: #fffaf2; border: 1px solid #dcc7ab; border-radius: 18px; padding: 24px; }
        .hero { margin-bottom: 24px; }
        .grid { grid-template-columns: repeat(3, minmax(0, 1fr)); margin-bottom: 24px; }
        .links { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        a, button { display: inline-block; text-decoration: none; border: 0; border-radius: 10px; padding: 12px 16px; background: #9a5b2e; color: #fff; cursor: pointer; }
        .ghost { background: #ead9c2; color: #53341d; }
        .count { font-size: 36px; font-weight: bold; margin-top: 8px; }
        form { margin: 0; }
        @media (max-width: 768px) { .grid, .links, .topbar { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="topbar">
            <div>
                <h1>Admin Dashboard</h1>
                <p>Manage system users and academic records.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="ghost">Logout</button>
            </form>
        </div>

        @if (session('success'))
            <div class="hero">{{ session('success') }}</div>
        @endif

        <div class="hero">
            <strong>Welcome, {{ session('logged_user') }}</strong>
            <p>Use the links below to manage students, teachers, and degrees.</p>
        </div>

        <div class="grid">
            <div class="card"><div>Students</div><div class="count">{{ $stats['students'] }}</div></div>
            <div class="card"><div>Teachers</div><div class="count">{{ $stats['teachers'] }}</div></div>
            <div class="card"><div>Admins</div><div class="count">{{ $stats['admins'] }}</div></div>
        </div>

        <div class="links">
            <div class="card"><h3>Students</h3><p>Add, edit, and review student accounts.</p><a href="{{ route('students.index') }}">Open Students</a></div>
            <div class="card"><h3>Teachers</h3><p>Add, edit, and review teacher accounts.</p><a href="{{ route('teachers.index') }}">Open Teachers</a></div>
            <div class="card"><h3>Degrees</h3><p>Maintain available degree programs.</p><a href="{{ route('degree.index') }}">Open Degrees</a></div>
        </div>
    </div>
</body>
</html>
