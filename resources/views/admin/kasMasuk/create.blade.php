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
            <form class="w-full" action="{{ route('admin.kaskeluars.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="flex flex-wrap px-3 mt-10 mb-6 -mx-3">
                    <div class="w-full">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="grid-last-name">
                            Nama*
                        </label>
                        <input value="{{ old('name') }}" name="name"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" type="text" placeholder="Nama" required>
                        <div class="mt-2 text-sm text-gray-500">
                            Nama Pengeluaran. Contoh: Item 1, Item 2, Item 3, dsb. Wajib diisi. Maksimal 255 karakter.
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
                    <div class="w-full">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="grid-last-name">
                            Jenis Pengeluaran*
                        </label>
                        <select name="jenis_pengeluaran"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                            required>
                            <option value="">Pilih Pengeluaran</option>
                            <option value="Rutin"> Rutin</option>
                            <option value="Sosial"> Sosial</option>
                            <option value="Asuransi"> Asuransi</option>
                            <option value="Operasional"> Operasional</option>
                            <option value="Klaim Garansi"> Klaim Garansi</option>
                            <option value="Cicilan Utang">Cicilan Utang</option>

                        </select>
                        <div class="mt-2 text-sm text-gray-500">
                            Jenis Pengeluaran. Contoh: Cicilan Utang
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap px-3 mt-10 mb-6 -mx-3">
                    <div class="w-full">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="grid-last-name">
                            Keterangan*
                        </label>
                        <input value="{{ old('keterangan') }}" name="keterangan"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" type="text" placeholder="keterangan" required>
                        <div class="mt-2 text-sm text-gray-500">
                           Jelaskan rincian pengeluaran, seperti membeli alat kebersihan mobil.
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 px-3 mt-4 mb-10 -mx-3">
                    <div class="w-full">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="grid-last-name">
                            Tanggal*
                        </label>
                        <div class="relative ">
                            <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker datepicker-autohide type="text" value="{{ old('tanggal') }}" name="tanggal"
                                class="ps-10 p-2.5 block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                placeholder="Select date">
                        </div>
                    </div>

                    <div class="w-full">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="grid-last-name">
                            Kuantitas*
                        </label>
                        <input value="{{ old('quantity') }}" name="quantity"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" type="number" placeholder="Jumlah Barang">
                        <div class="mt-2 text-sm text-gray-500">
                            Masukan jumlah barang yang dibeli
                        </div>
                    </div>
                </div>





                <div class="grid grid-cols-2 gap-6 px-3 mt-4 mb-10 -mx-3">
                    <div class="w-full">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="grid-last-name">
                            Harga*
                        </label>
                        <input value="{{ old('harga') }}" name="harga"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" type="number" placeholder="Harga">
                        <div class="mt-2 text-sm text-gray-500">
                            Harga Item. Angka. Contoh: 10000. wajib diisi
                        </div>
                    </div>

                

                    <div class="w-full">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="grid-last-name">
                            Total Harga*
                        </label>
                        <input value="{{ old('total') }}" name="total"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" type="number" placeholder="Review" required>
                        <div class="mt-2 text-sm text-gray-500">
                            Otomatis terisi atau bisa di isi manual.
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
