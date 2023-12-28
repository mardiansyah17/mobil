<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Kas Keluar') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="grid grid-cols-2 gap-6 px-3 mt-4-mx-3">
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <form action="{{route('admin.kas-keluar.download-pdf')}}" method="post" class="w-full">
                            @csrf
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                   for="grid-last-name">
                                Cetak Laporan
                            </label>

                            <div date-rangepicker class="flex items-center mb-3">
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input name="startDate" type="text"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date start">
                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                        </svg>
                                    </div>
                                    <input name="endDate" type="text"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date end">
                                </div>
                            </div>


                            <div class="flex flex-wrap mb-2 -mx-3">
                                <div class="w-full px-3 text-right">
                                    <button type="submit"
                                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded shadow-lg hover:bg-blue-700">
                                        Download Pdf
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="w-full">
                            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                   for="grid-last-name">
                                Total Kas Keluar
                            </label>
                            <div class="w-full mb-10">
                                <label class="p-10 font-bold ps-10"
                                       style="font-size:50px">Rp. {{ number_format($kas_keluar) }}</label>
                            </div>

                            <div class="flex flex-wrap mb-2 -mx-3 overflow-hidden">
                                {{-- <div class="w-full px-3 text-left">
                                    <button type="submit"
                                        class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                                        Download Pdf
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- <div class="mb-10">
        <a href="{{ route('admin.kaskeluars.create') }}"
           class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
          + Add Pengeluaran
        </a>
      </div> --}}
            <div class="overflow-hidden shadow sm:rounded-md">

                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="mt-10 mb-10">
                        <a href="{{ route('admin.kaskeluars.create') }}"
                           class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                            + Add Pengeluaran
                        </a>
                        <span class="px-4" style="color:darkgray"><i>*fitur ini digunakan apabila ingin menambahkan
                                kas keluar.</i></span>
                    </div>
                    <table id="dataTable" class="table border cell-border compact stripe">
                        <thead>
                        <tr>
                            <th style="max-width: 1%">ID</th>
                            {{-- <th style="max-width: 20%">Thumbnail</th> --}}
                            <th>Nama</th>
                            <th>Jenis Pengeluaran</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Quantity</th>
                            <th>Harga</th>
                            <th>Total</th>

                            <th style="max-width: 1%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="text-center"></tbody>
                        <tfoot>
                        <th colspan="7">Total</th>
                        <th>Rp. {{ number_format($kas_keluar) }}</th>
                        <th></th>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>

            // AJAX DataTable
            const datatable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                    data: function (d) {
                        d.startDate = $('input[name=startDate]').val() ?? '';
                        d.endDate = $('input[name=endDate]').val() ?? '';
                    }
                },
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
                },

                columns: [
                    //{ className: 'dt-center', targets: '_all' },
                    {
                        data: 'id',
                        name: 'id',
                    },
                    // {
                    //   data: 'thumbnail',
                    //   name: 'thumbnail',
                    //   orderable: false,
                    //   searchable: false,
                    //   width: '20%',
                    // },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'jenis_pengeluaran',
                        name: 'jenis_pengeluaran'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'

                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'

                    },
                    {
                        data: 'quantity',
                        name: 'quantity'

                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp '),

                    },
                    {
                        data: 'total',
                        name: 'total',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp '),

                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '15%'
                    },
                ],
            });

            // Date Range Picker on change
            $('input[name=startDate]').on("changeDate", function () {
                datatable.draw();
            });

            $('input[name=endDate]').on("changeDate", function () {
                datatable.draw();
            });

        </script>
    </x-slot>

</x-app-layout>
