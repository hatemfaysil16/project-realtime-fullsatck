//start add data
$(document).on('click', '.add_student', function(e) {
    e.preventDefault();

    $(this).text('Sending..');
    var data = {
        'name': $('.name').val(),
        'image': $('.course').val(),
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/admin/Categories/store",
        data: data,
        dataType: "json",
        success: function(data) {
            console.log(data);
        }
    });
});
//end add data