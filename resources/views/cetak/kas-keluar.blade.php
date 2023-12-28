@extends('layouts.cetak')

@section('content')
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
                <td>{{$item->harga}}</td>
                <td>{{$item->total}}</td>
            </tr>

        @endforeach
        </tbody>
    </table>
@endsection
