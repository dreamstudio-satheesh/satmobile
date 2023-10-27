<div class="container">
    <!-- Cart Wrapper-->
    <div class="cart-wrapper-area py-3">
        <div class="cart-table card mb-3">
            <div class="table-responsive card-body">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <table class="table mb-0">
                    <tbody>
                        @foreach($cart as $productId => $productDetails)
                            <tr>
                                <td>{{ $productDetails['name'] }}</td>
                                <td>{{ $productDetails['price'] }}</td>
                                <td>
                                    <input type="number" min="1" value="{{ $productDetails['quantity'] }}" wire:change="updateQuantity({{ $productId }}, $event.target.value)">
                                </td>
                                <td>{{ $productDetails['price'] * $productDetails['quantity'] }}</td>
                                <td>
                                    <button wire:click="removeFromCart({{ $productId }})">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
     
    </div>
</div>
