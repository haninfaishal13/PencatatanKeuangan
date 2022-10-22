getDashboardData()
getKeuanganBulanan()

function getDashboardData() {
    $.ajax({
        url: base_url + '/api/dashboard',
        method: 'get',
        headers: {
            "Authorization" : "Bearer "+localStorage.getItem('token')
        },
        success: function(resp) {
            $('#user').html(resp.data.name)
            if(resp.data.saldo_total > 0) {
                $('#total-saldo').addClass('text-success')
                $('#total-saldo').removeClass('text-danger')
            } else {
                $('#total-saldo').removeClass('text-success')
                $('#total-saldo').addClass('text-danger')
            }
            $('#pemasukan-harian').addClass('text-success').html(resp.data.pemasukan_harian)
            $('#pengeluaran-harian').addClass('text-danger').html(resp.data.pengeluaran_harian)
            $('#total-saldo').html(resp.data.saldo_total)
            $('#pemasukan-total').html(resp.data.pemasukan_total)
            $('#pengeluaran-total').html(resp.data.pengeluaran_total)

        },
        error: function(resp) {
            // console.log(resp)
        }
    })
}
