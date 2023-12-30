<! -- resources/views/cashier/index.blade.php 

@extends('navigation.app.php') <! --

@section('content') 
    <h1>Cashier Page</h1>

    <p> Welcome to the Cashier page!</p>

    <h2>Transactions</h2>
    <ul>
        @foreach (transactions as $transactions)
            <li>{{ $transactions->description }} - ${{ $transaction->amount }}</li>
        @endforeach
    </ul>
@endsection 