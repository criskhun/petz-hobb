@foreach($selectedProducts as $product)
<tr>
    <td>{{ $product->id }}</td>
    <td>{{ $product->product->title }}</td>
    <td>{{ $product->product->price }}</td>
    <td>
        <button class="btn btn-danger btn-sm" onclick="removeProduct({{ $product->id }})">
            Remove
        </button>
    </td>
</tr>
@endforeach
