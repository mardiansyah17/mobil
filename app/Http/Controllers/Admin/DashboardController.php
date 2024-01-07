<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\KasKeluar;
use App\Models\KasMasuk;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $kasMasuk = KasMasuk::select(DB::raw('MONTH(tanggal) as month, YEAR(tanggal) as year'), DB::raw('sum(total) as count'))
            ->groupBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'))
            ->get()->toArray();
//        dd($kasMasuk);
        $kasKeluar = KasKeluar::select(DB::raw('MONTH(tanggal) as month, YEAR(tanggal) as year'), DB::raw('sum(total) as count'))
            ->groupBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'))
            ->get()->toArray();

        $pemasukan = Booking::query()->where('status', '=', 'done')->get();
        return view('admin.dashboard', [
            'kasMasuk' => $kasMasuk,
            'kasKeluar' => $kasKeluar,
            'pemasukan' => $pemasukan
        ]);
    }
}
