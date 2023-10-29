@extends('layouts')

@section('content')
    <!-- Search Form-->
    <div class="container">
        <div class="search-form pt-3 rtl-flex-d-row-r">
            <form action="#" method="">
                <input class="form-control" type="search" placeholder="Search in SAT">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <livewire:category-products />
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add a click event listener to all product-thumbnails
            document.querySelectorAll('.product-thumbnail').forEach(function(thumbnail) {
                thumbnail.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Get the product information from the data attributes
                    var productId = thumbnail.getAttribute('data-product-id');
                    var productName = thumbnail.getAttribute('data-product-name');
                    var productPrice = parseFloat(thumbnail.getAttribute('data-product-price'));

                    // Identify the correct quantity input for this product
                    var quantityInput = document.querySelector('[data-input-id="' + productId +
                        '"]');

                    // Check if the quantityInput is found
                    if (quantityInput) {
                        var productQuantity = parseInt(quantityInput.value);
                        // Ensure that the new quantity is at least 1
                        if (productQuantity < 1) {
                            productQuantity = 1;
                        }

                        // Create a product object
                        var product = {
                            id: productId,
                            name: productName,
                            price: productPrice,
                            quantity: productQuantity
                        };



                        // Handle adding the product to the cart or perform any other actions
                        // Get the current cart from localStorage (if it exists)
                        var cart = JSON.parse(localStorage.getItem('cart')) || {};
                        // Check if the product already exists in the cart
                        if (cart.hasOwnProperty(productId)) {
                            // Product already exists, increase the quantity
                            cart[productId].quantity += productQuantity;
                        } else {
                            // Product does not exist, add the product
                            cart[productId] = product;
                        }

                        // Save the cart to localStorage
                        localStorage.setItem('cart', JSON.stringify(cart));

                        // Now console log the cart
                        console.log(cart);
                    }
                });
            });
        });
    </script>
@endpush
