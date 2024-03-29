@extends('layouts.cetak')

@section('content')

    <table>
        <thead>
        <tr>
            <th style="">No</th>
            <th>Bulan</th>
            <th>Kas masuk</th>
            <th>Kas keluar</th>
            <th>Keuntungan</th>

        </tr>
        </thead>

        <tbody>
        {{--        @dd($keuntungan)--}}
        @foreach($keuntungan as $item)

            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item['bulan']}}</td>
                <td>Rp {{number_format($item['kasMasuk'],0,",",".")}}</td>
                <td>Rp {{number_format($item['kasKeluar'],0,",",".")}}</td>
                <td>Rp {{number_format($item['kasMasuk'] - $item['kasKeluar'],0,",",".")}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
@endsection
