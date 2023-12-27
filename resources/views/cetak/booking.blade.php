<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>


<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Akun</th>
        <th>Nama pemesan</th>
        <th>Brand</th>
        <th>Item</th>
        <th>Mulai</th>
        <th>Selesai</th>
        <th>Status booking</th>
        <th>Status pembayaran</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bookings as $booking)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$booking->user->name}}</td>
            <td>{{$booking->name}}</td>
            <td>{{$booking->item->brand->name}}</td>
            <td>{{$booking->name}}</td>
            <td>{{$booking->start_date}}</td>
            <td>{{$booking->end_date}}</td>
            <td>{{$booking->status}}</td>
            <td>{{$booking->payment_status}}</td>
            <td>{{$booking->total_price}}</td>
        </tr>

    @endforeach
    </tbody>
</table>

</body>
</html>
