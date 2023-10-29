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
        $(document).ready(function() {
            $('#myDropdown').select2();
        });

        // Get the selected customer ID from the dropdown
        var selectedCustomerId = $('#myDropdown').val();

        // Check if there is a previously selected customer in localStorage
        var storedCustomerId = localStorage.getItem('selectedCustomerId');

        // If a customer ID is stored in localStorage, select it in the dropdown
        if (storedCustomerId) {
            // Use the correct variable here (selectedCustomerId)
            selectedCustomerId = storedCustomerId;
            $('#myDropdown').val(selectedCustomerId); // Set the selected value in the dropdown
        }

        // Add an event listener to the customer select element
        $('#myDropdown').on('change', function() {
            // Get the selected customer ID
            var selectedCustomerId = $(this).val();

            // Check if a customer is selected (not empty)
            if (selectedCustomerId) {
                // Store the selected customer ID in localStorage
                localStorage.setItem('selectedCustomerId', selectedCustomerId);
            } else {
                // If no customer is selected, remove the stored value
                localStorage.removeItem('selectedCustomerId');
            }
        });



        document.addEventListener("DOMContentLoaded", function() {


            // Event listener for the "Checkout Now" button
            document.getElementById('checkoutButton').addEventListener('click', function(event) {
                event.preventDefault();

                // Check if a customer is selected
                if (selectedCustomerId === 'Select Customer') {
                    alert('Please select a customer first.');
                    return;
                }

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
