getKeuanganAll()

$(document).on('click', '.btn-edit', function() {
    keuangan_id = $(this).data('id')
    $('#modal-edit-keuangan').on('shown.bs.modal', function() {
        $('#modal-edit-keuangan').data('id', keuangan_id)
        showKeuangan(keuangan_id)
    })
})

$(document).on('click', '.btn-delete', function() {
    keuangan_id = $(this).data('id')
    deleteKeuangan(keuangan_id)

})

$('#modal-tambah-keuangan').on('shown.bs.modal', function() {
    $('[data-select2-id="1"]').css('z-index', '0')
})

$('#modal-edit-keuangan').on('shown.bs.modal', function() {
    $('[data-select2-id="1"]').css('z-index', '0')
})

$('#filter-keuangan').on('submit', function(event) {
    event.preventDefault()
    let params = `?`
    const durasi = $('#filter-waktu').val()
    params += `waktu=${durasi}`

    const jenis = $('#filter-jenis').val()
    if(jenis != null) {
        params += `&jenis=${jenis}`
    }

    const tipe = $('#filter-tipe').val()
    params += `&tipe=${tipe}`
    getKeuanganAll(params)
})

$('#form-edit-keuangan').on('submit', function(event) {
    event.preventDefault()
    data = {
        id: $('#modal-edit-keuangan').data('id'),
        tanggal: $('#date-edit-keuangan').val(),
        nominal: $('#nominal-edit-keuangan').val(),
        sub_category_id: $('#sub-category-edit-keuangan').val(),
        type: $('#type-edit-keuangan').val(),
        keterangan: $('#keterangan-edut-keuangan').val()
    }

    $.ajax({
        url: base_url + '/api/keuangan/update',
        method: 'put',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
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
            $('#modal-edit-keuangan').modal('hide')
            Swal.fire('Sukses', resp.message, 'success')
            getKeuanganAll()
        },
        error: function(resp) {
            Swal.close()
            Swal.fire('Error', resp.message, 'error')
        }
    })
})

$('#modal-tambah-keuangan').on('hidden.bs.modal', function() {
    $('[data-select2-id="1"]').css('z-index', '1000')
    getKeuanganAll()
})

function getKeuanganAll(data = '') {
    $.ajax({
        url: base_url + '/api/keuangan' + data,
        method: 'get',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        success: function(resp) {
            let html = ``
            $.each(resp.data, function(index, value) {
                let td_nominal
                if(value.type == 0) {
                    td_nominal = `<td class="text-success">+${value.nominal}</td>`
                } else {
                    td_nominal = `<td class="text-danger">-${value.nominal}</td>`
                }
                html += `
                <tr>
                    <td>${value.tujuan}</td>
                    ${td_nominal}
                    <td>${value.keterangan == null ? '-' : value.keterangan}</td>
                    <td>${value.tanggal}</td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-edit" title="Edit" data-id="${value.id}" data-bs-toggle="modal" data-bs-target="#modal-edit-keuangan"><i class="far fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm btn-delete" title="Hapus" data-id="${value.id}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                `
            })
            $('#tb-daftar-keuangan').html(html)
        }
    })
}

function showKeuangan(id) {
    $.get({
        url: base_url + '/api/keuangan/show/' + id,
        method: 'get',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        success: function(resp) {
            $('#date-edit-keuangan').val(resp.data.tanggal)
            $('#nominal-edit-keuangan').val(resp.data.nominal)
            $('#type-edit-keuangan').val(resp.data.type)
            $('#keterangan-edit-keuangan').val(resp.data.keterangan)
            $.ajax({
                url: base_url + '/api/subcategory/select',
                method: 'get',
                success: function(res) {
                    let array_select = ``
                    $.each(res.data, function(index, value) {
                        array_select += `
                            <option value="${value.id}" ${value.id == resp.data.sub_category_id ? 'selected' : ''}>${value.text}</option>
                        `
                    })
                    $('#sub-category-edit-keuangan').html(array_select)
                }
            })
        }
    })
}

function deleteKeuangan(id) {
    data = {id:id}
    Swal.fire({
        title: 'Anda yakin ingin menghapus data keuangan tersebut?',
        icon: 'question',
        showDenyButton: true,

        confirmButtonText: `Ya`,
        denyButtonText: `Kembali`,
    }).then((result) => {
        if(result.isConfirmed) {
            $.ajax({
                url: base_url + '/api/keuangan/delete',
                method: 'delete',
                headers: {
                    "Authorization" : "Bearer "+localStorage.getItem('token')
                },
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
                    $('#modal-edit-keuangan').modal('hide')
                    Swal.fire('Sukses', resp.message, 'success')
                    getKeuanganAll()
                },
                error: function(resp) {
                    Swal.close()
                    Swal.fire('Error', resp.message, 'error')
                }
            })
        }
    })

}
