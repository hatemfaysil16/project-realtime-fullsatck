//realtime image
$(document).ready(function() {
    $('#image').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#mainThmb').attr('src', e.target.result);
            $('#open').click(function(e) {
                $('#mainThmb').attr('src', '');
            })
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});


$(document).ready(function() {



    // start show token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // end show token


    fetchData();


    //start show
    function fetchData() {
        $.ajax({
            type: "GET",
            url: "/admin/fetch-Data",
            dataType: "json",
            success: function(response) {
                $('tbody').html("");

                $.each(response.Categories, function(key, item) {

                    if (response.LocalizationCurrent == 'en') {
                        var name = item.name.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var name = item.name.ar;
                    }

                    $('tbody').append('<tr>\
                        <td>' + (key + 1) + '</td>\
                        <td>' + name + '</td>\
                        <td><a  data-fslightbox="gallery" href="' + response.url + response.ConsteCategory + item.image + '"><img  class="container" style="width: 10rem;" src="' + response.url + response.ConsteCategory + item.image + '" alt=""></a></td>\
                        <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button>\
                        <button type="button" value="' + item.id + '" class="btn btn-danger delete_btn btn-sm">Delete</button>\
                        <a class="btn btn-primary btn-sm"  data-fslightbox="gallery" href="' + response.url + response.ConsteCategory + item.image + '">show</a></td>\
                    \</tr>');
                });
            }
        });
    }
    //end show

    //start add
    $(document).on('submit', '#AddEmployeeForm', function(e) {
        e.preventDefault();

        let fotmData = new FormData($('#AddEmployeeForm')[0]);

        $.ajax({
            type: "POST",
            url: "Categories/store",
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
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);

                } else if (response.status == 200) {
                    $('#save_errorList').html("");
                    $('#save_errorList').addClass("d-none");
                    $('#AddEmployeeForm').find('input').val('');
                    $('#exampleModal').click();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);
                    fetchData();

                }
            }

        });
    });
    //end add

    //start edit
    $(document).on('click', '.editbtn', function(e) {
        e.preventDefault();
        var stud_id = $(this).val();
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "edit-category/" + stud_id,
            success: function(response) {
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editModal').modal('hide');
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);
                } else {
                    if (response.LocalizationCurrent == 'en') {
                        var name = response.Categories.name.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var name = response.Categories.name.ar;
                    }

                    $('#name_s').val(name);
                    $('#old_image').val(response.Categories.image);
                    $('#image_s').attr('src', `${response.url}${response.ConsteCategory}${response.Categories.image}`);
                    $('#stud_id').val(stud_id);
                }
            }
        });
        $('.btn-close').find('input').val('');
    });
    //end edit

    //start update
    $(document).on('submit', '#UpdateEmployForm', function(e) {
        e.preventDefault();
        var id = $('#stud_id').val();
        let EditFormData = new FormData($('#UpdateEmployForm')[0]);

        $.ajax({
            type: "post",

            url: "category-update/" + id,
            data: EditFormData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 400) {
                    $('#update_msgList').html("");
                    $.each(response.errors, function(key, err_value) {
                        $('#update_msgList').append('<li>' + err_value +
                            '</li>');
                    });
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);
                } else if (response.status == 404) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);
                } else if (response.status == 200) {
                    $('#update_msgList').html("");
                    $('#editModal').modal('hide');
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);

                    fetchData();
                }
            }
        });


    });
    //end update

    //start show model delete
    $(document).on('click', '.delete_btn', function(e) {
        e.preventDefault();
        var stud_id = $(this).val();
        $('#DeleteexampleModal').modal('show');
        $('#deleteimg_emp_id').val(stud_id);
    });
    //end show model delete

    //start delete
    $(document).on('click', '.delete_employee_btn', function(e) {
        e.preventDefault();

        var id = $('#deleteimg_emp_id').val();

        $.ajax({
            type: "DELETE",
            url: "delete-student/" + id,
            dataType: "json",
            success: function(response) {
                if (response.status == 404) {
                    $('#DeleteexampleModal').modal('hide');
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);
                } else if (response.status == 200) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(response.message);

                    fetchData();
                    $('#DeleteexampleModal').modal('hide');
                }

            }
        });
    });
    //end delete


});
