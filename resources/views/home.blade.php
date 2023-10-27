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
          <div class="dropdown"><a class="btn btn-danger dropdown-toggle" id="altSearchOption"
                  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
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

<livewire:category-products />


@endsection


@push('scripts')
<script>
    // Add a click event listener to all product-thumbnails
    document.querySelectorAll('.product-thumbnail').forEach(function (thumbnail) {
        thumbnail.addEventListener('click', function (event) {
            event.preventDefault();

            // Get the product information from the data attributes
            var productId = thumbnail.getAttribute('data-product-id');
            var productName = thumbnail.getAttribute('data-product-name');
            var productPrice = parseFloat(thumbnail.getAttribute('data-product-price'));
            var productQuantity = parseInt(thumbnail.querySelector('.cart-quantity-input').value);

            // Create a product object
            var product = {
                id: productId,
                name: productName,
                price: productPrice,
                quantity: productQuantity
            };

            // Get the current cart from localStorage (if it exists)
            var cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Check if the product is already in the cart
            var existingProductIndex = cart.findIndex(function (item) {
                return item.id === productId;
            });

            if (existingProductIndex !== -1) {
                // If it is, update the quantity
                cart[existingProductIndex].quantity += productQuantity;
            } else {
                // If not, add it to the cart
                cart.push(product);
            }

            // Store the updated cart back in localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // You can also update a cart UI element here if needed
        });
    });
</script>

@endpush