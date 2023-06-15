@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Products</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="addProduct({{ $product->id }})">
                                    Add
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Selected Products</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="selected-products">
                        <!-- Selected products will be dynamically added here -->
                    </tbody>
                </table>
                <hr>
                <div class="form-group">
                    <label for="vat">VAT (%)</label>
                    <input type="number" class="form-control" id="vat" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" class="form-control" id="discount" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label for="amount-paid">Amount Paid</label>
                    <input type="number" class="form-control" id="amount-paid" min="0" step="0.01">
                </div>
                <button class="btn btn-primary" onclick="printReceipt()">Print Receipt</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add product to selected list
    function addProduct(productId) {
        // Make an AJAX request to add the product
        $.ajax({
            url: "{{ route('cash-register.add-product') }}",
            method: "POST",
            data: {
                product_id: productId,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                // Update the selected products table
                $('#selected-products').html(response.html);
            }
        });
    }

    // Remove product from selected list
    function removeProduct(productId) {
        // Make an AJAX request to remove the product
        $.ajax({
            url: "{{ route('cash-register.remove-product') }}",
            method: "POST",
            data: {
                product_id: productId,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                // Update the selected products table
                $('#selected-products').html(response.html);
            }
        });
    }

    // Print receipt
    function printReceipt() {
        var vat = parseFloat($('#vat').val()) || 0;
        var discount = parseFloat($('#discount').val()) || 0;
        var amountPaid = parseFloat($('#amount-paid').val()) || 0;

        // Make an AJAX request to print the receipt
        $.ajax({
            url: "{{ route('cash-register.print-receipt') }}",
            method: "POST",
            data: {
                vat: vat,
                discount: discount,
                amount_paid: amountPaid,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                // Print the receipt or display a success message
                alert('Receipt printed!');
            }
        });
    }
</script>
@endpush
