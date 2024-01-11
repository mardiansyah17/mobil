<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\KasKeluar;
use App\Models\KasMasuk;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {


        $denda = Booking::where('denda', '!=', 0)->select(DB::raw('MONTH(start_date) as month, YEAR(start_date) as year'), DB::raw('sum(denda) as count'))
            ->groupBy(DB::raw('YEAR(start_date), MONTH(start_date)'))->get()->toArray();

        $kasMasuk = KasMasuk::select(DB::raw('MONTH(tanggal) as month, YEAR(tanggal) as year'), DB::raw('sum(total) as count'))
            ->groupBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'))
            ->get()->toArray();

//        dd($kasMasuk, $denda);
        // Menggabungkan array $x dan $y
        $result = Collection::make($denda)->merge($kasMasuk);

// Mengelompokkan berdasarkan month dan year
        $grouped = $result->groupBy(function ($item) {
            return $item['month'] . '-' . $item['year'];
        });

// Menggabungkan array yang memiliki month dan year yang sama
        $mergedKasMasuk = $grouped->map(function ($group) {
            return [
                "month" => $group[0]['month'],
                "year" => $group[0]['year'],
                "count" => $group->sum('count'),
            ];
        })->values()->all();


        $kasKeluar = KasKeluar::select(DB::raw('MONTH(tanggal) as month, YEAR(tanggal) as year'), DB::raw('sum(total) as count'))
            ->groupBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'))
            ->get()->toArray();

        $pemasukan = Booking::query()->where('status', '=', 'done')->get();
        return view('admin.dashboard', [
            'kasMasuk' => $mergedKasMasuk,
            'kasKeluar' => $kasKeluar,
            'pemasukan' => $pemasukan
        ]);
    }
}
