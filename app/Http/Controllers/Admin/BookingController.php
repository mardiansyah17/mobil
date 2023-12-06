<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\Type;
use App\Models\User;
use App\Models\Brand;
use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Requests\BookingUpdateRequest;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (request()->ajax()) {
            $query = Booking::with(['user', 'item.brand']);

            return DataTables::of($query)
                ->addColumn('action', function ($booking) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('admin.bookings.edit', $booking->id) . '">
                            Edit
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


        // script untuk return halaman view brand
        return view('admin.bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {

        return view('admin.bookings.edit', compact('booking'));

        // //
        // $booking->load('item.brand', 'user');
        // $items = Item::all();
        // $users = User::all();

        // return view('admin.bookings.edit', compact('booking','items', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        //
        $data = $request->all();

        $booking->update($data);

        return redirect()->route('admin.bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
        $booking->delete();
        return redirect()->route('admin.bookings.index');
    }
}
