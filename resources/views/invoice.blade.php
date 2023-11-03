
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="SAT SWEETS Invoice">
    <meta name="keywords" content="bill , receipt">
    <meta name="author" content="initTheme">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAT SWEETS - invoice  </title>
    <link rel="icon" href="{{ url('img/icons/icon-72x72.png')}}">
    
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main-style.css')}}">
</head>
<body class="section-bg-one">
    <main class="container receipt-wrapper" id="download-section">
        <div class="receipt-heading"><span>cash memo</span></div>
        <ul class="text-list text-style1 mb-20">
            <li>
                <div class="text-list-title">Date:</div>
                <div class="text-list-desc">12/12/2023</div>
            </li>
            <li class="text-right">
                <div class="text-list-title">Time:</div>
                <div class="text-list-desc">01:00</div>
            </li>
            <li>
                <div class="text-list-title">Branch:</div>
                <div class="text-list-desc">Dhaka</div>
            </li>
            <li class="text-right">
                <div class="text-list-title">Receipt:</div>
                <div class="text-list-desc">#L21387</div>
            </li>
        </ul>
        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Beverages</td>
                    <td>$10</td>
                    <td>3</td>
                    <td>$10</td>
                </tr>
                <tr>
                    <td>Biscuit & Bakery.</td>
                    <td>$20</td>
                    <td>2</td>
                    <td>$20</td>
                </tr>
                <tr>
                    <td>Culinary.</td>
                    <td>$40</td>
                    <td>3</td>
                    <td>$40</td>
                </tr>
                <tr>
                    <td>Dairy</td>
                    <td>$50</td>
                    <td>4</td>
                    <td>$50</td>
                </tr>
                <tr>
                    <td>Noluisse</td>
                    <td>$20</td>
                    <td>3</td>
                    <td>$20</td>
                </tr>
                <tr>
                    <td>Culinary.</td>
                    <td>$40</td>
                    <td>3</td>
                    <td>$40</td>
                </tr>
                <tr>
                    <td>Dairy</td>
                    <td>$70</td>
                    <td>1</td>
                    <td>$70</td>
                </tr>
                <tr>
                    <td>Confectionery.</td>
                    <td>$58</td>
                    <td>2</td>
                    <td>$58</td>
                </tr>
                <tr>
                    <td>Dairy</td>
                    <td>$90</td>
                    <td>1</td>
                    <td>$64</td>
                </tr>
            </tbody>
        </table>
        <div class="text-bill-list mb-15">
            <div class="text-bill-list-in">
                <div class="text-bill-title">Sub-Total:</div>
                <div class="text-bill-value">$1010.00</div>
            </div>
            <div class="text-bill-list-in">
                <div class="text-bill-title">Discount: </div>
                <div class="text-bill-value">-$106.00</div>
            </div>
            <div class="text-receipt-seperator"></div>
            <div class="text-bill-list-in">
                <div class="text-bill-title">Service charge:</div>
                <div class="text-bill-value">0.00$</div>
            </div>
            <div class="text-bill-list-in">
                <div class="text-bill-title">Tax(15%):</div>
                <div class="text-bill-value">$47</div>
            </div>
            <div class="text-receipt-seperator"></div>
            <div class="text-bill-list-in">
                <div class="text-bill-title">Total Bill:</div>
                <div class="text-bill-value">$1257</div>
            </div>
            <div class="text-receipt-seperator"></div>
            <div class="text-bill-list-in">
                <div class="text-bill-title text-bill-focus">Change amount</div>
                <div class="text-bill-value text-bill-focus">985.00$</div>
            </div>
        </div>
        <div class="tm_pos_sample_text mb-15">
            <img src="assets/images/bar-code.png" alt="img">
        </div>
        <div class="receipt-top">
            <div class="company-name">initTheme Limited</div>
            <div class="company-address">1216 R. Dhaka, Mirpur,  Bangladesh</div>
            <div class="company-mobile">Email: inittheme@gmail.com</div>
        </div>
        <div class="mb-0">
            <span class="text-uppercase text-12 bg-title text-white pa-10 d-block text-center">call fro home delivery +3254158245</span>
        </div>
    </main>

</body>
</html>