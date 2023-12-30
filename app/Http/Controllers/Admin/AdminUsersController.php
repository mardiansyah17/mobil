<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminUsersController extends Controller
{

    public function index()
    {
        //
        if (request()->ajax()) {
            $query = User::with('bookings');

            if (request()->get('role')) {
                $query->where('roles', '=', request()->get('role'));
            }

            return DataTables::of($query)
                ->addColumn('action', function ($user) {
                    return '
                        <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('admin.users.edit', $user->id) . '">
                            Edit
                        </a>

                        <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.users.destroy', $user->id) . '" method="POST">
                        <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                            Hapus
                        </button>
                            ' . method_field('delete') . csrf_field() . '
                        </form>';
                })
                ->addColumn('total', function ($user) {
                    return $user->bookings->sum("total_price");
                })->rawColumns(['action', 'total'])
                ->make();
        }


        // script untuk return halaman view brand
        return view('admin.users.index');
    }


    public function downloadPdf()
    {
        $users = User::query();

        if (request()->get('role')) {
            $users->where('roles', '=', request()->get('role'));
        }
        $pdf = Pdf::loadView('cetak.user', ['users' => $users->get()])->setPaper('a4', 'landscape');
        return $pdf->stream('users.pdf');
    }

    public function create()
    {

        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => $this->passwordRules(),
        //     'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        // ])->validate();

        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        // ]);
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        //
        // $data = $request->all();
        // $data = Hash::make(password);
        // // $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        // User::create($data);
        $validate = $request->all();

        $validate['password'] = Hash::make($validate['password']);
        User::create($validate);

        return redirect()->route('admin.users.index');
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
    public function edit(User $user)
    {
        //
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        //
        $validate = $request->all();


        $validate['password'] = Hash::make($validate['password']);

        $user->update($validate);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(User $user)
    {

        // User::delete();
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
