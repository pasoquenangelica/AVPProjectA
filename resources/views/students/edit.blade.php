<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Student</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body{font-family:Arial,sans-serif;margin:0;background:#fff8db;color:#332800}
        .wrap{max-width:760px;margin:0 auto;padding:32px 20px}
        .card{background:#fffdf2;border:1px solid #efd56b;border-radius:16px;padding:28px}
        .grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}
        .field{min-width:0}
        label{display:block;margin-bottom:8px;font-weight:bold}
        input,select{width:100%;max-width:100%;padding:12px;border:1px solid #efd56b;border-radius:10px;box-sizing:border-box}
        .full{grid-column:1/-1}
        button,a{border:0;border-radius:10px;padding:12px 16px;background:#c89c12;color:#fff;text-decoration:none;cursor:pointer}
        .actions{margin-top:20px;display:flex;gap:12px;flex-wrap:wrap}
        .actions a,.actions button{min-width:140px;text-align:center}
        .alert{padding:12px 14px;border-radius:10px;margin-bottom:16px}
        .alert-success{background:#e4f4e8;color:#1d5a2c}
        .alert-danger{background:#fde5e1;color:#8a2d20}
        .field-errors{margin-top:8px;color:#8a2d20;font-size:14px}
        @media(max-width:640px){.grid{grid-template-columns:1fr}.actions a,.actions button{width:100%}}
    </style>
</head>
<body data-page="students-edit">
    <div class="wrap">
        <div class="card">
            <h1>Edit Student</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">Please correct the highlighted fields.</div>
            @endif

            <form method="POST" action="{{ route('students.update', $student) }}">
                @csrf
                @method('PUT')
                <input type="hidden" id="studentId" value="{{ $student->id }}">

                <div id="message"></div>

                <div class="grid">
                <div class="field">
                    <label for="fname">First Name</label>
                    <input id="fname" name="fname" value="{{ old('fname', $student->fname) }}" required>
                    <div class="field-errors" data-field="fname">{{ $errors->first('fname') }}</div>
                </div>
                <div class="field">
                    <label for="lname">Last Name</label>
                    <input id="lname" name="lname" value="{{ old('lname', $student->lname) }}" required>
                    <div class="field-errors" data-field="lname">{{ $errors->first('lname') }}</div>
                </div>
                <div class="field">
                    <label for="mname">Middle Name</label>
                    <input id="mname" name="mname" value="{{ old('mname', $student->mname) }}">
                    <div class="field-errors" data-field="mname">{{ $errors->first('mname') }}</div>
                </div>
                <div class="field">
                    <label for="contactno">Contact Number</label>
                    <input id="contactno" name="contactno" value="{{ old('contactno', $student->contactno) }}" required>
                    <div class="field-errors" data-field="contactno">{{ $errors->first('contactno') }}</div>
                </div>
                <div class="full">
                    <label for="degree_id">Degree</label>
                    <select id="degree_id" name="degree_id" required>
                        @foreach($degrees as $degree)
                            <option value="{{ $degree->id }}" @selected(old('degree_id', $student->degree_id) == $degree->id)>{{ $degree->degree_title }}</option>
                        @endforeach
                    </select>
                    <div class="field-errors" data-field="degree_id">{{ $errors->first('degree_id') }}</div>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $student->userAccount?->email) }}" required>
                    <div class="field-errors" data-field="email">{{ $errors->first('email') }}</div>
                </div>
                <div class="field">
                    <label for="username">Username</label>
                    <input id="username" name="username" value="{{ old('username', $student->userAccount?->username) }}" required>
                    <div class="field-errors" data-field="username">{{ $errors->first('username') }}</div>
                </div>
                <div class="full">
                    <label for="password">New Password</label>
                    <input id="password" type="password" name="password">
                    <div class="field-errors" data-field="password">{{ $errors->first('password') }}</div>
                </div>
                </div>

                <div class="actions">
                    <button id="updateStudentBtn" type="submit">Update Student</button>
                    <a href="{{ route('students.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
