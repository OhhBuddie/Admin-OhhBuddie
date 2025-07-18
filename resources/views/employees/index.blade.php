<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-users"></i> Employee List</h4>
                <a href="{{ route('employees.create') }}" class="btn btn-light btn-sm"><i class="fas fa-plus"></i> Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="employeeTable" class="table table-bordered table-hover table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Emp ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->emp_id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->department }}</td>
                                <td>
                                    @if($employee->status == 'Active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-warning edit-row"><i class="fas fa-edit"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-success save-row d-none"><i class="fas fa-check"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary cancel-row d-none"><i class="fas fa-times"></i></button>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#employeeTable').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                }
            });

            if (sessionStorage.getItem('toast_success')) {
                toastr.success(sessionStorage.getItem('toast_success'));
                sessionStorage.removeItem('toast_success');
            }

            $(document).on('click', '.edit-row', function () {
                let row = $(this).closest('tr');
                row.find('td').each(function (index) {
                    if (index < 6) {
                        let text = $(this).text().trim();
                        let name = ['emp_id', 'name', 'email', 'phone', 'department', 'status'][index];
                        if (name === 'status') {
                            $(this).html(`
                                <select class="form-select form-select-sm" name="${name}">
                                    <option value="Active" ${text === 'Active' ? 'selected' : ''}>Active</option>
                                    <option value="Inactive" ${text === 'Inactive' ? 'selected' : ''}>Inactive</option>
                                </select>
                            `);
                        } else {
                            $(this).html(`<input type="text" class="form-control form-control-sm" name="${name}" value="${text}">`);
                        }
                    }
                });
                row.find('.edit-row').addClass('d-none');
                row.find('.save-row, .cancel-row').removeClass('d-none');
            });

            $(document).on('click', '.cancel-row', function () {
                location.reload();
            });

            $(document).on('click', '.save-row', function () {
                let row = $(this).closest('tr');
                let id = row.find('form').attr('action').split('/').pop();
                let data = {
                    _token: '{{ csrf_token() }}'
                };

                row.find('input, select').each(function () {
                    data[$(this).attr('name')] = $(this).val();
                });

                $.ajax({
                    url: `/employees/${id}`,
                    type: 'PUT',
                    data: data,
                    success: function (response) {
                        toastr.success('Employee updated successfully');
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function () {
                        toastr.error('Update failed.');
                    }
                });
            });

            $(document).on('submit', '.delete-form', function (e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to delete this employee?')) return;
                const form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function () {
                        toastr.success('Employee deleted successfully');
                        setTimeout(() => location.reload(), 1000);
                    },
                    error: function () {
                        toastr.error('Failed to delete employee');
                    }
                });
            });
        });
    </script>
</body>
</html>