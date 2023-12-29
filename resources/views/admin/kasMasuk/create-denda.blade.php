<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            <a href="#!" onclick="window.history.go(-1); return false;">
                ←
            </a>
            {!! __('Kas Keluar &raquo; Tamba Data') !!}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-6xl mx-auto overflow-hidden bg-white shadow-xl sm:px-6 lg:px-8 sm:rounded-lg">

            @if ($errors->any())
                <div class="mb-5" role="alert">
                    <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                        Ada kesalahan!
                    </div>
                    <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                        <p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </p>
                    </div>
                </div>
            @endif
            <form class="w-full" action="{{ route('admin.kasMasuk.store.denda',$booking->id) }}" method="post"
                  enctype="multipart/form-data">
                @csrf

                <div class="flex flex-wrap px-3 mt-10 mb-6 -mx-3">
                    <div class="w-full">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                               for="grid-last-name">
                            Jumlah denda
                        </label>
                        <input value="{{ old('denda') ?? $booking->denda }}" name="denda"
                               class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                               id="grid-last-name" type="number" placeholder="Denda" required>
                        <div class="mt-2 text-sm text-gray-500">
                            Denda. Contoh: 20000.
                        </div>
                    </div>
                </div>


        </div>
        <div class="flex flex-wrap mb-10 -mx-3">
            <div class="w-full px-3 text-right">
                <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    Simpan Data
                </button>
            </div>
        </div>
        </form>
    </div>


    </div>
    </div>

</x-app-layout>
