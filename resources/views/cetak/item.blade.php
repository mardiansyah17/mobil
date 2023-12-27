<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item</title>
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
        <th>Nama</th>
        <th>Brand</th>
        <th>Type</th>
        <th>Fitur</th>
        <th>Harga</th>
        <th>Rating</th>
        <th>Review</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->brand->name}}</td>
            <td>{{$item->type->name}}</td>
            <td>{{$item->features}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->star}}</td>
            <td>{{$item->review}}</td>
        </tr>

    @endforeach
    </tbody>
</table>

</body>
</html>
