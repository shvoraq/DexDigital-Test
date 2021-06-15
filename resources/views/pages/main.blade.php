@extends('partials.default')

@section('title')Статус ответа: {{ $request->status }}@endsection

@section('content')
    <div class="container">
        <h1>Статус ответа: {{ $request->status }}</h1>

        @if($request->message)
            <h2>Ошибка транзакции:</h2>
            <p>{{ $request->message }}</p>
        @endif

        @if($request->errors)
            <h2>Ошибки валидации:</h2>
            @foreach($request->errors as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <h2>Транзакции</h2>

        <div class="row">

            @foreach($request->transactions as $transaction)
                @foreach($transaction as $key => $item)
                    @if(!is_array($item))
                        <div class="col-6">{{ $key }}</div>
                        <div class="col-6">{{ $item }}</div>
                    @endif
                @endforeach
            @endforeach

        </div>

        <h2>Ордер</h2>

        <div class="row">

            @foreach($request->order as $key => $item)
                <div class="col-6">{{ $key }}</div>
                <div class="col-6">{{ $item }}</div>
            @endforeach

        </div>
    </div>
@endsection
