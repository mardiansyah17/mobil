<x-app-layout>
  <x-slot name="title">Admin</x-slot>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Booking') }}
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
            name: 'start_date'

          },
          {
            data: 'end_date',
            name: 'end_date'

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
            name: 'total_price'

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
      {{-- <div class="mb-10">
        <a href="{{ route('admin.bookings.create') }}"
           class="px-4 py-2 font-bold text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
          + Tambah Item
        </a>
      </div> --}}
      <div class="overflow-hidden shadow sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
          <table id="dataTable" class="border cell-border compact stripe">
            <thead >
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