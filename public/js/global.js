$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
});

var values = [],
keys = Object.keys(localStorage),
i = keys.length;

while ( i-- ) {
    values.push( localStorage.getItem(keys[i]) );
    console.log(keys[i])
}
console.log(values)

$(document).on('click', '#logout', function() {
    logout()
})

if(window.location.href != base_url + '/frontend') {
    checkToken()
} else {
    if(localStorage.getItem('token') != null) {
        checkToken()
    } else {
        let button = `
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#register-modal">Register</button>`
        $('#auth-button').html(button)
        if(localStorage.getItem('auth-warning') != null) {
            Swal.fire('Error', 'Anda belum login', 'error')
        }
        if(localStorage.getItem('auth-logout') != null) {
            Swal.fire('Success', 'Anda berhasil logout', 'success')
        }
        localStorage.removeItem('auth-warning')
        localStorage.removeItem('auth-logout')
    }

}

function checkToken() {
    if(localStorage.getItem('token') != null) {
        $.ajax({
            url: base_url + '/api/auth/check-token',
            method: 'get',
            headers: {
                "Authorization" : "Bearer "+localStorage.getItem('token')
            },
            success: function() {
                let navbar_menu = `
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="${base_url + '/frontend/dashboard'}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="${base_url + '/frontend/kategori'}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="${base_url + '/frontend/keuangan'}">Keuangan</a>
                </li>
                `
                let button = `<button class="btn btn-outline-primary btn-sm" id="logout">Logout</button>`
                $('#navbar-menu').html(navbar_menu)
                $('#auth-button').html(button)
                if(window.location.href == base_url + '/frontend') {
                    window.location.replace(base_url + '/frontend/dashboard')
                }
            },
            error: function() {
                let button = `
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
                    <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#register-modal">Register</button>`
                $('#auth-button').html(button)
                localStorage.removeItem('token')
                window.location.replace(base_url + '/frontend')
            }
        })
    } else {
        window.location.replace(base_url + '/frontend')
        if(localStorage.getItem('auth-logout') == null) {
            localStorage.setItem('auth-warning', true)
        }
    }
}

function logout() {
    $.ajax({
        url: base_url + '/api/auth/logout',
        method: 'post',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        }
    })
    .done(function() {
        console.log('aaa')
        localStorage.removeItem('token')
        localStorage.setItem('auth-logout', true)
        window.location.replace(base_url + '/frontend')
    })
    .fail(function() {
        console.log('bbb')
        localStorage.removeItem('token')
        localStorage.setItem('auth-warning', true)
        window.location.replace(base_url + '/frontend')
    })
}

