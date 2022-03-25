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
            url: "/admin/price/fetch-Data",
            dataType: "json",
            success: function(response) {
                $('tbody').html("");

                $.each(response.AllData, function(key, item) {


                    if (response.LocalizationCurrent == 'en') {
                        var name = item.name.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var name = item.name.ar;
                    }

                    if (response.LocalizationCurrent == 'en') {
                        var data = item.data.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var data = item.data.ar;
                    }

                    if (response.LocalizationCurrent == 'en') {
                        var currency = item.currency.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var currency = item.currency.ar;
                    }


                    if (response.LocalizationCurrent == 'en') {
                        var type = item.type.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var type = item.type.ar;
                    }


                    if (response.LocalizationCurrent == 'en') {
                        var description = item.description.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var description = item.description.ar;
                    }

                    if (item.active == 1) {
                        var active = 'active';
                    } else if (item.active == 0) {
                        var active = 'not active';
                    }


                    $('tbody').append('<tr>\
                        <td>' + (key + 1) + '</td>\
                        <td>' + name + '</td>\
                        <td>' + data + '</td>\
                        <td>' + currency + '</td>\
                        <td>' + type + '</td>\
                        <td>' + description + '</td>\
                        <td>' + item.price + '</td>\
                        <td><span class="badge badge-success badge-pill">' + active + '</span></td>\
                        <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button>\
                        <button type="button" value="' + item.id + '" class="btn btn-danger delete_btn btn-sm">Delete</button>\
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
            url: "price/store",
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
            url: "price/edit/" + stud_id,
            success: function(response) {
                if (response.status == 404) {

                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editModal').modal('hide');
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);
                } else {


                    if (response.LocalizationCurrent == 'en') {
                        var name = response.dataFind.name.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var name = response.dataFind.name.ar;
                    }

                    if (response.LocalizationCurrent == 'en') {
                        var data = response.dataFind.data.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var data = response.dataFind.data.ar;
                    }

                    if (response.LocalizationCurrent == 'en') {
                        var currency = response.dataFind.currency.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var currency = response.dataFind.currency.ar;
                    }


                    if (response.LocalizationCurrent == 'en') {
                        var type = response.dataFind.type.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var type = response.dataFind.type.ar;
                    }


                    if (response.LocalizationCurrent == 'en') {
                        var description = response.dataFind.description.en;
                    } else if (response.LocalizationCurrent == 'ar') {
                        var description = response.dataFind.description.ar;
                    }


                    $('#name_s').val(name);
                    $('#data_s').val(data);
                    $('#currency_s').val(currency);
                    $('#type_s').val(type);
                    $('#description_s').val(description);
                    $('#name_s').val(name);
                    $('#price_s').val(response.dataFind.price);
                    $('#active_s').val(response.dataFind.active);


                    if ($('#active_s').val() == true) {
                        $('#active_s').attr('checked', "1");
                    } else if ($('#active_s').val() == 0) {
                        $('#active_s').removeAttr('checked');
                    }



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

            url: "price/update/" + id,
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
            url: "price/delete/" + id,
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