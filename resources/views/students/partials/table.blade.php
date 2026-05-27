<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Degree</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($students as $student)
            <tr>
                <td>{{ $student->lname }}, {{ $student->fname }}</td>
                <td>{{ $student->degree?->degree_title ?? 'N/A' }}</td>
                <td>{{ $student->userAccount?->username ?? 'N/A' }}</td>
                <td class="actions">
                    <a href="{{ route('students.show', $student) }}" class="view-student-btn">
                        Show
                    </a>
                    <a href="{{ route('students.edit', $student) }}" class="muted">Edit</a>
                    <form method="POST" action="{{ route('students.destroy', $student) }}" class="inline-form" onsubmit="return confirm('Delete this student record?')">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="delete-student-btn danger"
                        >
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No students found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="pagination-wrap">
    {{ $students->links() }}
</div>
