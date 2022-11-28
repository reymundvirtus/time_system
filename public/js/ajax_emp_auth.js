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
                html += '   <span class="badge badge-sm bg-gradient-primary">' + data[i].id_code.replace(/[0-9, ABCDEFGHIJKLMNOPQRSTUVWXYZ, -]/g, "*") + '</span>'
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

$('.date').datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    duration: "slow",
    showAnim: "slide",
}).on('change', function() {      
    $date_recorded = $('#date').val();
    
    $.ajax({
        type: "GET",
        data: { 'date_recorded': $date_recorded },
        url: 'search-user-date',
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
                html += '   <span class="badge badge-sm bg-gradient-primary">' + data[i].id_code.replace(/[0-9, ABCDEFGHIJKLMNOPQRSTUVWXYZ, -]/g, "*") + '</span>'
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
        },
        error: function (error) {
            console.log(error);
        }
    });
});