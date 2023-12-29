<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\KasKeluar;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class KasMasukController extends Controller
{
    public function index()
    {


        $data = KasKeluar::all()->sum('total');
        if (request()->ajax()) {
            $query = KasKeluar::query();


            if (request()->get("startDate") && request()->get("endDate")) {
                $query
                    ->whereBetween('tanggal', [
                        Carbon::createFromFormat('m/d/Y', request()->get("startDate"))->format('Y-m-d'),
                        Carbon::createFromFormat('m/d/Y', request()->get("endDate"))->format('Y-m-d')
                    ]);

//                dd($query->toSql());
            }

            return DataTables::of($query)
                ->addColumn('action', function ($kaskeluar) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('admin.kaskeluars.edit', $kaskeluar->id) . '">
                            Edit
                        </a>
                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.kaskeluars.destroy', $kaskeluar->id) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->rawColumns(['action'])
                ->make()
                // ->with('total', function() use ($query) {
                //     return $query->sum('total');

                // })
                ;
        }


        // script untuk return halaman view brand
        // return view('admin.kaskeluars.index');
        return view('admin.kasMasuk.index', [
            'kas_keluar' => $data,
        ]);
    }

    public function booking()
    {
        $query = Booking::with(['user', 'item.brand']);
        if (request()->get('statusBooking')) {
            $query->where('status', '=', request()->get('statusBooking'));
        }

        if (request()->get('statusBayar')) {
            $query->where('payment_status', '=', request()->get('statusBayar'));
        }

        if (request()->get('startDate')) {
            $query->where('start_date', '=', request()->get('startDate'));
        }

        if (request()->get('endDate')) {
            $query->where('end_date', '=', request()->get('endDate'));
        }


        return DataTables::of($query)
            ->addColumn('start_date', function ($booking) {
                return \Illuminate\Support\Carbon::parse($booking->start_date)->format('d-m-Y');
            })
            ->addColumn('end_date', function ($booking) {
                return Carbon::parse($booking->end_date)->format('d-m-Y');
            })
            ->addColumn('action', function ($booking) {
                return '
                        <button class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" id="btnDenda">
                            Denda
                        </a>
                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.bookings.destroy', $booking->id) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
            })
            ->rawColumns(['action'])
            ->make();
    }
}
