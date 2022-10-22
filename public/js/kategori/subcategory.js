
$('#modal-subcategory').on('shown.bs.modal', function() {
    let category_id = $(this).data('id')
    getSubCategory(category_id)
})

$('#modal-subcategory').on('hidden.bs.modal', function() {
    $('#name-category').html('-')
    $('#tb-subcategory').html(`
        <tr>
            <td colspan="3">Tidak ada data</td>
        </tr>
    `)
})

$('#btn-tambah-subcategory').on('click', function() {
    let category_id = $('#modal-subcategory').data('id')
    $('#modal-subcategory').modal('hide')
    $('#form-tambah-subcategory').data('category', category_id)
    $('#modal-tambah-subcategory').modal('show')
})

$('#modal-tambah-subcategory').on('hidden.bs.modal', function() {
    let subcategory_id = $('#modal-tambah-subcategory').data('id')
    $('#modal-subcategory').modal('show')
    getSubCategory(subcategory_id)
})

$(document).on('click', '.btn-edit-subcategory', function() {
    const subcategory_id = $(this).data('id')
    let name = $('#subcategory-name-'+subcategory_id)[0].innerText
    html = `
        <input type="text" class="form-control" id="save-subcategory-name-${subcategory_id}" value="${name}" data-previous="${name}">
        <button type="button" class="btn btn-primary btn-sm save-edit-subcategory" data-id="${subcategory_id}">Edit</button>
        <button type="button" class="btn btn-danger btn-sm cancel-edit-subcategory" data-id="${subcategory_id}">Batal</button>
    `
    $('#subcategory-name-'+subcategory_id).html(html)
})

$(document).on('click', '.save-edit-subcategory', function() {
    let subcategory_id = $(this).data('id')
    let category_id = $('#modal-subcategory').data('id')
    let name = $('#save-subcategory-name-' + subcategory_id).val()
    let data = {
        id: subcategory_id,
        category_id: category_id,
        name: name
    }

    $.ajax({
        url: base_url + '/api/category/subcategory/update',
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
            Swal.fire('Sukses', resp.message, 'success')
            $('#subcategory-name-'+subcategory_id).html(name)

            // let category_id = $('#modal-subcategory').data('id')
            // getSubCategory(category_id)
        },
        error: function(resp) {
            Swal.close()
            Swal.fire('Error', resp.message, 'error')
        }
    })
})

$(document).on('click', '.cancel-edit-subcategory', function() {
    let id = $(this).data('id')
    let name = $('#save-subcategory-name-' + id).data('previous')
    $('#subcategory-name-' + id).html(name)
})

$(document).on('click', '.btn-delete-subcategory', function() {
    const category_id = $(this).data('id')
    deleteSubcategory(category_id)
})

$('#form-tambah-subcategory').on('submit', function(event) {
    event.preventDefault()
    const data = {
        category_id: $(this).data('category'),
        name: $('#name-tambah-subcategory').val()
    }
    $.ajax({
        url: base_url + '/api/category/subcategory',
        method: 'post',
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
            $('#modal-tambah-subcategory').modal('hide')
            $('#name-tambah-subcategory').val('')
            Swal.fire('Sukses', resp.message, 'success')
            $('#modal-subcategory').modal('show')
        },
        error: function(resp) {
            Swal.close()
            Swal.fire('Error', resp.message, 'error')
        }
    })
})

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
                    <tr id="subcategory-list-${value.id}">
                        <td id="subcategory-name-${value.id}">${value.name}</td>
                        <td>
                            <button class="btn btn-warning btn-sm btn-edit-subcategory" title="Edit" id="edit${value.id}" data-id="${value.id}"><i class="far fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btn-delete-subcategory" title="Delete" id="delete${value.id}" data-id="${value.id}"><i class="fas fa-trash-alt"></i></button>
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

function deleteSubcategory(id) {
    let data = {id: id}
    let subcategory_id = id
    Swal.fire({
        title: 'Anda yakin ingin menghapus subkategori tersebut?',
        icon: 'question',
        showDenyButton: true,

        confirmButtonText: `Ya`,
        denyButtonText: `Kembali`,
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url: base_url + '/api/category/subcategory/delete',
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
                    Swal.fire('Sukses', resp.message, 'success')
                    $('#subcategory-list-' + subcategory_id).remove()

                    // let category_id = $('#modal-subcategory').data('id')
                    // getSubCategory(category_id)
                },
                error: function(resp) {
                    Swal.close()
                    Swal.fire('Error', resp.message, 'error')
                }
            })
        }
    })
}
