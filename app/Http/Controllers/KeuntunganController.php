<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\KasKeluar;
use App\Models\KasMasuk;

class KeuntunganController extends Controller
{
    public function index()
    {
        $kasMasuk = KasMasuk::all();
        $kasKeluar = KasKeluar::all();

        $denda = Booking::where('payment_status', '=', 'success')->get();
        return view('admin.keuntungan.index', [
            'kasMasuk' => $kasMasuk,
            'kasKeluar' => $kasKeluar,
            'denda' => $denda
        ]);
    }
}
