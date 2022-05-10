<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>Submit Payment Doku</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/floating-labels/floating-labels.css" rel="stylesheet">
</head>

<body>
<form class="form-signin" action="{{base_url('api/pay/submit')}}" method="post">
    <div class="text-center mb-4">
        <img class="mb-4" src="https://getbootstrap.com/docs/4.1/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Payment Detail</h1>
    </div>
    <div class="form-label-group">
        <input type="text" id="amount" class="form-control" name="AMOUNT" placeholder="AMOUNT" value="10000.00" required>
    </div>
    <div class="form-label-group">
        <input type="text" id="trans_id" class="form-control" name="TRANSIDMERCHANT" placeholder="TRANSIDMERCHANT" value="INV-003" required>
    </div>
    <div class="form-label-group">
        <input type="text" id="payment_channel" class="form-control" name="PAYMENTCHANNEL" placeholder="PAYMENTCHANNEL" value="15" required>
    </div>
    <div class="form-label-group">
        <input type="text" id="payment_channel" class="form-control" name="NAME" placeholder="NAME" value="nur zazin" required>
    </div>
    <div class="form-label-group">
        <input type="text" id="payment_channel" class="form-control" name="EMAIL" placeholder="EMAIL" value="nurza.cool@gmail.com" required>
    </div>
    <div class="form-label-group">
        <input type="text" id="payment_channel" class="form-control" name="MOBILEPHONE" placeholder="MOBILEPHONE" value="6289654564500" required>
    </div>
    <div class="form-label-group">
        <input type="text" id="payment_channel" class="form-control" name="BASKET" placeholder="BASKET" value="KIDSFUN PARC,10000.00,1,10000.00" required>
    </div>
    <div class="form-label-group">
        <input type="text" id="payment_channel" class="form-control" name="SHIPPING_ADDRESS" placeholder="SHIPPING_ADDRESS" value="yogyakarta" required>
    </div>
    <div class="form-label-group">
        <input type="text" id="payment_channel" class="form-control" name="SHIPPING_CITY" placeholder="SHIPPING_CITY" value="sleman" required>
    </div>
    <div class="form-label-group">
        <input type="text" id="payment_channel" class="form-control" name="SHIPPING_STATE" placeholder="SHIPPING_STATE" value="indonesia" required>
    </div>
    <div class="form-label-group">
        <input type="text" id="payment_channel" class="form-control" name="SHIPPING_ZIPCODE" placeholder="SHIPPING_ZIPCODE" value="55283" required>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Pay</button>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2018</p>
</form>
</body>
</html>