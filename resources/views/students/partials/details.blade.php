<div class="row"><strong>Name:</strong> {{ $student->fname }} {{ $student->mname }} {{ $student->lname }}</div>
<div class="row"><strong>Contact:</strong> {{ $student->contactno }}</div>
<div class="row"><strong>Degree:</strong> {{ $student->degree?->degree_title ?? 'N/A' }}</div>
<div class="row"><strong>Email:</strong> {{ $student->userAccount?->email ?? 'N/A' }}</div>
<div class="row"><strong>Username:</strong> {{ $student->userAccount?->username ?? 'N/A' }}</div>
