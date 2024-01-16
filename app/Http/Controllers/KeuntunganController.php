<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\KasKeluar;
use App\Models\KasMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public function cetakPdf()
    {
        $kasKeluar = KasKeluar::select(
            DB::raw("YEAR(tanggal) as year"),
            DB::raw("MONTH(tanggal) as month"),
            DB::raw("SUM(total) as total")
        )
            ->groupBy('year', 'month')
            ->get();

        $denda = Booking::where('payment_status', '=', 'success')->where('payment_status', '=', 'success')->select(DB::raw('MONTH(start_date) as month, YEAR(start_date) as year'), DB::raw('sum(denda) +sum(total_price) as count'))
            ->groupBy(DB::raw('YEAR(start_date), MONTH(start_date)'))->get()->toArray();

        $kasMasukQuery = KasMasuk::select(DB::raw('MONTH(tanggal) as month, YEAR(tanggal) as year'), DB::raw('sum(total) as count'))
            ->groupBy(DB::raw('YEAR(tanggal), MONTH(tanggal)'))
            ->get()->toArray();

        $result = Collection::make($denda)->merge($kasMasukQuery);

        $groupedKasMasuk = $result->groupBy(function ($item) {
            return $item['month'] . '-' . $item['year'];
        });

        $kasMasuk = $groupedKasMasuk->map(function ($group) {
            return [
                "month" => $group[0]['month'],
                "year" => $group[0]['year'],
                "count" => $group->sum('count'),
            ];
        })->values()->all();

        $mergedData = [];

// Menggabungkan data kasKeluar dan kasMasuk
        foreach ($kasKeluar as $kas) {
            $yearMonth = $kas['year'] . '-' . $kas['month'];
            $mergedData[$yearMonth]['year'] = $kas['year'];
            $mergedData[$yearMonth]['month'] = $kas['month'];
            $mergedData[$yearMonth]['kasKeluar'] = $kas['total'];
        }

        foreach ($kasMasuk as $kas) {
            $yearMonth = $kas['year'] . '-' . $kas['month'];
            if (!isset($mergedData[$yearMonth])) {
                $mergedData[$yearMonth]['year'] = $kas['year'];
                $mergedData[$yearMonth]['month'] = $kas['month'];
            }
            $mergedData[$yearMonth]['kasMasuk'] = $kas['count'];

        }

        $result = array_map(function ($data) {
            $dateTime = DateTime::createFromFormat('m-Y', $data['month'] . '-' . $data['year']);
            $formattedDate = strftime('%B %Y', $dateTime->getTimestamp());
            return [
                'bulan' => $formattedDate,
                'kasMasuk' => $data['kasMasuk'] ?? 0,
                'kasKeluar' => $data['kasKeluar'] ?? 0,
                'Keuntungan' => $data['keuntungan'] ?? 0,
            ];
        }, $mergedData);

        $finalResult = collect($result)->map(function ($item) {
            // Ubah format "Desember 2023" ke format tanggal yang dapat diurutkan
            $timestamp = strtotime($item['bulan']);
            $item['tanggal_urut'] = date('Y-m-d', $timestamp);
            return $item;
        })->sortBy('tanggal_urut')->values()->all();


        $pdf = Pdf::loadView('cetak.keuntungan', [
            'keuntungan' => $finalResult,

        ])->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
