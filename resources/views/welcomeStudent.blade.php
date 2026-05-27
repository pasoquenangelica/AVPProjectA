<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Landing Page</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff8db;
            color: #3d3200;
            font-family: Arial, sans-serif;
            padding: 24px;
        }

        .panel {
            width: min(520px, 100%);
            background: #fffdf2;
            border: 1px solid #f0d36a;
            border-radius: 16px;
            padding: 32px;
            text-align: center;
            box-shadow: 0 12px 24px rgba(138, 106, 0, 0.12);
        }

        h1 {
            margin: 0 0 10px;
            color: #8a6a00;
        }

        p {
            margin: 0 0 12px;
            line-height: 1.6;
        }

        .success {
            margin-bottom: 16px;
            padding: 12px;
            border-radius: 10px;
            background: #dcfce7;
            color: #166534;
        }

        .uri {
            display: inline-block;
            margin-top: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #fff1b8;
            color: #8a6a00;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="panel">
        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <h1>Student Landing Page</h1>
        <p>You have logged in successfully.</p>
        <p>This page is the landing page for student accounts.</p>
        <div class="uri">URI: /student/welcome</div>
    </div>
</body>
</html>
