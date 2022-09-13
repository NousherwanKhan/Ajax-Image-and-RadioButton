@extends('welcome')


@section('content')
    <div class="container">
        <!-- Add Modal -->
        <div class="modal fade" id="AddEmployeeModal" role="dialog">
            <div class="modal-dialog">

                <!-- Add Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Employee</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form id='AddEmployeeFORM' method="POST" enctype="multipart/form-data">

                        <div class="modal-body">

                            <ul class="alert alert-warning d-none" id="save_errorList"></ul>

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-check form-check-inline mb-3">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="mb-3">
                                <label>Input File</label>
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Modal content-->


    <!--edit Modal -->
    <div class="modal fade" id="EditEmployeeModal" role="dialog">
        <div class="modal-dialog">

            <!-- edit Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id='UpdateEmployeeFORM' method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="emp_id" id="emp_id" hidden>
                    <div class="modal-body">

                        <ul class="alert alert-warning d-none" id="update_errorList"></ul>

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name">
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="m_gender"
                                value="Male">
                            <label class="form-check-label" for="edit_gender">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="f_gender"
                                value="Female">
                            <label class="form-check-label" for="edit_gender">Female</label>
                        </div>
                        <div class="mb-3">
                            <label>Input File</label>
                            <input class="form-control" type="file" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- End Edit Modal content-->

    <!-- Delete Modal -->
    <div class="modal fade" id="DeleteEmployeeModal" role="dialog">
        <div class="modal-dialog">

            <!-- Delete Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h3>Are You Sure You Want To Delete This Employee's Data?</h3>
                    <input type="text" id="delete_emp_id" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class=" delete_yes btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End Add Modal content-->

    <!--Add Button  Modal -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Laravel Image Crud Ajax - Employee Table
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info btn-lg float-right" data-toggle="modal"
                            data-target="#AddEmployeeModal">
                            Add Employee</button>
                    </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>PHONE</th>
                                    <th>IMAGE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    fetchEmployee()

                    function fetchEmployee() {
                        $.ajax({
                            type: "GET",
                            url: "/fetch",
                            // dataType: "json",
                            success: function(response) {
                                // console.log(response.employee);
                                $('tbody').html("");
                                $.each(response.employee, function(key, people) {
                                    $('tbody').append(
                                        '<tr>\
                                                            <td>' + people.id + '</td>\
                                                            <td>' + people.name + '</td>\
                                                            <td>' + people.gender + '</td>\
                                                            <td><img src="images/employee/' + people.image + '" alt="" width="50px" height="50px"></td>\
                                                            <td>\
                                                                <button type="button" value="' + people.id + '" class="edit_btn btn btn-success btn-sm">Edit</button>\
                                                                <button type="button" value="' + people.id + '" class="delete_btn btn btn-danger btn-sm">Delete</button>\
                                                            </td>\
                                                        </tr>');
                                });
                            }
                        });
                    }

                    $(document).on('click', '.delete_btn', function(e) {
                        e.preventDefault();

                        var emp_id = $(this).val();
                        $("#DeleteEmployeeModal").modal('show');
                        $('#delete_emp_id').val(emp_id);
                    });

                    $(document).on('click', '.delete_yes', function(e) {
                        e.preventDefault();

                        var id = $('#delete_emp_id').val();

                        $.ajax({
                            type: "DELETE",
                            url: "delete/" + id,
                            dataType: "json",
                            success: function(response) {
                                if (response.status == 404) {
                                    alertify.set('notifier', 'position', 'top-right');
                                    alertify.success(response.message);
                                    alertify.set('notifier', 'position', 'top-right');
                                    alertify.success(response.message);
                                    $('#DeleteEmployeeModal').modal('hide');
                                } else if (response.status == 200) {
                                    fetchEmployee();
                                    $('#DeleteEmployeeModal').modal('hide');
                                    alertify.set('notifier', 'position', 'top-right');
                                    alertify.success(response.message);
                                }
                            }
                        });

                    });


                    $(document).on('click', '.edit_btn', function(e) {
                            e.preventDefault();

                            var emp_id = $(this).val();
                            $('#EditEmployeeModal').modal('show');
                            // alert(emp_id);

                            $.ajax({
                                    type: "GET",
                                    url: "edit/" + emp_id,
                                    success: function(response) {
                                        if (response.status == 404) {
                                            alertify.set('notifier', 'position', 'top-right');
                                            alertify.success(response.message);
                                            $('#EditEmployeeModal').modal('hide');
                                        } else {
                                            $('#emp_id').val(emp_id);
                                            $('#edit_name').val(response.employee.name);

                                            if (response.employee.gender == "Female") {
                                                $('#f_gender').prop('checked', true);
                                            } else {
                                                $('#m_gender').prop('checked', true);
                                            }
                                                // $('#edit_gender').val(response.employee.gender);
                                                // $("#AddEmployeeFORM").trigger('reset');
                                                // $('#AddEmployeeModal').modal('hide');
                                                // if( $('#edit_gender').is(':checked') ){
                                                // fetchEmployee()
                                            }
                                        }
                                    });
                                    // },
                                    // error: function(errpr) {
                                    // }
                            });

                        $(document).on('submit', '#UpdateEmployeeFORM', function(e) {
                            e.preventDefault();

                            var id = $('#emp_id').val();
                            let EditformData = new FormData($('#UpdateEmployeeFORM')[0]);

                            $.ajax({
                                type: "POST",
                                url: "/update/" + id,
                                data: EditformData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    if (response.status == 400) {
                                        $('#update_errorList').html('');
                                        $('#update_errorList').removeClass('d-none');

                                        $.each(response.error, function(key, err_value) {
                                            $('#update_errorList').append('<li>' + err_value +
                                                '</li>');
                                        });
                                    } else if (response.status == 404) {
                                        alertify.set('notifier', 'position', 'top-right');
                                        alertify.success(response.message);
                                    } else if (response.status == 200) {
                                        $('#update_errorList').html('');
                                        $('#update_errorList').addClass('d-none');

                                        $("#UpdateEmployeeFORM").trigger('reset');
                                        $('#EditEmployeeModal').modal('hide');

                                        alertify.set('notifier', 'position', 'top-right');
                                        alertify.success(response.message);
                                        fetchEmployee()
                                    }
                                }
                            });
                        });

                        $(document).on('submit', '#AddEmployeeFORM',
                            function(e) {
                                e.preventDefault();
                                let formData = new FormData($('#AddEmployeeFORM')[0]);

                                $.ajax({
                                    type: "POST",
                                    url: "employee",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        if (response.status == 400) {
                                            $('#save_errorList').html('');
                                            $('#save_errorList').removeClass('d-none');

                                            $.each(response.error, function(key, err_value) {
                                                $('#save_errorList').append('<li>' + err_value +
                                                    '</li>');
                                            });
                                        } else if (response.status == 200) {
                                            $('#save_errorList').html('');
                                            $('#save_errorList').addClass('d-none');

                                            $("#AddEmployeeFORM").trigger('reset');
                                            $('#AddEmployeeModal').modal('hide');

                                            fetchEmployee()
                                            alertify.set('notifier', 'position', 'top-right');
                                            alertify.success(response.message);
                                        }
                                    }
                                });
                            });
                    });
    </script>
@endsection



{{-- if(isset($home['gender']) && $home['gender'] == 'Male') echo 'checked'
if(isset($home['gender']) && $home['gender'] == 'Female') echo 'checked --}}
