@extends('layouts')

@section('content')
    <!-- Search Form-->
    <div class="container">
        <div class="search-form pt-3 rtl-flex-d-row-r">
            <form action="#" method="">
                <input class="form-control" type="search" placeholder="Search in SAT">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <!-- Alternative Search Options -->
            <div class="alternative-search-options">
                <div class="dropdown"><a class="btn btn-danger dropdown-toggle" id="altSearchOption" href="#"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                            class="fa-solid fa-sliders"></i></a>
                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="altSearchOption">
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-microphone"> </i>Voice
                                Search</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-image"> </i>Image
                                Search</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <!-- Cart Wrapper-->
        <div class="cart-wrapper-area py-3">
            <div class="cart-table card mb-3">
                <div class="table-responsive card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cart-body">
                            <!-- Cart items will be dynamically added here using JavaScript -->
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Retrieve cart data from localStorage
        var cartData = JSON.parse(localStorage.getItem('cart'));
        // Function to render the cart items
        function renderCartItems() {
            var cartBody = document.getElementById('cart-body');
            cartBody.innerHTML = '';

            for (var productId in cartData) {
                var productDetails = cartData[productId];
                var row = document.createElement('tr');
                row.innerHTML = `
            <td>${productDetails.name}</td>
            <td>${productDetails.price}</td>                    
            <td>
                <div class="quantity"> <input class="qty-text" type="number" min="1" value="${productDetails.quantity}" onchange="updateQuantity(${productId}, this.value)"></div>
            </td>
            <td>${productDetails.price * productDetails.quantity}</td>
            <td>
                <button onclick="removeFromCart(${productId})">Remove</button>
            </td>
        `;

                cartBody.appendChild(row);
            }
        }

        // Function to update quantity
        function updateQuantity(productId, newQuantity) {
            // Update the cartData object
            cartData[productId].quantity = parseInt(newQuantity);
            // Call your backend to update the cart data as well

            // Re-render the cart items
            renderCartItems();

            // Save the updated cartData to localStorage
            localStorage.setItem('cart', JSON.stringify(cartData));
        }

        // Function to remove a product from the cart
        function removeFromCart(productId) {
            // Remove the product from cartData
            delete cartData[productId];
            // Call your backend to update the cart data as well

            // Re-render the cart items
            renderCartItems();

            // Save the updated cartData to localStorage
            localStorage.setItem('cart', JSON.stringify(cartData));
        }

        // Initial rendering of cart items
        renderCartItems();



        // Function to clear the entire cart
        function clearCart() {
            // Clear the cartData object
            cartData = {};
            // Call your backend to update the cart data as well

            // Re-render the cart items (will clear the UI)
            renderCartItems();

            // Clear the cart from localStorage
            localStorage.removeItem('cart');
        }

        // Call clearCart() when you want to clear the entire cart
    </script>
@endpush
