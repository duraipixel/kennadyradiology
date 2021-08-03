<?php

$curl = curl_init();
echo "dsf";
print_r($curl);
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.razorpay.com/v1/orders/order_HfQWCsx5OhYRRk/payments',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic cnpwX2xpdmVfWkFUU1lySm1Kd1hxcXY6QXh0UkRMYjdNaXBoNHlGN0JSZUhRaTY2'
  ),
));
 
$response = curl_exec($curl);

curl_close($curl);
$orderresponse=json_decode($response,true);
print_r($orderresponse);