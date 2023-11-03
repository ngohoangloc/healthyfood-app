<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/tabler.min.css') }}" rel="stylesheet" />
    <style>
        body {
            padding: 0;
            margin: 0;
            font-size: 70%;
        }
    </style>
</head>

<body>
    <div style="width: 55mm;">
        <div class="row">
            <div class="col-6 text-start">
                <h4><i>CHẾ BIẾN</i></h4>
            </div>
            <div class="col-6 text-end">
                <i><?= date('H:i d/m/Y') ?></i>
                <br>
                <b>{{ $order->table->area->name }} - {{ $order->table->name }}</b>
            </div>
        </div>
        <table class="table card-table" style="width: 100%;">
            <thead>
                <tr>
                    <th class="w-50">Món</th>
                    <th class="text-end">S.L</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $orderDetail)
                    <tr>
                        <td class="text-muted"><i>{{ $orderDetail->item->name }}</i></td>
                        <td class="text-muted text-end">
                            <i>{{ $orderDetail->quantity }}</i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
