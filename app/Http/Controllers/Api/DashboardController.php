<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DashboardHelper;
use App\Helpers\KeuanganHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = DashboardHelper::getDashboard($request);
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan data',
            'data' => $data,
        ]);
    }
}
