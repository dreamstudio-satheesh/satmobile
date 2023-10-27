<div>
    <!-- Product Catagories -->
    <div class="product-catagories-wrapper py-3">
        <div class="container">
            <div class="row g-2 rtl-flex-d-row-r">
                @foreach ($categories as $category)
                    <!-- Catagory Card -->
                    <div class="col-3">
                        <div class="card catagory-card {{ $selectedCategory == $category->id ? 'active' : '' }}">
                            <div class="card-body px-2"><a wire:click="showProducts({{ $category->id }})">
                                    @if (!empty($category->getFirstMediaUrl('categories')))
                                        @php
                                            $image = $category->getFirstMediaUrl('categories', 'thumb');
                                            $image = str_replace('http://localhost', 'https://satsweets.com', $image);
                                        @endphp
                                        <img src="{{ $image }}">
                                    @else
                                        <img src="{{ url('') }}/assets/img/product/noimage.png" alt="product">
                                    @endif
                                    <span>{{ $category->name }}</span>
                                </a></div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="top-products-area py-3">
        <div class="container">
            <div class="section-heading d-flex align-items-center justify-content-between dir-rtl">
                <h6>Products</h6>
            </div>
            <div class="row g-2">

                @foreach ($products as $product)
                    <!-- Product Card -->
                    <div class="col-6 col-md-4">
                        <div class="card product-card">
                            <div class="card-body">
                                <!-- Badge--><span class="badge rounded-pill badge-success">New</span>
                                <!-- Wishlist Button--><a class="wishlist-btn" href="#"><i
                                        class="fa-solid fa-heart">
                                    </i></a>
                                <!-- Thumbnail --><a class="product-thumbnail d-block" href="">

                                    @if (!empty($product->getFirstMediaUrl('products')))
                                        @php
                                            $product_image = $product->getFirstMediaUrl('products', 'thumb');
                                            $product_image = str_replace('http://localhost', 'https://satsweets.com', $product_image);
                                        @endphp
                                        <img src="{{ $product_image }}" class="mb-2">
                                    @else
                                        <img src="assets/img/product/product29.jpg" class="img-fluid img-thumbnail"
                                            alt="img">
                                    @endif

                                </a>
                                <!-- Product Title --><a class="product-title" href="">{{ $product->name }}</a>
                                <!-- Product Price -->
                                <br>
                                <div class="cart-form">
                                    <div class="order-plus-minus d-flex align-items-center">
                                        <div class="quantity-button-handler">-</div>
                                        <input class="form-control cart-quantity-input" type="text" step="1" name="quantity" value="1">
                                        <div class="quantity-button-handler">+</div>
                                      </div>
                                      <!-- Add to Cart -->
                                      <a class="btn btn-success btn-sm" href="#"><i class="fa-solid fa-plus"></i></a>

                                </div>
                               
                                <!-- Rating -->
                               
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Top Products -->
</div>
