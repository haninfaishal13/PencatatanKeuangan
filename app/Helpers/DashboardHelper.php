<?php
namespace App\Helpers;

class DashboardHelper {
    public static function getDashboard($request)
    {
        $response = [];
        $user = UserHelper::getUser($request->bearerToken());
        $keuangan = KeuanganHelper::getKeuangan($request);
        $keuangan_hari_ini = $keuangan->where('tanggal', date('Y-m-d'));
        $response['name'] = $user->name;
        $response['pengeluaran_harian'] = $keuangan_hari_ini->where('type', 1)->sum('nominal');
        $response['pemasukan_harian'] = $keuangan_hari_ini->where('type', 0)->sum('nominal');
        $response['pengeluaran_total'] = $keuangan->where('type', 1)->sum('nominal');
        $response['pemasukan_total'] = $keuangan->where('type', 0)->sum('nominal');
        $response['saldo_total'] = $response['pemasukan_total'] - $response['pengeluaran_total'];
        $response['detail_pemasukan'] = KeuanganHelper::getDetailPemasukan($keuangan);
        $response['detail_pengeluaran'] = KeuanganHelper::getDetailPengeluaran($keuangan);

        return $response;
    }
}
?>
