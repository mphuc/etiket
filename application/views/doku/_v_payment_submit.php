<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment</title>
</head>
<body>
<p>Form submit To Doku</p>
<form id="param_pass" action="{submit}" method="post">
    <input type="hidden" id="MALLID" name="MALLID" value="{MALLID}">
    <input type="hidden" id="CHAINMERCHANT" name="CHAINMERCHANT" value="NA">
    <input type="hidden" id="AMOUNT" name="AMOUNT" value="{AMOUNT}">
    <input type="hidden" id="PURCHASEAMOUNT" name="PURCHASEAMOUNT" value="{PURCHASEAMOUNT}">
    <input type="hidden" id="TRANSIDMERCHANT" name="TRANSIDMERCHANT" value="{TRANSIDMERCHANT}">
    <input type="hidden" id="WORDS" name="WORDS" value="{WORDS}">
    <input type="hidden" id="REQUESTDATETIME" name="REQUESTDATETIME" value="{REQUESTDATETIME}">
    <input type="hidden" id="CURRENCY" name="CURRENCY" value="{CURRENCY}">
    <input type="hidden" id="PURCHASECURRENCY" name="PURCHASECURRENCY" value="{PURCHASECURRENCY}">
    <input type="hidden" id="SESSIONID" name="SESSIONID" value="{SESSIONID}">
    <input type="hidden" id="INSTALLMENT_ACQUIRER" name="INSTALLMENT_ACQUIRER" value="">
    <input type="hidden" id="TENOR" name="TENOR" value="{TENOR}">
    <input type="hidden" id="PROMOID" name="PROMOID" value="{PROMOID}">
    <input type="hidden" id="NAME" name="NAME" value="{NAME}">
    <input type="hidden" id="EMAIL" name="EMAIL" value="{EMAIL}">
    <input type="hidden" id="ADDITIONALDATA" name="ADDITIONALDATA" value="{ADDITIONALDATA}">
    <input type="hidden" id="BASKET" name="BASKET" value="{BASKET}">
    <input type="hidden" id="SHIPPING_ADDRESS" name="SHIPPING_ADDRESS" value="{SHIPPING_ADDRESS}">
    <input type="hidden" id="SHIPPING_CITY" name="SHIPPING_CITY" value="{SHIPPING_CITY}">
    <input type="hidden" id="SHIPPING_STATE" name="SHIPPING_STATE" value="{SHIPPING_STATE}">
    <input type="hidden" id="SHIPPING_COUNTRY" name="SHIPPING_COUNTRY" value="{SHIPPING_COUNTRY}">
    <input type="hidden" id="SHIPPING_ZIPCODE" name="SHIPPING_ZIPCODE" value="{SHIPPING_ZIPCODE}">
    <input type="hidden" id="PAYMENTCHANNEL" name="PAYMENTCHANNEL" value="{PAYMENTCHANNEL}">
    <input type="hidden" id="HOMEPHONE" name="HOMEPHONE" value="{HOMEPHONE}">
    <input type="hidden" id="MOBILEPHONE" name="MOBILEPHONE" value="{MOBILEPHONE}">
</form>
<script type="text/javascript">
    document.getElementById('param_pass').submit();
</script>
</body>
</html>