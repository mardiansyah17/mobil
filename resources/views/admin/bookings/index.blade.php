<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Booking') }}
        </h2>
    </x-slot>
    <div class="bg-white rounded-sm p-3 shadow-md w-[90%] mt-3 mx-auto">
        <form method="post" action="{{route('admin.bookings.download-pdf')}}" class="flex justify-around">
            @csrf
            <select class="form-select px-4 py-3 rounded-sm " id="statusBooking" name="statusBooking">
                <option value="" selected>Status Booking</option>

                <option value="pending">Pending
                </option>
                <option value="confirmed">Confirmed
                </option>
                <option value="done">Done</option>
            </select>
            <select class="form-select px-4 py-3 rounded-sm" id="statusBayar" name="statusBayar">
                <option value="" selected>Status Bayar</option>
                <option value="pending">Pending
                </option>
                <option value="success">Success
                </option>
                <option value="failed">Failed</option>
            </select>

            <div>
                <input type="date" class="form-input" id="startDate">
                <span class="mx-2">-</span>
                <input type="date" class="form-input" id="endDate">
            </div>

            <button href="" class="px-3 py-2 rounded-md bg-blue-500 text-white" type="submit">Download PDF</button>

        </form>
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
                        d.statusBooking = $('#statusBooking').val()
                        d.statusBayar = $('#statusBayar').val()
                        d.startDate = $('#startDate').val()
                        d.endDate = $('#endDate').val()
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
                    {
                        data: 'user.name',
                        name: 'user.name',
                        // orderable: false,
                        // searchable: false,
                        // width: '20%',
                    },
                    {
                        data: 'name',
                        name: 'name',
                        // orderable: false,
                        // searchable: false,
                        // width: '20%',
                    },
                    {
                        data: 'item.brand.name',
                        name: 'item.brand.name'
                    },

                    {
                        data: 'item.name',
                        name: 'item.name'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                        width: '10%',


                    },
                    {
                        data: 'end_date',
                        name: 'end_date',
                        width: '10%',

                    },
                    {
                        data: 'status',
                        name: 'status'

                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'

                    },
                    {
                        data: 'total_price',
                        name: 'total_price',
                        width: '10%',
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

            $('#statusBooking').change(function () {
                datatable.draw();
            });

            $('#statusBayar').change(function () {
                datatable.draw();
            });


            $('#startDate').change(function () {
                datatable.draw();
            });

            $('#endDate').change(function () {
                datatable.draw();
            });


        </script>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- <div class="mb-10">
              <a href="{{ route('admin.bookings.create') }}"
                 class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                + Tambah Item
              </a>
            </div> --}}
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable" class="border cell-border compact stripe">
                        <thead>
                        <tr>
                            <th style="">ID</th>
                            <th style="">Nama Akun</th>
                            <th>Nama Pemesan</th>
                            <th>Brand</th>
                            <th>Item</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status Booking</th>
                            <th>Status Pembayaran</th>
                            <th>Total Dibayar</th>

                            <th style="max-width: 1%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
