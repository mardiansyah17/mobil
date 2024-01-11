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
        $x = [
            [
                "month" => 10,
                "year" => 2023,
                "count" => "2000000"
            ],
            [
                "month" => 10,
                "year" => 2023,
                "count" => "2000000"
            ]
        ];

     $yy = [
            [
                "month" => 12,
                "year" => 2023,
                "count" => "2000000"
            ],
            [
                "month" => 10,
                "year" => 2023,
                "count" => "2000000"
            ]
        ];


        $denda = Booking::where('denda', '!=', 0)->select(DB::raw('MONTH(start_date) as month, YEAR(start_date) as year'), DB::raw('sum(denda) as count'))
            ->groupBy(DB::raw('YEAR(start_date), MONTH(start_date)'))->get()->toArray();

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
