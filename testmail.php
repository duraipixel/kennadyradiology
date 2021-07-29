<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => ' ',
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "content-type: application/json",
	"api-key: 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"
  ),
));

$response = curl_exec($curl);
//print_r($response);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

?>