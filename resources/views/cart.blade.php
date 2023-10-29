@extends('layouts')

@section('content')
    <!-- Search Form-->
    <div class="container">
        <div class="search-form pt-3 rtl-flex-d-row-r">
            <select id="myDropdown" class="form-select" aria-label="Select Customer">
                <option selected>Select Customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }} - {{ Str::limit($customer->address, 20) }}
                    </option>
                @endforeach
            </select>
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

            <!-- Cart Amount Area-->
            <!-- Cart Amount Area-->
            <div class="card cart-amount-area">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <button class="btn btn-danger" onclick="clearCart()">Clear All</button>
                    <h5 class="total-price mb-0"><span id="totalPrice">0.00</span></h5>
                    <a class="btn btn-warning" id="checkoutButton" href="#">Checkout Now</a>

                </div>
            </div>



        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        // Retrieve cart data from localStorage
        var cartData = JSON.parse(localStorage.getItem('cart')) || {};


        // Function to calculate and update the cart's total amount
        function updateCartTotal() {
            var total = 0;
            for (var productId in cartData) {
                var productDetails = cartData[productId];
                total += productDetails.price * productDetails.quantity;
            }
            return total;
        }

        // Function to render the cart items and update the total price
        function renderCartItems() {
            var cartBody = document.getElementById('cart-body');
            cartBody.innerHTML = '';

            // Check if the cart is empty
            if (Object.keys(cartData).length === 0) {
                // Display a message indicating that the cart is empty
                var emptyCartMessage = document.createElement('tr');
                emptyCartMessage.innerHTML = `
            <td colspan="5">Your cart is empty.</td>
        `;
                cartBody.appendChild(emptyCartMessage);
            } else {
                // Render cart items
                for (var productId in cartData) {
                    var productDetails = cartData[productId];
                    var row = document.createElement('tr');
                    row.innerHTML = `
                <td>${productDetails.name}</td>
                <td>${productDetails.price}</td>                    
                <td>
                    <div class="quantity">
                        <input class="qty-text" type="number" min="1" value="${productDetails.quantity}" onchange="updateQuantity(${productId}, this.value)">
                    </div>
                </td>
                <td>${(productDetails.price * productDetails.quantity).toFixed(2)}</td>
                <td>
                    <a class="remove-product" onclick="removeFromCart(${productId})"><i class="fa-solid fa-xmark"></i></a>
                </td>
            `;

                    cartBody.appendChild(row);
                }


            }

            // Calculate and update the cart's total amount
            var total = updateCartTotal();

            // Get the <span> element by its id "totalPrice"
            var totalPriceSpan = document.getElementById('totalPrice');

            // Update the total price with 2 decimal places
            totalPriceSpan.textContent = '₹' + total.toFixed(2);


        }



        // Use the DOMContentLoaded event to ensure the DOM is ready
        document.addEventListener("DOMContentLoaded", function() {
            // Initial rendering of cart items
            renderCartItems();
        });


        function updateQuantity(productId, newQuantity) {
            // Parse the new quantity as an integer
            newQuantity = parseInt(newQuantity);

            // Ensure that the new quantity is at least 1
            if (newQuantity < 1) {
                newQuantity = 1;
            }

            // Update the cartData object with the validated quantity
            cartData[productId].quantity = newQuantity;

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
    </script>



    <script>
        $(document).ready(function() {
            $('#myDropdown').select2();
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Event listener for the "Checkout Now" button
            document.getElementById('checkoutButton').addEventListener('click', function(event) {
                event.preventDefault();

                // Get the selected customer ID from the dropdown
                var selectedCustomerId = $('#myDropdown').val();

                // Retrieve the cart data from local storage
                var cartData = JSON.parse(localStorage.getItem('cart')) || {};

                // Create an object to hold the checkout data
                var checkoutData = {
                    customerId: selectedCustomerId,
                    cartItems: cartData
                };

                // Send the checkout data to the server (You will need to implement this part)
                // Example using AJAX:
                $.ajax({
                    url: '/checkout', // Replace with the actual URL for your server endpoint
                    method: 'POST',
                    data: JSON.stringify(checkoutData),
                    contentType: 'application/json',
                    success: function(response) {
                        // Handle the server response here (e.g., display a success message)
                        console.log('Checkout successful:', response);

                        // Clear the cart after successful checkout
                        clearCart();
                    },
                    error: function(error) {
                        // Handle any errors from the server
                        console.error('Checkout error:', error);
                    }
                });
            });
        });
    </script>
@endpush
