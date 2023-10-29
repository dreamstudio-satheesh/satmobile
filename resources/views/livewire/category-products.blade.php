<div>

        <!-- Search Form-->
        <div class="container">
            <div class="search-form pt-3 rtl-flex-d-row-r">
                <form action="#" method="">
                    <input class="form-control" type="text" wire:model.live="search" placeholder="Search in SAT">                    
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>                    
                </form>
                <!-- Alternative Search Options -->
                <div class="alternative-search-options">
                    <div class="dropdown"><a class="btn btn-danger dropdown-toggle" id="altSearchOption" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                                class="fa-solid fa-sliders"></i></a>
                        <!-- Dropdown Menu -->
                        
                    </div>
                </div>
            </div>
        </div>


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
                                            $image = str_replace('https://mobile.satsweets.com', 'https://satsweets.com', $image);
                                        @endphp
                                        <img src="{{ $image }}">
                                    @else
                                        <img src="{{ url('') }}/img/noimage.png" alt="product">
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
                                <!-- Thumbnail --><a class="product-thumbnail d-block" href="#"
                                    data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                                    data-product-price="{{ $product->price }}">

                                    @if (!empty($product->getFirstMediaUrl('products')))
                                        @php
                                            $product_image = $product->getFirstMediaUrl('products', 'thumb');
                                            $product_image = str_replace('https://mobile.satsweets.com', 'https://satsweets.com', $product_image);
                                        @endphp
                                        <img src="{{ $product_image }}" class="mb-2">
                                    @else
                                        <img src="https://satsweets.com/assets/img/product/product29.jpg" class="img-fluid img-thumbnail"
                                            alt="img">
                                    @endif

                                </a>
                                <!-- Product Title --><a class="product-title" href="">{{ $product->name }}</a>


                                <div class="cart-form">
                                    <div class="order-plus-minus d-flex align-items-center">
                                        <div class="quantity-button-handler">-</div>
                                        <input class="form-control cart-quantity-input" type="number" step="1"
                                            name="quantity" value="1" data-input-id="{{ $product->id }}">
                                        <div class="quantity-button-handler">+</div>
                                    </div>


                                </div>



                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- Top Products -->
</div>
