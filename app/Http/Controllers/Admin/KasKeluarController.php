<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KasKeluarRequest;
use App\Models\KasKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class KasKeluarController extends Controller
{

    public function index()
    {
        // $data = KasKeluar::get();
        // $data = $data->sortByDesc(function ($data) {
        //     return $data->total->sum('total');
        // });
        // // script untuk datatables, AJAX

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
        return view('admin.kaskeluars.index', [
            'kas_keluar' => $data,
        ]);
    }

    public function downloadPdf()
    {

        $query = KasKeluar::query();


        if (request()->get("startDate") && request()->get("endDate")) {
            $query
                ->whereBetween('tanggal', [
                    Carbon::createFromFormat('m/d/Y', request()->get("startDate"))->format('Y-m-d'),
                    Carbon::createFromFormat('m/d/Y', request()->get("endDate"))->format('Y-m-d')
                ]);

        }

        $total = KasKeluar::all()->sum('total');

        $pdf = Pdf::loadView('cetak.kas-keluar',
            [
                'kas' => $query->get(),
                'total' => $total,
            ])->setPaper('a4', 'landscape');
        return $pdf->stream();

    }

    public function store(KasKeluarRequest $request)
    {
        //
        $data = $request->all();
        // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // $data['tanggal'] = Carbon::now()->format('Y-m-d');

        // $data = Carbon::createFromFormat('m/d/y', ['tanggal'])->format('Y-m-d');

        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

        KasKeluar::create($data);

        return redirect()->route('admin.kaskeluars.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('admin.kaskeluars.create');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(KasKeluar $kaskeluar)
    {
        //
        $kaskeluar['tanggal'] = date('m/d/Y');
        // $date = $kaskeluar->tanggal->format('m-d-Y');
        // $kaskeluar['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

        return view('admin.kaskeluars.edit', [
            'kas_keluar' => $kaskeluar,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(KasKeluarRequest $request, KasKeluar $kaskeluar)
    {
        //
        $data = $request->all();
        $data['tanggal'] = Carbon::createFromFormat('m/d/Y', $request->tanggal)->format('Y-m-d');

        $kaskeluar->update($data);

        return redirect()->route('admin.kaskeluars.index');

        // return view('admin.kaskeluars.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(KasKeluar $kaskeluar)
    {
        //
        $kaskeluar->delete();
        return redirect()->route('admin.kaskeluars.index');
    }
}
