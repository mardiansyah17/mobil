@extends('layouts.cetak')

@section('content')

    <table style="font-size: 20px;">
        <tr>
            <td style="width: 200px;border: none!important;">Total pengeluaran</td>
            <td style="width: 10px;border: none!important;">:</td>
            <td style="border: none!important;">Rp {{number_format($total_pemasukan)}}</td>
        </tr>
    </table>

    <h4>Tabel denda</h4>
    <table>
        <thead>
        <tr>
            <th style="">No</th>
            <th>Nama Pemesan</th>
            <th>Brand</th>
            <th>Item</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Status Booking</th>
            <th>Status Pembayaran</th>
            <th>Denda</th>
            <th>Total Dibayar</th>

        </tr>
        </thead>

        <tbody>
        @foreach($denda as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->user->name}}</td>
                <td>{{$item->item->brand->name}}</td>
                <td>{{$item->item->name}}</td>
                <td>{{$item->start_date}}</td>
                <td>{{$item->end_date}}</td>
                <td>{{$item->status}}</td>
                <td>{{$item->payment_status}}</td>
                <td>Rp {{number_format($item->denda)}}</td>
                <td>Rp {{number_format($item->total_price)}}</td>
            </tr>

        @endforeach
        </tbody>
    </table>

    <h4>Tabel Pemasukan</h4>
    <table style="margin-top: 4px">
        <thead>
        <tr>
            <th style="">No</th>
            <th>Nama</th>
            <th>Jenis Pemasukan</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Quantity</th>
            <th>Harga</th>
            <th>Total</th>

        </tr>
        </thead>

        <tbody>
        @foreach($kas_masuk as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->user->name}}</td>
                <td>{{$item->jenis_pemasukan}}</td>
                <td>{{$item->keterangan}}</td>
                <td>{{$item->tanggal}}</td>
                <td>{{$item->qty}}</td>
                <td>Rp {{number_format($item->harga)}}</td>
                <td>Rp {{number_format($item->total)}}</td>
            </tr>

        @endforeach
        </tbody>
    </table>
@endsection
