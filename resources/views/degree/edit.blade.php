<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Degree</title>
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
        h1 { margin: 0 0 8px; color: var(--accent-dark); }
        p { margin: 0 0 24px; color: #6b5a1a; }
        label { display: block; margin-bottom: 8px; font-weight: bold; }
        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fff;
            font-size: 14px;
        }
        .actions { margin-top: 20px; display: flex; gap: 10px; }
        .button, .secondary {
            border: 0;
            border-radius: 10px;
            padding: 12px 16px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }
        .button { background: var(--accent); color: #fff; }
        .secondary { background: #f3e6a7; color: var(--accent-dark); }
        .alert {
            margin-bottom: 16px;
            padding: 12px 14px;
            border-radius: 10px;
            background: var(--error-bg);
            color: var(--error-text);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Edit Degree</h1>
            <p>Update the selected degree entry.</p>

            @if ($errors->any())
                <div class="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('degree.update', $degree->id) }}">
                @csrf
                @method('PUT')

                <label for="degree_title">Degree Title</label>
                <input id="degree_title" type="text" name="degree_title" value="{{ old('degree_title', $degree->degree_title) }}" required>

                <div class="actions">
                    <button class="button" type="submit">Update Degree</button>
                    <a class="secondary" href="{{ route('degree.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
