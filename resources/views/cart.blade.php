@extends('layouts')

@section('content')
    <!-- Search Form-->
    <div class="container">
        <div class="search-form pt-3 rtl-flex-d-row-r">
            <div class="dropdown">
                <input type="text" class="search-input" placeholder="Search" oninput="filterDropdown()">
                <div class="dropdown-list" id="dropdownList">
                    <div class="dropdown-item">Option 1</div>
                    <div class="dropdown-item">Option 2</div>
                    <div class="dropdown-item">Option 3</div>
                    <div class="dropdown-item">Option 4</div>
                    <div class="dropdown-item">Option 5</div>
                    <div class="dropdown-item">Option 6</div>
                    <!-- Add more options here -->
                </div>
            </div>
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

            <!-- Cart Amount Area-->
            <!-- Cart Amount Area-->
            <div class="card cart-amount-area">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <button class="btn btn-danger" onclick="clearCart()">Clear All</button>
                    <h5 class="total-price mb-0"><span id="totalPrice">0.00</span></h5>
                    <a class="btn btn-warning" href="checkout.html">Checkout Now</a>
                   
                </div>
            </div>



        </div>
    </div>
@endsection

@push('styles')

<style>
    /* Style for the dropdown container */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Style for the input field */
    .search-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Style for the dropdown list */
    .dropdown-list {
        display: none;
        position: absolute;
        z-index: 1;
        max-height: 150px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-top: none;
        width: 100%;
    }

    /* Style for list items */
    .dropdown-item {
        padding: 10px;
        cursor: pointer;
    }

    /* Style for selected item */
    .selected {
        background-color: #f0f0f0;
    }
</style>
    
@endpush

@push('scripts')
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
    function filterDropdown() {
        var input, filter, dropdown, items, item, i, value;
        input = document.querySelector(".search-input");
        filter = input.value.toUpperCase();
        dropdown = document.getElementById("dropdownList");
        items = dropdown.getElementsByClassName("dropdown-item");

        for (i = 0; i < items.length; i++) {
            item = items[i];
            value = item.textContent || item.innerText;
            if (value.toUpperCase().indexOf(filter) > -1) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        }
    }

    // Toggle the dropdown list on input focus
    document.querySelector(".search-input").addEventListener("focus", function () {
        document.querySelector(".dropdown-list").style.display = "block";
    });

    // Close the dropdown list when clicking outside of it
    window.addEventListener("click", function (event) {
        if (!event.target.matches(".search-input")) {
            var dropdowns = document.querySelectorAll(".dropdown-list");
            dropdowns.forEach(function (dropdown) {
                dropdown.style.display = "none";
            });
        }
    });
</script>
@endpush
