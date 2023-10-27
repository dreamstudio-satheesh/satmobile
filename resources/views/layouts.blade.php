<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="SAT - Sweets Home">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags -->
    <!-- Title -->
    <title>SAT - Sweets Home Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="img/icons/icon-72x72.png">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/brands.min.css">
    <link rel="stylesheet" href="css/solid.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">
    <!-- Web App Manifest -->
    <link rel="manifest" href="manifest.json">
</head>

<body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
        <div class="spinner-grow text-secondary" role="status">
            <div class="sr-only"></div>
        </div>
    </div>
    <!-- Header Area -->
    <div class="header-area" id="headerArea">
        <div class="container h-100 d-flex align-items-center justify-content-between d-flex rtl-flex-d-row-r">
            <!-- Logo Wrapper -->
            <div class="logo-wrapper"><a href="home.html"><img src="img/core-img/logo-small.png" alt=""></a>
            </div>
            <div class="navbar-logo-container d-flex align-items-center">
                <!-- Cart Icon -->
                <div class="cart-icon-wrap"><a href="cart.html"><i
                            class="fa-solid fa-bag-shopping"></i><span>2</span></a></div>
                <!-- User Profile Icon -->
                <div class="user-profile-icon ms-2"><a href="profile.html"><img src="img/bg-img/9.jpg"
                            alt=""></a></div>
                <!-- Navbar Toggler -->
                <div class="suha-navbar-toggler ms-2" data-bs-toggle="offcanvas" data-bs-target="#suhaOffcanvas"
                    aria-controls="suhaOffcanvas">
                    <div><span></span><span></span><span></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start suha-offcanvas-wrap" tabindex="-1" id="suhaOffcanvas"
        aria-labelledby="suhaOffcanvasLabel">
        <!-- Close button-->
        <button class="btn-close btn-close-white" type="button" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        <!-- Offcanvas body-->
        <div class="offcanvas-body">
            <!-- Sidenav Profile-->
            <div class="sidenav-profile">
                <div class="user-profile"><img src="img/bg-img/9.jpg" alt=""></div>
                <div class="user-info">
                    <h5 class="user-name mb-1 text-white">SAT Sarah</h5>
                    <p class="available-balance text-white">Available points <span class="counter">499</span></p>
                </div>
            </div>
            <!-- Sidenav Nav-->
            <ul class="sidenav-nav ps-0">
                <li><a href="profile.html"><i class="fa-solid fa-user"></i>My Profile</a></li>
                <li><a href="notifications.html"><i class="fa-solid fa-bell lni-tada-effect"></i>Notifications<span
                            class="ms-1 badge badge-warning">3</span></a></li>
                <li class="suha-dropdown-menu"><a href="#"><i class="fa-solid fa-store"></i>Shop Pages</a>
                    <ul>
                        <li><a href="shop-grid.html">Shop Grid</a></li>
                        <li><a href="shop-list.html">Shop List</a></li>
                        <li><a href="single-product.html">Product Details</a></li>
                        <li><a href="featured-products.html">Featured Products</a></li>
                        <li><a href="flash-sale.html">Flash Sale</a></li>
                    </ul>
                </li>
                <li><a href="pages.html"><i class="fa-solid fa-file-code"></i>All Pages</a></li>
                <li class="suha-dropdown-menu"><a href="wishlist-grid.html"><i class="fa-solid fa-heart"></i>My
                        Wishlist</a>
                    <ul>
                        <li><a href="wishlist-grid.html">Wishlist Grid</a></li>
                        <li><a href="wishlist-list.html">Wishlist List</a></li>
                    </ul>
                </li>
                <li><a href="settings.html"><i class="fa-solid fa-sliders"></i>Settings</a></li>
                <li> <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-toggle-off"></i> {{ __('Sign Out') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


            </ul>
        </div>
    </div>

    <div class="page-content-wrapper">
        
        @yield('content')


        <!-- Internet Connection Status-->
        <div class="internet-connection-status" id="internetStatus"></div>
        <!-- Footer Nav-->
        <div class="footer-nav-area" id="footerNav">
            <div class="suha-footer-nav">
                <ul class="h-100 d-flex align-items-center justify-content-between ps-0 d-flex rtl-flex-d-row-r">
                    <li><a href="home.html"><i class="fa-solid fa-house"></i>Home</a></li>
                    <li><a href="message.html"><i class="fa-solid fa-comment-dots"></i>Chat</a></li>
                    <li><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i>Basket</a></li>
                    <li><a href="settings.html"><i class="fa-solid fa-gear"></i>Settings</a></li>
                    <li><a href="pages.html"><i class="fa-solid fa-heart"></i>Pages</a></li>
                </ul>
            </div>
        </div>
        <!-- All JavaScript Files-->
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/waypoints.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery.counterup.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/jquery.passwordstrength.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script src="js/theme-switching.js"></script>
        <script src="js/no-internet.js"></script>
        <script src="js/active.js"></script>
        <script src="js/pwa.js"></script>
</body>

</html>
