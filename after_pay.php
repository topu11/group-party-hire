<?php


//echo $_POST['after_pay_key_get'];
require __DIR__ . '/vendor/autoload.php';

use Afterpay\SDK\HTTP\Request\CreateCheckout as AfterpayCreateCheckoutRequest;
// use Afterpay\SDK\MerchantAccount as MerchantAccount;
// use Afterpay\SDK\HTTP\Request as Request;

// $merchect_accout=new MerchantAccount();
// $merchect_accout->setMerchantId("44872");
// $merchect_accout->setSecretKey("f4cdcfb591cc066e91d573711b565a89984f71287c91bcf4d4a4f6246aeaca35a16b34d1ffec3d97a87807ce526df492922d983f999a1855e69a80eb4f049f87");
// $merchect_accout->setCountryCode("AU");

// $request=new Request();
// $request->setMerchantAccount($merchect_accout);

$amount=$_POST['input_amount']+$_POST['booking_free'];

$createCheckoutRequest = new AfterpayCreateCheckoutRequest([
    'amount' => [ $amount, 'AUD' ],
    'consumer' => [
        'phoneNumber' => $_POST['mobile_no'],
        'givenNames' => $_POST['name'],
        'surname' => '',
        'email' => $_POST['email']
    ],
    // 'amount' => [ '10.00', 'AUD' ],
    // 'consumer' => [
    //     'phoneNumber' => '0400 000 000',
    //     'givenNames' => 'Test',
    //     'surname' => 'Test',
    //     'email' => 'test@example.com'
    // ],
    'merchant' => [
        'redirectConfirmUrl' => 'https://encoderit.net/confirm',
        'redirectCancelUrl' => 'https://encoderit.net/cancle'
    ],
    'taxAmount' => [ '0.00', 'AUD' ],
    'shippingAmount' => [ '0.00', 'AUD' ]
]);

$createCheckoutRequest->send();

echo $createCheckoutRequest->getResponse()->getParsedBody()->token;

