@extends('partials.default')

@section('title'){{ $title }}@endsection

@section('content')
    <div class="container">
        <h1>Список ордеров</h1>
        @if($orders->count())
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Order id</th>
                        <th>Статус</th>
                        <th>Цена</th>
                        <th>Валюта</th>
                        <th>Описание</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->amount }}</td>
                            <td>{{ $order->currency }}</td>
                            <td>{{ $order->descriptor }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            Список ордеров пуст
        @endif

    </div>
@endsection
