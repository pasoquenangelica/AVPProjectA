<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Teacher Details</title>
<style>body{font-family:Arial,sans-serif;margin:0;background:#eef4f1;color:#153126}.wrap{max-width:760px;margin:0 auto;padding:32px 20px}.card{background:#fff;border:1px solid #c7dbd2;border-radius:16px;padding:28px}.row{margin:12px 0}a{display:inline-block;margin-top:20px;border-radius:10px;padding:10px 14px;background:#2d6a4f;color:#fff;text-decoration:none}</style></head>
<body><div class="wrap"><div class="card"><h1>Teacher Details</h1><div class="row"><strong>Name:</strong> {{ $teacher->fname }} {{ $teacher->mname }} {{ $teacher->lname }}</div><div class="row"><strong>Contact:</strong> {{ $teacher->contactno }}</div><div class="row"><strong>Email:</strong> {{ $teacher->userAccount?->email ?? 'N/A' }}</div><div class="row"><strong>Username:</strong> {{ $teacher->userAccount?->username ?? 'N/A' }}</div><a href="{{ route('teachers.index') }}">Back to Teachers</a></div></div></body>
</html>
