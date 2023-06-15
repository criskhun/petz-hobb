@extends('layouts.app')

@section('content')
    <div>
        <h2>Receipt</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product->title }}</td>
                        <td>{{ $product->product->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <h4>Total Amount Paid: ${{ $totalAmount }}</h4>
        </div>
    </div>
@endsection
