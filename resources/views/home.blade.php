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

            // Identify the correct quantity input for this product
            var quantityInput = document.querySelector('[data-product-id="' + productId + '"]');

            // Check if the quantityInput is found
            if (quantityInput) {
                var productQuantity = parseInt(quantityInput.value);

                // Create a product object
                var product = {
                    id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: productQuantity
                };

                // Handle adding the product to the cart or perform any other actions
                // ...

                // You can also update a cart UI element here if needed
            }
        });
    });
</script>


@endpush