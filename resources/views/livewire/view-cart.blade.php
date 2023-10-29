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

                <script>
                    var cartData = @json($cart);
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
                                    <input type="number" min="1" value="${productDetails.quantity}" onchange="updateQuantity(${productId}, this.value)">
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
                    }

                    // Function to remove a product from the cart
                    function removeFromCart(productId) {
                        // Remove the product from cartData
                        delete cartData[productId];
                        // Call your backend to update the cart data as well

                        // Re-render the cart items
                        renderCartItems();
                    }

                    // Initial rendering of cart items
                    renderCartItems();
                </script>

            </div>
        </div>

    </div>
</div>
