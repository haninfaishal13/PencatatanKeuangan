const keuangan = '-tambah-keuangan'

$('#keuangan-bulanan').on('click', function() {
    let bulan = $('#select-bulan').val()
    let tahun = $('#select-tahun').val()
    getKeuanganBulanan()
})

// $('#modal'+keuangan).on('shown.bs.modal', function() {
//     $.ajax({
//         url: base_url + '/api/subcategory/select',
//         method: 'get',
//         success: function(resp) {
//             let array_select = ``
//             $.each(resp.data, function(index, value) {
//                 array_select += `
//                     <option value="${value.id}">${value.name}</option>
//                 `
//             })
//             $('#sub-category' + keuangan).html(array_select)
//         }
//     })
// })

$('#form'+keuangan).on('submit', function(event) {
    event.preventDefault()
    data = {
        date: $('#date'+keuangan).val(),
        nominal: $('#nominal'+keuangan).val(),
        type: $('#type' + keuangan).val(),
        sub_category_id: $('#sub-category' + keuangan).val(),
        keterangan: $('#keterangan' + keuangan).val()
    }

    $.ajax({
        url: base_url + '/api/keuangan/storeHarian',
        method: 'post',
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
            Swal.fire('Sukses', resp.message, 'success')
            $('#modal' + keuangan).modal('hide')
            getDashboardData()
            getKeuanganBulanan()
        },
        error: function(resp) {
            Swal.close()
            if(resp.responseJSON.code == 100) {
                localStorage.setItem('auth-expired', true)
                window.location.replace(base_url + '/frontend')
            } else {
                let error = ``
                $.each(resp.responseJSON.message, function(index, value) {
                    error += `
                        <div> ${value} </div>
                    `
                })
                Swal.fire('Error', error, 'error')
            }
        }
    })
})

function getKeuanganBulanan() {
    let bulan = $('#select-bulan').val()
    let tahun = $('#select-tahun').val()
    let data
    if(bulan > 9) {
        data = `${bulan}-${tahun}`
    } else {
        data = `0${bulan}-${tahun}`
    }
    $.ajax({
        url: base_url + '/api/keuangan/bulanan?month=' + data,
        method: 'get',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        success: function(resp) {
            if(resp.data != null) {
                $('#pemasukan-bulanan').html(resp.data.pemasukan_total_bulanan)
                $('#pengeluaran-bulanan').html(resp.data.pengeluaran_total_bulanan)
                const detail_pemasukan = detail_transaksi(resp.data.detail_pemasukan, 0, resp.data.pemasukan_total_bulanan)
                const detail_pengeluaran = detail_transaksi(resp.data.detail_pengeluaran, 1, resp.data.pengeluaran_total_bulanan)

                let html_pemasukan = ``
                let html_pengeluaran = ``
                if(detail_pemasukan['labels'].length == 0) {
                    html_pemasukan += `-`
                } else {
                    for(let i=0;i<detail_pemasukan['labels'].length;i++) {
                        html_pemasukan += `
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-4">
                                        ${detail_pemasukan['labels'][i]}
                                    </div>
                                    <div class="col-md-4 col-4 text-success">
                                        ${detail_pemasukan['data'][i]}
                                    </div>
                                    <div class="col-md-4 col-4 text-success">
                                        ${detail_pemasukan['persentase'][i]}
                                    </div>
                                </div>
                            </div>
                        </div>
                        `
                    }
                }

                if(detail_pengeluaran['labels'].length == 0) {
                    html_pengeluaran += `-`
                } else {
                    for(let i=0;i<detail_pengeluaran['labels'].length;i++) {
                        html_pengeluaran += `
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-4">
                                        ${detail_pengeluaran['labels'][i]}
                                    </div>
                                    <div class="col-md-4 col-4 text-danger">
                                        ${detail_pengeluaran['data'][i]}
                                    </div>
                                    <div class="col-md-4 col-4 text-danger">
                                        ${detail_pengeluaran['persentase'][i]}
                                    </div>
                                </div>
                            </div>
                        </div>
                        `
                    }
                }


                $('#detail-pemasukan').html(html_pemasukan)
                $('#detail-pengeluaran').html(html_pengeluaran)
            } else {
                $('#detail-pemasukan').html('-')
                $('#detail-pengeluaran').html('-')
            }
        }
    })
}
function detail_transaksi(keuangan, tipe, total_bulanan) {
    let labels = []
    let data = []
    let persentase = []

    let i
    $.each(keuangan, function(index, value) {
        if(labels.length == 0) {
            if(tipe == 0) {
                labels.push(value.jenis_pemasukan)
            } else {
                labels.push(value.jenis_pengeluaran)
            }

            if(data.length == 0) {
                data.push(value.nominal)
            }

        }
        else {
            if(keuangan.length > 1) {
                let label_exists = false
                for(i=0;i<labels.length;i++) {
                    if(tipe == 0) {
                        if(labels[i] == value.jenis_pemasukan) {
                            data[i] += value.nominal
                            label_exists = true
                        }
                    } else {
                        if(labels[i] == value.jenis_pengeluaran) {
                            data[i] += value.nominal
                            label_exists = true
                        }
                    }
                }
                if(!label_exists) {
                    if(tipe == 0) {
                        labels.push(value.jenis_pemasukan)
                    } else {
                        labels.push(value.jenis_pengeluaran)
                    }

                    data.push(value.nominal)
                }
            }
        }
    })
    $.each(data, function(index, value) {
        let p = Math.round(value/total_bulanan*100)
        persentase.push(`${p}%`)
    })

    let respon = {
        'labels': labels,
        'data': data,
        'persentase': persentase
    }
    return respon
}
