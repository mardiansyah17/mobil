<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Item') }}
        </h2>
    </x-slot>

    <div class="bg-white rounded-sm p-3 shadow-md w-[90%] mt-3 mx-auto">
        <form method="post" action="{{route('admin.user.download-pdf')}}" class="flex justify-around">
            @csrf
            <select class="form-select px-4 py-3 rounded-sm " id="role" name="role">
                <option value="" selected>Filter by role</option>

                <option value="ADMIN">Admin</option>
                <option value="USER">User</option>
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
                        d.role = $('#role').val()
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
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'

                    },
                    {
                        data: 'roles',
                        name: 'roles'

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

            // Filter
            $('#role').change(function () {
                datatable.draw();
            });

        </script>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('admin.users.create') }}"
                   class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                    + Tambah Users
                </a>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="dataTable" class="border cell-border compact stripe">
                        <thead>
                        <tr>
                            <th style="max-width: 1%">ID</th>
                            <th style="max-width: 20%">Nama</th>
                            <th>Phone</th>
                            <th>Email</th>

                            <th>Roles</th>
                            <th>Total transaksi</th>

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
