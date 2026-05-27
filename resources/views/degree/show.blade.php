<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Degree Details</title>
    <style>
        :root {
            --bg: #fff8db;
            --panel: #fffdf2;
            --border: #efd56b;
            --accent-dark: #7a5d00;
            --text: #332800;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 24px;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
        }
        .container { max-width: 640px; margin: 0 auto; }
        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 12px 24px rgba(122, 93, 0, 0.12);
        }
        h1 { margin: 0 0 20px; color: var(--accent-dark); }
        .row { margin-bottom: 16px; }
        .label { font-weight: bold; margin-bottom: 6px; }
        .value { background: #fff; border-radius: 10px; padding: 12px 14px; }
        a {
            display: inline-block;
            margin-top: 8px;
            padding: 10px 14px;
            border-radius: 10px;
            background: #f3e6a7;
            color: var(--accent-dark);
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Degree Details</h1>

            <div class="row">
                <div class="label">ID</div>
                <div class="value">{{ $degree->id }}</div>
            </div>

            <div class="row">
                <div class="label">Degree Title</div>
                <div class="value">{{ $degree->degree_title }}</div>
            </div>

            <div class="row">
                <div class="label">Assigned Students</div>
                <div class="value">{{ $degree->students_count }}</div>
            </div>

            <a href="{{ route('degree.index') }}">Back to Degrees</a>
        </div>
    </div>
</body>
</html>
