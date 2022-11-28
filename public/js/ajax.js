$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

get_user_data();
get_register_id_code();

//? retreived data
function get_user_data() {

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'users',
        success: function(data) {

            let html;
            let roleId = document.getElementById('roleId').value;

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
                html += '<td>'
                html += '   <p class="text-xs font-weight-bold mb-0">' + data[i].role_name + '</p>'
                html += '</td>'
                html += '<td class="align-middle text-center text-sm">'
                html += '   <span class="badge badge-sm bg-gradient-success">' + data[i].id_code.replace(/[0-9, ABCDEFGHIJKLMNOPQRSTUVWXYZ, -]/g, "*") + '</span>'
                html += '</td>'
                html += '<td class="align-middle text-center">'
                html += '   <span class="text-secondary text-xs font-weight-bold">' + data[i].date_time + '</span>'
                html += '</td>'
                if (roleId == 1) {
                    html += '<td class="align-middle"><a href="javascript:void(0)" type="button" class="text-secondary font-weight-bold text-xs EditPost" data-id="' + data[i].id + '"data-name="' + data[i].name + '"data-email="' + data[i].email + '"data-role_id="' + data[i].role_id + '"data-id_code="' + data[i].id_code + '">Edit</a></td>'
                }
                    html += '<td class="align-middle"><a href="javascript:void(0)" type="button" class="text-secondary font-weight-bold text-xs ReadPost" data-id="' + data[i].id + '"data-name="' + data[i].name + '"data-email="' + data[i].email + '"data-role_id="' + data[i].role_id + '"data-id_code="' + data[i].id_code + '"data-date_time="' + data[i].date_time + '"data-password="' + data[i].password + '">Read</a></td>'
                if (roleId == 1) {
                    html += '<td class="align-middle"><a href="javascript:void(0)" type="button" class="text-secondary font-weight-bold text-xs DeletePost" data-id="' + data[i].id + '"data-name="' + data[i].name + '"data-email="' + data[i].email + '"data-role_name="' + data[i].role_name + '"data-date_time="' + data[i].date_time + '"data-password="' + data[i].password + '">Delete</a></td>'
                }
                html += '</tr>'
            }

            $('#get_user_data').html(html.substr(9))
        }
    });

    return false;
}

//? retrieve id code
function get_register_id_code() {

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'id-code',
        success: function(data) {

            let html;

            if (data.length < 1) {
                html += '<select class="form-control">'
                html += '   <option>No available ID code</option>'
                html += '</select>'
            } else {
                for (let i = 0; i < data.length; i++) {
                    html += '<select class="form-control" name="id_codec" id="id_codec" required>'
                    html += '   <option value="' + data[i].id_code + '">' + data[i].id_code + '</option>'
                    html += '</select>'
                }
            }            

            $('#get_register_id_code').html(html.substr(9))
        },
    });

    return false;
}

//? retrieve the id code by clicking
$('#get_register_id_code').on('click', function() {
    get_register_id_code();
})

//? read data
$('#get_user_data').on('click', '.ReadPost', function() {

    let id = $(this).data('id');
    let name = $(this).data('name');
    let email = $(this).data('email');
    let role_id = $(this).data('role_id');
    let id_code = $(this).data('id_code');
    let date_time = $(this).data('date_time');
    // let password = $(this).data('password');

    $('#idr').val(id);
    $('#namer').val(name);
    $('#emailr').val(email);
    $('#role_idr').val(role_id);
    $('#id_coder').val(id_code);
    $('#date_timer').val(date_time);
    // $('#passwordr').val(password);

    $('#readUserModal').modal('show');
});

//? create user
$('#createUser').submit('click', function() {

    let name = $('#namec').val()
    let email = $('#emailc').val()
    let id_code = $('#id_codec').val()
    let role_id = $('#role_idc').val()

    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: { name: name, email: email, id_code: id_code, role_id: role_id },
        url: 'insert-user',
        success: function(data) {

            $("#createUserModal").modal('hide');
            Swal.fire({
                icon: 'success',
                iconColor: '#cb0c9f',
                title: 'Successfully Created!',
                confirmButtonColor: '#cb0c9f',
                confirmButtonText: 'Done',
            })
            get_user_data();
            clear_inputs();
        },
        error: function(data) {
            $('#errorModal').modal('show');
        }
    });

    return false;
});

//? update data
$('#get_user_data').on('dblclick', '.EditPost', function() {

    let id = $(this).data('id');
    let name = $(this).data('name');
    let email = $(this).data('email');
    let id_code = $(this).data('id_code');
    let role_id = $(this).data('role_id');

    $('#idu').val(id);
    $('#nameu').val(name);
    $('#emailu').val(email);
    $('#id_codeu').val(id_code);
    $('#role_idu').val(role_id);

    Swal.fire({
        title: 'Do you want to update this?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        iconColor: '#cb0c9f',
        showCancelButton: true,
        confirmButtonColor: '#cb0c9f',
        cancelButtonColor: '#8392ab',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $('#updateUserModal').modal('show');
        }
    })

    return false;
});

$('#updateUser').submit('click', function() {

    let id = $('#idu').val()
    let name = $('#nameu').val()
    let email = $('#emailu').val()
    let id_code = $('#id_codeu').val()
    let role_id = $('#role_idu').val()

    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: { id: id, name: name, email: email, id_code: id_code, role_id: role_id },
        url: 'update-user',
        success: function(data) {

            $("#updateUserModal").modal('hide');
            Swal.fire({
                icon: 'success',
                iconColor: '#cb0c9f',
                title: 'Successfully Updated!',
                confirmButtonColor: '#cb0c9f',
                confirmButtonText: 'Done',
            })
            get_user_data();
            clear_inputs();
        },
        error: function(data) {
            $('#errorModal').modal('show');
        }
    });

    return false;
});

//? update description
$('#edit_description').on('click', function() {

    // let description = $(this).data('description');

    // $('#description').val(description);

    Swal.fire({
        title: 'Do you want to edit your description?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        iconColor: '#cb0c9f',
        showCancelButton: true,
        confirmButtonColor: '#cb0c9f',
        cancelButtonColor: '#8392ab',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $('#updateUserDescription').modal('show');
        }
    })

    return false;
});

$('#updateDescription').submit('click', function() {

    let description = $('#description').val()

    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: { description: description },
        url: 'update-description',
        success: function(data) {

            $("#updateUserDescription").modal('hide');
            Swal.fire({
                icon: 'success',
                iconColor: '#cb0c9f',
                title: 'Successfully Updated!',
                text: "Refresh this page to see changes",
                confirmButtonColor: '#cb0c9f',
                confirmButtonText: 'Done',
            })
        },
        error: function(data) {
            $('#errorModal').modal('show');
        }
    });

    return false;
});

//? delete data
$('#get_user_data').on('dblclick', '.DeletePost', function() {

    let id = $(this).data('id');

    Swal.fire({
        title: 'Do you want to delete this?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        iconColor: '#cb0c9f',
        showCancelButton: true,
        confirmButtonColor: '#cb0c9f',
        cancelButtonColor: '#8392ab',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: { id: id },
                url: 'delete-user',
                success: function(data) {
    
                    Swal.fire({
                        icon: 'success',
                        iconColor: '#cb0c9f',
                        title: 'Successfully Deleted!',
                        confirmButtonColor: '#cb0c9f',
                        confirmButtonText: 'Done',
                    })
                    get_user_data();
                    get_count_data();
                },
            });
        }
    })
});

//? search users
$('#search').on('keyup', function() {
    
    $search = $(this).val();

    $.ajax({
        type: 'GET',
        data: { 'search': $search },
        url: 'search-user',
        success: function(data) {

            let html;
            let roleId = document.getElementById('roleId').value;

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
                html += '<td>'
                html += '   <p class="text-xs font-weight-bold mb-0">' + data[i].role_name + '</p>'
                html += '</td>'
                html += '<td class="align-middle text-center text-sm">'
                html += '   <span class="badge badge-sm bg-gradient-success">' + data[i].id_code.replace(/[0-9, ABCDEFGHIJKLMNOPQRSTUVWXYZ, -]/g, "*") + '</span>'
                html += '</td>'
                html += '<td class="align-middle text-center">'
                html += '   <span class="text-secondary text-xs font-weight-bold">' + data[i].date_time + '</span>'
                html += '</td>'
                if (roleId == 1) {
                    html += '<td class="align-middle"><a href="javascript:void(0)" type="button" class="text-secondary font-weight-bold text-xs EditPost" data-id="' + data[i].id + '"data-name="' + data[i].name + '"data-email="' + data[i].email + '"data-role_id="' + data[i].role_id + '"data-id_code="' + data[i].id_code + '">Edit</a></td>'
                }
                    html += '<td class="align-middle"><a href="javascript:void(0)" type="button" class="text-secondary font-weight-bold text-xs ReadPost" data-id="' + data[i].id + '"data-name="' + data[i].name + '"data-email="' + data[i].email + '"data-role_id="' + data[i].role_id + '"data-id_code="' + data[i].id_code + '"data-date_time="' + data[i].date_time + '"data-password="' + data[i].password + '">Read</a></td>'
                if (roleId == 1) {
                    html += '<td class="align-middle"><a href="javascript:void(0)" type="button" class="text-secondary font-weight-bold text-xs DeletePost" data-id="' + data[i].id + '"data-name="' + data[i].name + '"data-email="' + data[i].email + '"data-role_name="' + data[i].role_name + '"data-date_time="' + data[i].date_time + '"data-password="' + data[i].password + '">Delete</a></td>'
                }
                html += '</tr>'
            }

            $('#get_user_data').html(html.substr(9))
        },
    });
})

// clearing inputs
function clear_inputs() {

    $('#namec').val('');
    $('#emailc').val('');
}