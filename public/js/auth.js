$('#form-register').on('submit', function(event) {
    event.preventDefault()
    let data = {
        'email': $('#register-email').val(),
        'name': $('#register-name').val(),
        'password': $('#register-password').val(),
    }
    $.ajax({
        url:base_url + '/api/auth/register',
        method: 'post',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify(data),
        beforeSend: function beforeSend() {
            Swal.fire({
                title: 'Loading...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: function didOpen() {
                    Swal.showLoading()
                }
            })
        },
        success: function(resp) {
            Swal.close()
            set_token(resp.token)
            $('#register-modal').modal('hide')
            Swal.fire('Sukses', resp.message, 'success').then(function() {
                window.location.replace(base_url + '/frontend/dashboard')
            })
        }, error: function(resp) {
            Swal.fire('Error', resp.responseJSON.message, 'error')
        }
    })
})

$('#form-login').on('submit', function(event) {
    event.preventDefault()
    let data = {
        'email': $('#login-email').val(),
        'password': $('#login-password').val()
    }
    $.ajax({
        url:base_url + '/api/auth/login',
        method: 'post',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify(data),
        beforeSend: function beforeSend() {
            Swal.fire({
                title: 'Loading...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: function didOpen() {
                    Swal.showLoading()
                }
            })
        },
        success: function(resp) {
            Swal.close()
            set_token(resp.token)
            $('#login-modal').modal('hide')
            window.location.replace(base_url + '/frontend/dashboard')
        }, error: function(resp) {
            Swal.fire('Error', resp.responseJSON.message, 'error')
        }
    })
})

function confirm_password() {
    if($('#register-confirm-password').val() != $('#register-password').val()) {
        $('#warning-confirm-password').removeClass('d-none');
        $('#register-submit').addClass('disabled');
    }
    else {
        $('#warning-confirm-password').addClass('d-none');
        $('#register-submit').removeClass('disabled');
    }
}

function set_token(token) {
    let token_get = token
    localStorage.setItem('token', token_get);
}
