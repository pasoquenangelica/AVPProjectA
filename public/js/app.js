function showMessage(container, type, text) {
    if (!container.length) {
        return;
    }

    container.html('<div class="alert alert-' + type + '">' + text + '</div>');
}

function clearFieldErrors() {
    $('.field-errors').empty();
}

function renderFieldErrors(errors) {
    clearFieldErrors();

    Object.keys(errors || {}).forEach(function (field) {
        $('.field-errors[data-field="' + field + '"]').html(errors[field].join('<br>'));
    });
}

function collectStudentPayload(includePassword) {
    var payload = {
        fname: $('#fname').val(),
        lname: $('#lname').val(),
        mname: $('#mname').val(),
        contactno: $('#contactno').val(),
        degree_id: $('#degree_id').val(),
        email: $('#email').val(),
        username: $('#username').val()
    };

    if (includePassword) {
        payload.password = $('#password').val();
    }

    return payload;
}

function loadStudents(url) {
    $.ajax({
        url: url || '/students',
        type: 'GET',
        success: function (response) {
            $('#studentsTableRegion').html(response.html);
        },
        error: function () {
            showMessage($('#message'), 'danger', 'Unable to load students.');
        }
    });
}

function viewStudent(id) {
    $.ajax({
        url: '/students/' + id,
        type: 'GET',
        success: function (response) {
            $('#studentDetailsTitle').text(response.title || 'Student Details');
            $('#studentDetails').html(response.html);
            $('#studentDetailsCard').show();
        },
        error: function () {
            showMessage($('#message'), 'danger', 'Unable to load student details.');
        }
    });
}

function deleteStudent(id) {
    $.ajax({
        url: '/students/' + id,
        type: 'DELETE',
        success: function (response) {
            showMessage($('#message'), 'success', response.message || 'Student deleted successfully.');
            $('#studentDetailsCard').hide();
            loadStudents('/students');
        },
        error: function () {
            showMessage($('#message'), 'danger', 'Unable to delete student.');
        }
    });
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        }
    });

    var page = $('body').data('page');

    if (page === 'students-index') {
        loadStudents('/students');

        $(document).on('click', '.view-student-btn', function (e) {
            e.preventDefault();
            viewStudent($(this).data('id'));
        });

        $(document).on('click', '.delete-student-btn', function (e) {
            e.preventDefault();

            if (window.confirm('Delete this student record?')) {
                deleteStudent($(this).data('id'));
            }
        });

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            loadStudents($(this).attr('href'));
        });
    }

    if (page === 'students-create') {
        $('#saveStudentBtn').on('click', function (e) {
            e.preventDefault();
            clearFieldErrors();

            $.ajax({
                url: '/students',
                type: 'POST',
                data: collectStudentPayload(true),
                success: function (response) {
                    showMessage($('#message'), 'success', response.message || 'Student saved successfully.');
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        renderFieldErrors(xhr.responseJSON.errors);
                        showMessage($('#message'), 'danger', 'Please correct the highlighted fields.');
                        return;
                    }

                    showMessage($('#message'), 'danger', 'Unable to save student.');
                }
            });
        });
    }

    if (page === 'students-edit') {
        $('#updateStudentBtn').on('click', function (e) {
            e.preventDefault();
            clearFieldErrors();

            $.ajax({
                url: '/students/' + $('#studentId').val(),
                type: 'PUT',
                data: collectStudentPayload(true),
                success: function (response) {
                    showMessage($('#message'), 'success', response.message || 'Student updated successfully.');
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        renderFieldErrors(xhr.responseJSON.errors);
                        showMessage($('#message'), 'danger', 'Please correct the highlighted fields.');
                        return;
                    }

                    showMessage($('#message'), 'danger', 'Unable to update student.');
                }
            });
        });
    }
});
