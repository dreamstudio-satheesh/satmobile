
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
        <div class="receipt-heading"><span>Invoice</span></div>
        <ul class="text-list text-style1 mb-20">
            <li>
                <div class="text-list-title">Date:</div>
                <div class="text-list-desc"> {{ \Carbon\Carbon::parse($invoice->date)->format('d/m/Y')}}</div>
            </li>
            <li class="text-right">
                <div class="text-list-title">INV:</div>
                <div class="text-list-desc">#{{ str_pad($invoice->invoice_number, 4, '0', STR_PAD_LEFT) }}/23-24</div>
            </li>
            <li>
                <div class="text-list-title"> {{ $invoice->customer->name}}:</div>
                <div class="text-list-desc"></div>
            </li>
            <li class="text-right">
                <div class="text-list-title"></div>
                <div class="text-list-desc"> {{ $invoice->customer->address}}</div>
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
                @foreach ($invoice->invoice_items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>₹{{ number_format($item->price ,2) }}</td>
                    <td>{{ number_format($item->quantity,2) }}</td>
                    <td>₹{{ number_format($item->quantity * $item->price,2) }}</td>
                </tr>
                @endforeach
              
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
       {{--  <div class="tm_pos_sample_text mb-15">
            <img src="assets/images/bar-code.png" alt="img">
        </div> --}}
        <div class="receipt-top">
            <div class="company-name">SAT SWEETS</div>
            <div class="company-address">3/147 Karunaipalayam Pirivu,  Covai-</div>
            <div class="company-address">Tiruchy Main Road, Kangeyam -638701</div>
            <div class="company-mobile">GST NO :33ATOPR7702H1ZF</div>
        </div>
        <div class="mb-0">
            <span class="text-uppercase text-12 bg-title text-white pa-10 d-block text-center">Mobile: 90874 49924</span>
        </div>
    </main>

</body>
</html>