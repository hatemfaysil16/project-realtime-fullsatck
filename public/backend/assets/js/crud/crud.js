//start add data
$(document).ready(function() {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fetchstudent();



    function fetchstudent() {
        $.ajax({
            type: "GET",
            url: "/admin/fetch-students",
            dataType: "json",
            success: function(response) {
                $('tbody').html("");
                $.each(response.Categories, function(key, item) {
                    $('tbody').append('<tr>\
                        <td>' + item.id + '</td>\
                        <td>' + item.name + '</td>\
                        <td><img src="../upload/backend/Categories/' + item.image + '" alt=""></td>\
                        <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                        <td><button type="button" value="' + item.id + '" class="btn btn-danger delete_btn btn-sm">Delete</button></td>\
                    \</tr>');
                });
            }
        });
    }


    // edit
    $(document).on('click', '.editbtn', function(e) {
        e.preventDefault();
        var stud_id = $(this).val();
        // alert(stud_id);
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "edit-student/" + stud_id,
            success: function(response) {
                console.log(response.Categories);
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editModal').modal('hide');
                } else {
                    // console.log(response.student.name);
                    $('#name').val(response.Categories.name);
                    // $('#image').val(response.Categories.image);
                    $('#stud_id').val(stud_id);
                }
            }
        });
        $('.btn-close').find('input').val('');
    });

    //update
    $(document).on('submit', '#UpdateEmployForm', function(e) {
        e.preventDefault();
        var id = $('#stud_id').val();
        let EditFormData = new FormData($('#UpdateEmployForm')[0]);

        $.ajax({
            type: "post",
            url: "update-student/" + id,
            data: EditFormData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 400) {
                    $('#update_msgList').html("");
                    $('#update_msgList').addClass('alert alert-danger');
                    $.each(response.errors, function(key, err_value) {
                        $('#update_msgList').append('<li>' + err_value +
                            '</li>');
                    });
                } else if (response.status == 404) {
                    alert(response.message);
                } else if (response.status == 200) {
                    $('#update_msgList').html("");
                    $('#update_msgList').addClass('alert alert-danger');
                    $('#editModal').modal('hide');
                    alert(response.message);
                    fetchstudent();
                }
            }
        });


    });

    // add
    $(document).on('submit', '#AddEmployeeForm', function(e) {
        e.preventDefault();

        let fotmData = new FormData($('#AddEmployeeForm')[0]);

        $.ajax({
            type: "POST",
            route: "{{route('Categories.store')}}",
            data: fotmData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(response) {

                if (response.status == 400) {
                    $('#save_errorList').html("");
                    $('#save_errorList').removeClass("d-none");
                    $.each(response.errors, function(key, err_values) {
                        $('#save_errorList').append('<li>' + err_values + '</li>')
                    });

                } else if (response.status == 200) {
                    $('#save_errorList').html("");
                    $('#save_errorList').addClass("d-none");
                    $('#AddEmployeeForm').find('input').val('');
                    $('#exampleModal').click();
                    fetchstudent();

                }
            }

        });
    });

    //delete
    $(document).on('click', '.delete_btn', function(e) {
        e.preventDefault();
        var stud_id = $(this).val();
        $('#DeleteexampleModal').modal('show');
        $('#deleteimg_emp_id').val(stud_id);

    })


    $(document).on('click', '.delete_employee_btn', function(e) {
        e.preventDefault();

        var id = $('#deleteimg_emp_id').val();
        console.log(id);

        $.ajax({
            type: "DELETE",
            url: "delete-student/" + id,
            dataType: "json",
            success: function(response) {
                if (response.status == 404) {
                    alert(response.message);
                    $('#DeleteexampleModal').modal('hide');
                } else if (response.status == 200) {
                    fetchstudent();
                    alert(response.message);
                    $('#DeleteexampleModal').modal('hide');
                    alert(response.message);
                }

            }
        });


    })


});


//end add data//end add data