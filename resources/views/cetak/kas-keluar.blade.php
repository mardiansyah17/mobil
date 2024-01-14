@extends('layouts.cetak')

@section('content')

    <table style="font-size: 20px;">
        <tr>
            <td style="width: 200px;border: none!important;">Total pengeluaran</td>
            <td style="width: 10px;border: none!important;">:</td>
            <td style="border: none!important;">Rp {{number_format($total,0,",",".")}}</td>
        </tr>
    </table>
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis pengeluaran</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Quantity</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($kas as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->jenis_pengeluaran}}</td>
                <td>{{$item->keterangan}}</td>
                <td>{{$item->tanggal}}</td>
                <td>{{$item->quantity}}</td>
                <td>Rp {{number_format($item->harga,0,",",".")}}</td>
                <td>Rp {{number_format($item->total,0,",",".")}}</td>
            </tr>

        @endforeach
        </tbody>
    </table>
@endsection
