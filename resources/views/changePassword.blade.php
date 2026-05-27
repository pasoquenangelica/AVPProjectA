<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        :root {
            --bg: #fff8db;
            --panel: #fffdf2;
            --border: #efd56b;
            --accent: #c89c12;
            --accent-dark: #7a5d00;
            --text: #332800;
            --error-bg: #fee2e2;
            --error-text: #991b1b;
            --success-bg: #dcfce7;
            --success-text: #166534;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        .card {
            width: min(460px, 100%);
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 12px 24px rgba(122, 93, 0, 0.12);
        }

        h1 {
            margin: 0 0 8px;
            color: var(--accent-dark);
        }

        p {
            margin: 0 0 20px;
            color: #6b5a1a;
            line-height: 1.5;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .alert {
            margin-bottom: 16px;
            padding: 12px 14px;
            border-radius: 10px;
        }

        .alert-error {
            background: var(--error-bg);
            color: var(--error-text);
        }

        .alert-success {
            background: var(--success-bg);
            color: var(--success-text);
        }

        button {
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
    </style>
</head>
<body>
    <div class="card">
        <h1>Change Password</h1>
        <p>Your account requires a new password before you can continue.</p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.change.update') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $userId }}">

            <label for="current_password">Current Password</label>
            <input id="current_password" type="password" name="current_password" required>

            <label for="new_password">New Password</label>
            <input id="new_password" type="password" name="new_password" required>

            <label for="new_password_confirmation">Confirm New Password</label>
            <input id="new_password_confirmation" type="password" name="new_password_confirmation" required>

            <button type="submit">Update Password</button>
        </form>
    </div>
</body>
</html>
