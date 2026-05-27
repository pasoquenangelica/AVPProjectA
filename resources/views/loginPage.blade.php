<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        :root {
            --bg: #f7f3d5;
            --panel: #fffdf2;
            --accent: #c89c12;
            --accent-dark: #6f5600;
            --border: #e5d07c;
            --text: #2f2808;
            --error: #9b1c1c;
            --success: #166534;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
            padding: 24px;
        }

        .login-card {
            width: min(420px, 100%);
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 12px 24px rgba(111, 86, 0, 0.12);
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
            color: var(--accent-dark);
        }

        p {
            margin: 0 0 20px;
            line-height: 1.5;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 15px;
        }

        .button {
            width: 100%;
            border: 0;
            border-radius: 10px;
            padding: 12px 14px;
            background: var(--accent);
            color: #fff;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .alert {
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .alert-error {
            background: #fee2e2;
            color: var(--error);
        }

        .alert-success {
            background: #dcfce7;
            color: var(--success);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Student Login</h1>
        <p>Sign in to continue to the student landing page.</p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label for="username">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            <button class="button" type="submit">Login</button>
        </form>
    </div>
</body>
</html>
