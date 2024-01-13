<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\KasKeluar;
use App\Models\KasMasuk;
use Illuminate\Support\Carbon;

class KeuntunganController extends Controller
{
    public function index()
    {
        $kasMasuk = KasMasuk::query();
        $kasKeluar = KasKeluar::query();

        $denda = Booking::where('payment_status', '=', 'success');


        if (request()->ajax() && request()->get("startDate") && request()->get("endDate")) {

            $kasMasuk->whereBetween('tanggal', [
                Carbon::createFromFormat('m/d/Y', request()->get("startDate"))->format('Y-m-d'),
                Carbon::createFromFormat('m/d/Y', request()->get("endDate"))->format('Y-m-d')
            ]);

            $kasKeluar->whereBetween('tanggal', [
                Carbon::createFromFormat('m/d/Y', request()->get("startDate"))->format('Y-m-d'),
                Carbon::createFromFormat('m/d/Y', request()->get("endDate"))->format('Y-m-d')
            ]);

            $denda->whereBetween('start_date', [
                Carbon::createFromFormat('m/d/Y', request()->get("startDate"))->format('Y-m-d'),
                Carbon::createFromFormat('m/d/Y', request()->get("endDate"))->format('Y-m-d')
            ]);

            return response()->json([
                'kasMasukPrice' => $kasMasuk->sum("total") + $denda->sum('denda') + $denda->sum('total_price'),
                'kasMasukCount' => $kasMasuk->count(),
                'kasKeluarPrice' => $kasKeluar->sum("total"),
                'kasKeluarCount' => $kasKeluar->count(),
            
            ]);
        }


        return view('admin.keuntungan.index', [
            'kasMasukPrice' => $kasMasuk->sum("total") + $denda->sum('denda') + $denda->sum('total_price'),
            'kasMasukCount' => $kasMasuk->count(),
            'kasKeluarPrice' => $kasKeluar->sum("total"),
            'kasKeluarCount' => $kasKeluar->count(),
        ]);
    }
}
