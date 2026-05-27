<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Mode</title>
    <style>
        :root {
            --yellow-bg: #fff8db;
            --yellow-main: #f4c542;
            --yellow-dark: #8a6a00;
            --text-main: #3d3200;
            --card-bg: #fffdf2;
            --border-color: #f0d36a;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--yellow-bg);
            font-family: Arial, sans-serif;
            color: var(--text-main);
        }

        .maintenance-card {
            width: min(420px, calc(100% - 32px));
            background: var(--card-bg);
            border: 2px solid var(--border-color);
            border-radius: 14px;
            padding: 32px 24px;
            text-align: center;
            box-shadow: 0 10px 24px rgba(138, 106, 0, 0.12);
        }

        .icon-wrapper {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: var(--yellow-main);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
        }

        h1 {
            margin: 0 0 12px;
            font-size: 28px;
            color: var(--yellow-dark);
        }

        .lead {
            margin: 0 0 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        .status-badge {
            display: inline-block;
            margin-bottom: 12px;
            padding: 6px 12px;
            border-radius: 999px;
            background: #fff1b8;
            color: var(--yellow-dark);
            font-size: 13px;
            font-weight: bold;
        }

        .note {
            margin: 0;
            font-size: 14px;
            color: #6c5600;
        }
    </style>
</head>
<body>
    <div class="maintenance-card">
        <div class="status-badge">System Update</div>
        <div class="icon-wrapper">&#128736;&#65039;</div>
        <h1>We'll Be Back Soon</h1>
        <p class="lead">This site is currently under maintenance to improve your experience.</p>
        <p class="note">Please visit again later.</p>
    </div>
</body>
</html>
