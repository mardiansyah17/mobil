<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Brand') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            // AJAX DataTable
            var datatable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
                },
                columns: [{
                    data: 'id',
                    name: 'id',
                },
                    //{
                    //  data: 'no',
                    //name: 'no',
                    //},
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
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
        </script>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="mb-10">
                <a href="{{ route('admin.brands.create') }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Tambah Brand
                </a>

                <a href="{{ route('admin.brand.download-pdf') }}"
                   class="px-4 py-2 font-bold text-white bg-blue-500 ml-3 rounded shadow-lg hover:bg-blue-700">
                    Download PDF
                </a>
            </div>
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <table id="dataTable">
                            <thead>
                            <tr>
                                <th style="max-width: 1%">ID</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th style="max-width: 1%">Aksi</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
