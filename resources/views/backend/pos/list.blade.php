@extends('layouts.app')

@section('content')
    <div>
        <h2>Product List</h2>
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
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <h4>Total Amount to Pay: ${{ $totalAmount }}</h4>
            <form method="POST" action="{{ route('cash-register.update-totals') }}">
                @csrf
                <div class="form-group">
                    <label for="tax">Tax (%):</label>
                    <input type="number" class="form-control" id="tax" name="tax" value="{{ $tax }}" step="0.01">
                </div>
                <div class="form-group">
                    <label for="discount">Discount:</label>
                    <input type="number" class="form-control" id="discount" name="discount" value="{{ $discount }}" step="0.01">
                </div>
                <button type="submit" class="btn btn-primary">Update Totals</button>
            </form>
        </div>
    </div>
@endsection
