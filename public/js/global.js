$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
});

$('.sub-category-select').select2({
    placeholder: 'Pilih Subkategori',
    allowClear: true,
    ajax: {
        url: base_url + '/api/subcategory/select',
        dataType: 'json',
        cache: true,
        data: function(params) {
            return {
                search: params.term,
            }
        },
        processResults: function(resp) {
            return {
                results: resp.data
            }
        }
    }
})

$(document).on('click', '#logout', function() {
    logout()
})

if(window.location.href != base_url + '/frontend') {
    checkToken()
} else {
    if(localStorage.getItem('token') != null) {
        // checkToken()
    } else {
        let button = `
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#register-modal">Register</button>`
        $('#auth-button').html(button).removeClass('nav-item dropdown')
        if(localStorage.getItem('auth-warning') != null) {
            Swal.fire('Error', 'Anda belum login', 'error')
        }
        else if(localStorage.getItem('auth-logout') != null) {
            Swal.fire('Success', 'Anda berhasil logout', 'success')
        }
        else if(localStorage.getItem('auth-expired') != null) {
            Swal.fire('Error', 'Anda perlu login ulang', 'error')
        }
        localStorage.removeItem('auth-expired')
        localStorage.removeItem('auth-warning')
        localStorage.removeItem('auth-logout')
    }

}

function checkToken() {
    let pathname = window.location.pathname
    if(localStorage.getItem('token') != null) {
        $.ajax({
            url: base_url + '/api/auth/check-token',
            method: 'get',
            headers: {
                "Authorization" : "Bearer "+localStorage.getItem('token')
            },
            success: function(resp) {
                let navbar_menu = `
                <li class="nav-item">
                    <a class="nav-link ${pathname == '/frontend/dashboard' ? 'active' : ''}" aria-current="page" href="${base_url + '/frontend/dashboard'}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ${pathname == '/frontend/kategori' ? 'active' : ''}" href="${base_url + '/frontend/kategori'}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ${pathname == '/frontend/keuangan' ? 'active' : ''}" href="${base_url + '/frontend/keuangan'}">Keuangan</a>
                </li>
                `
                let button = `
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ${resp.data.name}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#" id="profile">Profil</a></li>
                    <li><a class="dropdown-item" href="#" id="logout">Logout</a></li>
                </ul>`
                $('#navbar-menu').html(navbar_menu)
                $('#auth-button').html(button).addClass('nav-item dropdown')
                if(window.location.href == base_url + '/frontend') {
                    window.location.replace(base_url + '/frontend/dashboard')
                }
            },
            error: function() {
                let button = `
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#login-modal">Login</button>
                    <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#register-modal">Register</button>`
                $('#auth-button').html(button).removeClass('nav-item dropdown')
                localStorage.removeItem('token')
                localStorage.setItem('auth-expired', true)
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
        localStorage.removeItem('token')
        localStorage.setItem('auth-logout', true)
        window.location.replace(base_url + '/frontend')
    })
    .fail(function() {
        localStorage.removeItem('token')
        localStorage.setItem('auth-warning', true)
        window.location.replace(base_url + '/frontend')
    })
}

