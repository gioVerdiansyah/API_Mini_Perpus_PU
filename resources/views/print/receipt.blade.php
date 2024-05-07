<style>
    #invoice-POS {
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        padding: 2mm;
        margin: 0 auto;
        width: 44mm;
        background: #fff;
        border: 2px solid black;
        border-radius: 10px;
    }

    #invoice-POS ::selection {
        background: #f31544;
        color: #FFF;
    }

    #invoice-POS ::moz-selection {
        background: #f31544;
        color: #FFF;
    }

    #invoice-POS h1 {
        font-size: 1.5em;
        color: #222;
    }

    #invoice-POS h2 {
        font-size: 0.9em;
        margin: 0;
        margin-bottom: 5px;
    }

    #invoice-POS h3 {
        font-size: 1.2em;
        font-weight: 300;
        line-height: 2em;
    }

    #invoice-POS p {
        font-size: 0.7em;
        color: #666;
        line-height: 1.2em;
        margin: 0;
    }

    #invoice-POS #top,
    #invoice-POS #mid,
    #invoice-POS #bot {
        /* Targets all id with 'col-' */
        border-bottom: 1px solid #EEE;
    }

    #invoice-POS #top {
        min-height: 100px;
    }

    #invoice-POS #mid {
        min-height: 80px;
    }

    #invoice-POS #bot {
        min-height: 50px;
    }

    #invoice-POS #top .logo {
        height: 60px;
        width: 60px;
        background: url(http://127.0.0.1:8001/assets/book-logo.png) no-repeat;
        background-size: 60px 60px;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
    }
    #invoice-POS .info p{
        font-size: 10px;
    }

    #invoice-POS .info {
        display: block;
        margin-left: 0;
    }

    #invoice-POS .title {
        float: right;
    }

    #invoice-POS .title p {
        text-align: right;
    }

    #invoice-POS table {
        width: 100%;
        border-collapse: collapse;
    }

    #invoice-POS .tabletitle {
        font-size: 0.5em;
        background: #EEE;
    }

    #invoice-POS .tableitem {
        width: 30%;
        word-wrap: break-word;
        overflow-wrap: break-word;
        text-align: center;
    }

    #invoice-POS .service {
        border-bottom: 1px solid #EEE;
    }

    #invoice-POS .item {
        width: 24mm;
    }

    #invoice-POS .itemtext {
        font-size: 0.5em;
    }

    #invoice-POS #legalcopy {
        margin-top: 5mm;
    }

    .legal {
        text-align: center
    }

    .owner-info p {
        text-align: center;
        margin: 0;
        font-size: 8px !important
    }

    .longText {
        width: 80;
        text-align: left;
    }
</style>

<div id="invoice-POS">

    <center id="top">
        <div class="logo"></div>
        <div class="info">
            <h2>Mini Perpus UP</h2>
        </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="mid">
        <div class="info">
            <h2>Customer Info</h2>
            <p>
                No. : {{ $data['customer']['number'] }}</br>
                Name : {{ $data['customer']['name'] }}</br>
                Address : {{ $data['customer']['address'] }}</br>
            </p>
        </div>
    </div><!--End Invoice Mid-->

    <div id="bot">

        <div id="table">
            <table>
                <thead>
                    <tr class="tabletitle">
                        <th class="item">
                            <h2>Book</h2>
                        </th>
                        <th class="Hours">
                            <h2>Qty</h2>
                        </th>
                        <th class="Rate">
                            <h2>Rental <br> price</h2>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="service">
                        <td class="tableitem" style="max-width: 30%; word-wrap: break-word; overflow-wrap: break-word;">
                            <p class="itemtext longText">{{ $data['book']['title'] }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">{{ $data['total'] }}</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">{{ 'Rp ' . number_format($data['tax'], 0, ',', '.') }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div><!--End Table-->

        <div id="legalcopy">
            <p class="legal"><strong>Thank you for your payment!</strong>
            </p>
            <div class="owner-info">
                <p>verdi@owner.com</p>
                <p>082123456789</p>
                <p>Kab Madiun, Kec Mejayan, Jl Imam Bonjol</p>
            </div>
        </div>

    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
