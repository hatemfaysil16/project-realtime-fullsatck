//start add data
$(document).on('submit', '#studentForm', function(e) {
    e.preventDefault();

    let fotmData = FormData($('#studentForm')[0]);

    //     $(this).text('Sending..');
    // var data = {
    //     'name': $('.name').val(),
    //     'image': $('.image').val(),
    // }
    console.log(fotmData);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        route: "{{route('sadsd')}}",
        data: fotmData,
        dataType: "json",
        success: function(response) {

            // if (response.status == 400) {
            //     $('#save_msgList').html("");
            //     $('#save_msgList').addClass("alert alert-danger");
            //     $.each(response.errors, function(key, err_values) {
            //         $('#save_msgList').append('<li>' + err_values + '</li>')
            //     });

            // } else {
            //     $('#save_msgList').html("");
            //     $('#success_message').addClass('alert alert-success');
            //     $('#success_message').text(response.message);
            //     $('#AddStudentModal').find('input').val('');
            //     $('.add_student').text('Save');
            //     $('#AddStudentModal').modal('hide');
            //     // fetchstudent();
            // }
        }
    });
});

//end add data