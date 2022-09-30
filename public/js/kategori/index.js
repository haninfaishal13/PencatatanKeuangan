getCategory()

$(document).on('click', '.btn-modal-subcategory', function() {
    let category_id = $(this).data('id')
    $('#modal-subcategory').on('shown.bs.modal', function() {
        getSubCategory(category_id)
    });
})

$(document).on('click', '.btn-edit', function() {
    let category_id = $(this).data('id')
    $('#modal-edit-category').on('shown.bs.modal', function() {
        $('#modal-edit-category').data('id', category_id)
        showCategory(category_id)
    })
})
$(document).on('click', '.btn-delete', function() {
    let category_id = $(this).data('id')
    deleteCategory(category_id)
})

$('#form-tambah-category').on('submit', function(event) {
    event.preventDefault()
    let data = {name: $('#name-tambah-category').val()}
    $.ajax({
        url: base_url + '/api/category',
        method: 'post',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify(data),
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        beforeSend: function beforeSend() {
            $('#modal-tambah-category').modal('hide')
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
            Swal.fire('Sukses', resp.message, 'success')
            getCategory()
        }
    })
})

$('#form-edit-category').on('submit', function(event) {
    event.preventDefault()
    let data = {
        id: $('#modal-edit-category').data('id'),
        name: $('#name-edit-category').val()
    }
    $.ajax({
        url: base_url + '/api/category/update',
        method: 'put',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify(data),
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
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
            $('#modal-edit-category').modal('hide')
            Swal.fire('Sukses', resp.message, 'success')
            getCategory()
        },
        error: function(resp) {
            Swal.close()
            let error = ''
            $.each(resp.responseJSON.message, function(index, value) {
                for(let i=0;i<value.length;i++) {
                    error += value[i]
                    if(i+1 != value.length) {
                        error += ', '
                    }
                }
            })
            Swal.fire('Error', error, 'error')
        }
    })
})

function getCategory() {
    $.ajax({
        url: base_url + '/api/category',
        method: 'get',
        success: function(resp) {
            let category = ``
            $.each(resp.data, function(index, value) {
                category += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${value.name}</td>
                    <td>
                        <button class="btn btn-primary btn-sm btn-modal-subcategory" title="Lihat Subkategori" id="show${value.id}" data-id="${value.id}" data-bs-toggle="modal" data-bs-target="#modal-subcategory"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-warning btn-sm btn-edit" title="Edit" id="edit${value.id}" data-id="${value.id}" data-bs-toggle="modal" data-bs-target="#modal-edit-category"><i class="far fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm btn-delete" title="Delete" id="delete${value.id}" data-id="${value.id}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                `
            })
            $('#tb-category').html(category)
        }
    })
}

function showCategory(id) {
    $.ajax({
        url: base_url + '/api/category/' + id,
        method: 'get',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        success: function(resp) {
            $('#name-edit-category').val(resp.data.name)
        }
    })
}
function getSubCategory(category_id) {
    $.ajax({
        url: base_url + '/api/category',
        method: 'get',
        data: {
            category_id: category_id
        },
        success: function(resp) {
            $('#name-category').html(resp.data.name)
            let html = ``
            if(resp.data != null) {
                $.each(resp.data.sub_category, function(index, value) {
                    html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${value.name}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" title="Edit" id="edit${value.id}" data-id="${value.id}"><i class="far fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" title="Delete" id="delete${value.id}" data-id="${value.id}"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    `
                })
            } else {
                html += `
                <tr>
                    <td colspan="3">Tidak ada data</td>
                </tr>
                `
            }
            $('#tb-subcategory').html(html)
        }
    })
}

function deleteCategory(id) {
    let data = {id: id}
    Swal.fire({
        title: 'Anda yakin ingin menghapus kategori tersebut?',
        icon: 'question',
        showDenyButton: true,

        confirmButtonText: `Ya`,
        denyButtonText: `Kembali`,
    }).then((result) => {
        $.ajax({
            url: base_url + '/api/category/delete',
            method: 'delete',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            headers: {
                "Authorization" : "Bearer "+localStorage.getItem('token')
            },
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
                $('#modal-tambah-category').modal('hide')
                Swal.fire('Sukses', resp.message, 'success')
                getCategory()
            },
            error: function(resp) {
                Swal.close()
                Swal.fire('Error', resp.message, 'error')
            }
        })
    })

}
