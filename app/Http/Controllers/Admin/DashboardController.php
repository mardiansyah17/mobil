<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
//        $kasMasuk = KasMasuk::select(DB::raw('MONTH(tanggal) as month, YEAR(tanggal) as year'), DB::raw('COUNT(*) as count'))
//            ->groupBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'))
//            ->get();
//        dd($kasMasuk);
        return view('admin.dashboard');
    }
}
