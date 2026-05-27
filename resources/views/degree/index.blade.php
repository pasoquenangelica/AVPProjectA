<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Degrees</title>
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
            padding: 24px;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
        }
        .container { max-width: 960px; margin: 0 auto; }
        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 12px 24px rgba(122, 93, 0, 0.12);
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }
        h1 { margin: 0; color: var(--accent-dark); }
        .button, .link-button {
            display: inline-block;
            border: 0;
            border-radius: 10px;
            padding: 10px 14px;
            background: var(--accent);
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #f3e6a7;
            text-align: left;
        }
        th { background: #fff3bf; color: var(--accent-dark); }
        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        .actions a, .actions button {
            border: 0;
            border-radius: 8px;
            padding: 8px 10px;
            font-size: 13px;
            text-decoration: none;
            cursor: pointer;
        }
        .view { background: #fef3c7; color: #7c5e10; }
        .edit { background: #fde68a; color: #6b4f00; }
        .delete { background: #fee2e2; color: #991b1b; }
        .alert {
            margin-bottom: 16px;
            padding: 12px 14px;
            border-radius: 10px;
        }
        .success { background: var(--success-bg); color: var(--success-text); }
        .error { background: var(--error-bg); color: var(--error-text); }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="topbar">
                <h1>Degrees</h1>
                <a class="button" href="{{ route('degree.create') }}">Add Degree</a>
            </div>

            @if (session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert error">{{ $errors->first() }}</div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Degree Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($degrees as $degree)
                        <tr>
                            <td>{{ $degree->id }}</td>
                            <td>{{ $degree->degree_title }}</td>
                            <td>
                                <div class="actions">
                                    <a class="view" href="{{ route('degree.show', $degree->id) }}">View</a>
                                    <a class="edit" href="{{ route('degree.edit', $degree->id) }}">Edit</a>
                                    <form method="POST" action="{{ route('degree.destroy', $degree->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No degrees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="margin-top: 16px;">
                {{ $degrees->links() }}
            </div>
        </div>
    </div>
</body>
</html>
