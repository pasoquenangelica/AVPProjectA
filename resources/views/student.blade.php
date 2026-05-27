<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student User</title>
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

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 24px;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 760px;
            margin: 0 auto;
        }

        .card {
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

        .subtitle {
            margin: 0 0 24px;
            color: #6b5a1a;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fff;
            font-size: 14px;
        }

        .errors {
            margin: 0 0 20px;
            padding: 12px 14px;
            border-radius: 10px;
            background: var(--error-bg);
            color: var(--error-text);
        }

        .actions {
            margin-top: 24px;
        }

        button {
            border: 0;
            border-radius: 10px;
            padding: 12px 18px;
            background: var(--accent);
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        @media (max-width: 640px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Add Student User</h1>
            <p class="subtitle">Create a student record and linked user account.</p>

            @if ($errors->any())
                <div class="errors">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('student.store') }}">
                @csrf

                <div class="grid">
                    <div>
                        <label for="fname">First Name</label>
                        <input id="fname" type="text" name="fname" value="{{ old('fname') }}" required>
                    </div>

                    <div>
                        <label for="lname">Last Name</label>
                        <input id="lname" type="text" name="lname" value="{{ old('lname') }}" required>
                    </div>

                    <div>
                        <label for="mname">Middle Name</label>
                        <input id="mname" type="text" name="mname" value="{{ old('mname') }}">
                    </div>

                    <div>
                        <label for="contactno">Contact Number</label>
                        <input id="contactno" type="text" name="contactno" value="{{ old('contactno') }}" required>
                    </div>

                    <div class="field-full">
                        <label for="degree_id">Degree</label>
                        <select id="degree_id" name="degree_id" required>
                            <option value="">Select degree</option>
                            @foreach ($degrees as $degree)
                                <option value="{{ $degree->id }}" @selected(old('degree_id') == $degree->id)>
                                    {{ $degree->degree_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div>
                        <label for="username">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required>
                    </div>

                    <div class="field-full">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required>
                    </div>
                </div>

                <div class="actions">
                    <button type="submit">Save Student</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
