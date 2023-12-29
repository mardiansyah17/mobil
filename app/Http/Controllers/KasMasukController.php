<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\KasKeluar;
use App\Models\KasMasuk;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class KasMasukController extends Controller
{
    public function index()
    {


        $data = KasKeluar::all()->sum('total');
        if (request()->ajax()) {
            $query = KasMasuk::query()->with('user');


            if (request()->get("startDate") && request()->get("endDate")) {
                $query
                    ->whereBetween('tanggal', [
                        Carbon::createFromFormat('m/d/Y', request()->get("startDate"))->format('Y-m-d'),
                        Carbon::createFromFormat('m/d/Y', request()->get("endDate"))->format('Y-m-d')
                    ]);

//                dd($query->toSql());
            }

            return DataTables::of($query)
                ->addColumn('action', function ($kasmasuk) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('admin.kasmasuks.edit', $kasmasuk->id) . '">
                            Edit
                        </a>
                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.kasmasuks.destroy', $kasmasuk->id) . '" method="POST">
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
                        <a  href="' . route('admin.kasMasuk.create.denda', $booking->id) . '" class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" >
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

    public function createDenda(Booking $booking)
    {
        $user = User::all();
        return view('admin.kasMasuk.create-denda', [
            'booking' => $booking,

        ]);
    }

    public function store()
    {

        $data = request()->validate([
            'user' => 'required',
            'jenis_pemasukan' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'total' => 'required',

        ]);
        $data['user_id'] = $data['user'];
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $data['tanggal'])->format('Y-m-d');

        KasMasuk::create($data);

        return redirect()->route('admin.kasmasuks.index')->with('success', 'Kas Masuk berhasil ditambahkan');
    }

    public function create()
    {
        return view('admin.kasMasuk.create', [
            'users' => User::all(),
        ]);
    }

//    edit dan update
    public function edit(KasMasuk $kasmasuk)
    {
//        dd($kasmasuk);
        return view('admin.kasMasuk.edit', [
            'kasMasuk' => $kasmasuk,
            'users' => User::all(),
        ]);
    }

    public function storeDenda(Booking $booking)
    {
//        dd($booking);
        $booking->update([
            'denda' => request()->get('denda'),
        ]);


        return redirect()->route('admin.kasmasuks.index')->with('success', 'Denda berhasil ditambahkan');
    }

    public function update(KasMasuk $kasmasuk)
    {
        $data = request()->validate([
            'user' => 'required',
            'jenis_pemasukan' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'total' => 'required',

        ]);
        $data['user_id'] = $data['user'];
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $data['tanggal'])->format('Y-m-d');

        $kasmasuk->update($data);

        return redirect()->route('admin.kasmasuks.index')->with('success', 'Kas Masuk berhasil diupdate');
    }

    public function destroy(KasMasuk $kasmasuk)
    {
        $kasmasuk->delete();

        return redirect()->route('admin.kasmasuks.index')->with('success', 'Kas Masuk berhasil dihapus');
    }
}
