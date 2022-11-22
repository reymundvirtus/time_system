$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

get_user_time();

function get_user_time() {

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'users-emp-time',
        success: function(data) {

            let html;

            for (let i = 0; i < data.length; i++) {
                html += '<tr>'
                html += '<td>'
                html += '   <div class="d-flex px-2 py-1">'
                html += '       <div>'
                html += '           <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user1">'
                html += '       </div>'
                html += '       <div class="d-flex flex-column justify-content-center">'
                html += '           <h6 class="mb-0 text-sm">' + data[i].name + '</h6>'
                html += '           <p class="text-xs text-secondary mb-0">' + data[i].email + '</p>'
                html += '       </div>'
                html += '   </div'
                html += '</td>'
                html += '<td class="align-middle text-m">'
                html += '   <span class="badge badge-sm bg-gradient-primary">' + data[i].id_code + '</span>'
                html += '</td>'
                html += '<td>'
                html += '   <div class="text-sm font-weight-bold mb-0">' + data[i].date_recorded + '</div>'
                html += '</td>'
                html += '<td>'
                html += '   <div class="text-sm font-weight-bold mb-0">' + data[i].time_in + '</div>'
                html += '</td>'
                html += '<td>'
                html += '   <div class="text-sm font-weight-bold mb-0">' + data[i].time_out + '</div>'
                html += '</td>'
                html += '<td class="align-middle text-lg">'
                html += '   <span class="badge badge-sm bg-gradient-primary">' + data[i].total_hour + '</span>'
                html += '</td>'
                html += '</tr>'
            }

            $('#get_user_time').html(html.substr(9))
            // setTimeout(get_user_time, 1000)
        }
    });

    return false;
}

$('#sync').on('click', function(){
    get_user_time();
})

function time_in_alert() {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
    })
    
    Toast.fire({
        icon: 'success',
        title: 'Good morning, Have a nice day!'
    })
}

function time_out_alert() {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
    })
    
    Toast.fire({
        icon: 'success',
        title: 'Thank you for your hard work!'
    })
}

//? read data
// $('#get_user_time').on('click', '.ReadPost', function() {

//     let id = $(this).data('id');
//     let name = $(this).data('name');
//     let email = $(this).data('email');
//     let role_id = $(this).data('role_id');
//     let id_code = $(this).data('id_code');
//     let date_time = $(this).data('date_time');
//     // let password = $(this).data('password');

//     $('#idr').val(id);
//     $('#namer').val(name);
//     $('#emailr').val(email);
//     $('#role_idr').val(role_id);
//     $('#id_coder').val(id_code);
//     $('#date_timer').val(date_time);
//     // $('#passwordr').val(password);

//     $('#readUserModal').modal('show');
// });
