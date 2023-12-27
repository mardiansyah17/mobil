<x-app-layout>
    <x-slot name="title">Admin</x-slot>


    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Item') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-sm p-3 shadow-md w-[90%] mt-3 mx-auto">
        <form method="post" action="{{route('admin.items.download-pdf')}}" class="flex justify-around">
            @csrf
            <select class="form-select px-4 py-3 rounded-sm " id="harga" name="harga">
                <option value="" selected>Harga</option>

                <option value="kecil">Dari yang terkecil</option>
                <option value="besar">Dari yang terbesar</option>
            </select>

            <select class="form-select px-4 py-3 rounded-sm " id="rating" name="rating">
                <option value="" selected>Rating</option>

                <option value="kecil">Dari yang terkecil</option>
                <option value="besar">Dari yang terbesar</option>
            </select>

            <select class="form-select px-4 py-3 rounded-sm " id="review" name="review">
                <option value="" selected>Review</option>

                <option value="kecil">Dari yang terkecil</option>
                <option value="besar">Dari yang terbesar</option>
            </select>

            <button href="" class="px-3 py-2 rounded-md bg-blue-500 text-white" type="submit">Download PDF</button>

        </form>
    </div>

    <x-slot name="script">
        <script>
            // AJAX DataTable
            var datatable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                    data: function (d) {
                        d.harga = $('#harga').val()
                        d.rating = $('#rating').val()
                        d.review = $('#review').val()
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
                        data: 'thumbnail',
                        name: 'thumbnail',
                        orderable: false,
                        searchable: false,
                        width: '10%',
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'brand.name',
                        name: 'brand.name'
                    },
                    {
                        data: 'type.name',
                        name: 'type.name'

                    },
                    {
                        data: 'features',
                        name: 'features'

                    },
                    {
                        data: 'price',
                        name: 'price',
                        width: '10%',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp '),

                    },
                    {
                        data: 'star',
                        name: 'star'

                    },
                    {
                        data: 'review',
                        name: 'review'

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

            $('#harga').change(function () {
                datatable.draw();
            });

            $('#rating').change(function () {
                datatable.draw();
            });

            $('#review').change(function () {
                datatable.draw();
            });


        </script>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('admin.items.create') }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Tambah Item
                </a>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable" class="border cell-border compact stripe">
                        <thead>
                        <tr>
                            <th style="max-width: 1%">ID</th>
                            <th style="max-width: 20%">Thumbnail</th>
                            <th>Nama</th>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Fitur</th>
                            <th>Harga</th>
                            <th>Rating</th>
                            <th>Review</th>

                            <th style="max-width: 1%">Aksi</th>
                        </tr>
                        </thead>
                        <tbody class="text-center"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
