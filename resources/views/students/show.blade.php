<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
        body{font-family:Arial,sans-serif;margin:0;background:#f7f3ed;color:#2b2118}
        .wrap{max-width:760px;margin:0 auto;padding:32px 20px}
        .card{background:#fff;border:1px solid #ddcfbf;border-radius:16px;padding:28px}
        .row{margin:12px 0}
        a{display:inline-block;margin-top:20px;border-radius:10px;padding:10px 14px;background:#8a5a2b;color:#fff;text-decoration:none}
    </style>
</head>
<body>
    <div class="wrap">
        <div class="card">
            <h1>Student Details</h1>
            @include('students.partials.details')
            <a href="{{ route('students.index') }}">Back to Students</a>
        </div>
    </div>
</body>
</html>
