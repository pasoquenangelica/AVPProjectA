<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Students</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body{font-family:Arial,sans-serif;margin:0;background:#f7f3ed;color:#2b2118}
        .wrap{max-width:1100px;margin:0 auto;padding:32px 20px}
        .top{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:20px}
        .card{background:#fff;border:1px solid #ddcfbf;border-radius:16px;padding:24px}
        .actions{display:flex;gap:8px;flex-wrap:wrap}
        a,button{border:0;border-radius:10px;padding:10px 14px;background:#8a5a2b;color:#fff;text-decoration:none;cursor:pointer}
        .inline-form{display:inline-flex;margin:0}
        .inline-form button{width:100%}
        .card table .actions{min-width:220px;align-items:flex-start}
        table{width:100%;border-collapse:collapse}
        th,td{padding:12px;border-bottom:1px solid #eadfce;text-align:left}
        .muted{background:#d9c1a6;color:#412811}
        .danger{background:#a33f2f}
        .alert{padding:12px 14px;border-radius:10px;margin-bottom:16px}
        .alert-success{background:#e4f4e8;color:#1d5a2c}
        .alert-danger{background:#fde5e1;color:#8a2d20}
        .details-card{margin-top:20px;display:none}
        .row{margin:12px 0}
        .pagination-wrap{margin-top:16px}
        .pagination{display:flex;gap:8px;flex-wrap:wrap;padding-left:0;list-style:none}
        .pagination li{display:inline-block}
        .pagination a,.pagination span{display:inline-block;padding:8px 12px;border-radius:8px;border:1px solid #ddcfbf;color:#412811;text-decoration:none;background:#fff}
        .pagination .active span{background:#8a5a2b;color:#fff;border-color:#8a5a2b}
        @media(max-width:840px){.top{align-items:flex-start;flex-direction:column}.card{overflow-x:auto}}
        @media(max-width:640px){.card table .actions{min-width:unset;flex-direction:column}.card table .actions a,.card table .actions button,.inline-form{width:100%}}
    </style>
</head>
<body data-page="students-index">
    <div class="wrap">
        <div class="top">
            <div>
                <h1>Students</h1>
                <p>Admin management for student accounts.</p>
            </div>
            <div class="actions">
                <a href="{{ route('admin.dashboard') }}" class="muted">Dashboard</a>
                <a href="{{ route('students.create') }}">Add Student</a>
            </div>
        </div>

        <div id="message">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>

        <div class="card">
            <div id="studentsTableRegion">
                @include('students.partials.table', ['students' => $students])
            </div>
        </div>
    </div>
</body>
</html>
