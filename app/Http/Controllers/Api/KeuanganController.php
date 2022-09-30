<?php

namespace App\Http\Controllers\Api;

use App\Helpers\KeuanganHelper;
use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeuanganController extends Controller
{
    public function getKeuanganAll(Request $request)
    {
        $keuangan = KeuanganHelper::getKeuanganAll($request);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan data keuangan',
            'data' => $keuangan
        ]);
    }
    public function getKeuanganBulanan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'month' => ['date_format:m-Y'],
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 103,
                'message' => $validator->errors()
            ], 422);
        }
        $keuangan = KeuanganHelper::getKeuanganBulanan($request);
        return response()->json([
            'success' => true,
            'message' => 'Sukses mendapatkan data keuangan bulanan',
            'data' => $keuangan
        ]);
    }

    public function storeKeuanganHarian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => ['date_format:Y-m-d'],
            'nominal' => ['required', 'integer', 'min:0'],
            'type' => ['required', 'boolean'],
            'sub_category_id' => ['required', 'exists:sub_categories,id']
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 103,
                'message' => $validator->errors(),
            ],422);
        }
        KeuanganHelper::storeKeuangan($request);
        return response()->json([
            'success' => true,
            'message' => 'Keuangan Berhasil ditambahkan'
        ]);
    }

    public function show(Request $request, $id) {
        $keuangan = KeuanganHelper::showKeuangan($request, $id);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan data keuangan',
            'data' => $keuangan
        ]);
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'exists:keuangans,id'],
            'tanggal' => ['nullable', 'date_format:Y-m-d'],
            'nominal' => ['nullable', 'integer', 'min:0'],
            'sub_category_id' => ['nullable', 'exists:sub_categories,id'],
            'type' => ['nullable', 'boolean'],
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 103,
                'message' => $validator->errors(),
            ], 422);
        }
        $keuangan = KeuanganHelper::updateKeuangan($request);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil update keuangan',
            'data' => $keuangan,
        ]);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer', 'exists:keuangans,id']
        ]);
        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 103,
                'message' => $validator->errors(),
            ], 422);
        }
        KeuanganHelper::deleteKeuangan($request->id);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil hapus catatan keuangan',
        ]);
    }
}
