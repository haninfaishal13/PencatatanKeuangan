<?php
namespace App\Helpers;

use App\Models\Keuangan;

class KeuanganHelper
{
    public static function getKeuangan($request)
    {
        $user_id = UserHelper::getId($request->bearerToken());
        $keuangan = Keuangan::with('sub_category')->where('user_id', $user_id)->get();
        return $keuangan;
    }

    public static function getKeuanganAll($request)
    {
        $response = [];
        $keuangan = self::getKeuangan($request);
        foreach($keuangan as $uang) {
            $tmp['id'] = $uang->id;
            $tmp['tujuan'] = $uang->sub_category->name;
            $tmp['nominal'] = $uang->nominal;
            $tmp['tanggal'] = date('d-m-Y', strtotime($uang->tanggal));
            $tmp['type'] = $uang->type;
            array_push($response, $tmp);
        }
        return $response;

    }

    public static function getKeuanganBulanan($request)
    {
        $response = [];

        $detail_pengeluaran = [];
        if(is_null($request->month)) {
            $month = date('m-Y');
        } else {
            $month = $request->month;
        }
        $date_start = date('Y-m-d', strtotime('1-'.$month));
        $date_end = date('Y-m-t', strtotime('1-'.$month));
        $keuangan = self::getKeuangan($request)->whereBetween('created_at', [$date_start." 00:00:00", $date_end." 23:59:59"]);

        $detail_pemasukan = self::getDetailPemasukan($keuangan);
        $detail_pengeluaran = self::getDetailPengeluaran($keuangan);

        $response['pemasukan_total_bulanan'] = $keuangan->where('type', 0)->sum('nominal');
        $response['pengeluaran_total_bulanan'] = $keuangan->where('type', 1)->sum('nominal');
        $response['detail_pemasukan'] = $detail_pemasukan;
        $response['detail_pengeluaran'] = $detail_pengeluaran;
        return $response;
    }

    public static function showKeuangan($request, $id) {
        $keuangan = self::getKeuangan($request)->where('id', $id)->first();
        return $keuangan;
    }

    public static function getDetailPengeluaran($keuangan) {
        $detail_pengeluaran = [];
        if(!$keuangan->where('type',1)->isEmpty()) {
            foreach($keuangan->where('type', 1) as $pengeluaran) {
                $tmp['jenis_pengeluaran'] = $pengeluaran->sub_category->name;
                $tmp['nominal'] = $pengeluaran->nominal;
                $tmp['keterangan'] = $pengeluaran->keterangan;
                $tmp['tanggal'] = date('d-m-Y', strtotime($pengeluaran->created_at));
                array_push($detail_pengeluaran, $tmp);
            }
        }
        return $detail_pengeluaran;
    }

    public static function getDetailPemasukan($keuangan) {
        $detail_pemasukan = [];
        if(!$keuangan->where('type', 0)->isEmpty()) {
            foreach($keuangan->where('type', 0) as $pemasukan) {
                $tmp['jenis_pemasukan'] = $pemasukan->sub_category->name;
                $tmp['nominal'] = $pemasukan->nominal;
                $tmp['keterangan'] = $pemasukan->keterangan;
                $tmp['tanggal'] = date('d-m-Y', strtotime($pemasukan->created_at));
                array_push($detail_pemasukan, $tmp);
            }
        }
        return $detail_pemasukan;
    }

    public static function storeKeuangan($request)
    {
        $user_id = UserHelper::getId($request->bearerToken());
        $storeKeuangan = Keuangan::create([
            'user_id' => $user_id,
            'sub_category_id' => $request->sub_category_id,
            'nominal' => $request->nominal,
            'type' => $request->type,
            'keterangan' => $request->keterangan,
            'tanggal' => date('Y-m-d', strtotime($request->date))
        ]);
        return $storeKeuangan;

    }

    public static function updateKeuangan($request)
    {
        $id = $request->id;
        $keuangan = Keuangan::find($id);
        $keuangan->update($request->except('_method', '_token'));
        return $keuangan;
    }

    public static function deleteKeuangan($id)
    {
        $keuangan = Keuangan::find($id);
        $keuangan->delete();
        return true;
    }
}
?>
