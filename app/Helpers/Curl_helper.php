<?php

$access_token = 'your_access_token_here';
$partner_id = 'your_partner_id_here';
$shop_id = 'your_shop_id_here';
$sign = 'your_sign_here';
$timestamp = time(); // or set your desired timestamp

$url = 'https://partner.shopeemobile.com/api/v2/product/get_item_list?access_token=' . $access_token . '&item_status=NORMAL&offset=0&page_size=10&partner_id=' . $partner_id . '&shop_id=' . $shop_id . '&sign=' . $sign . '&timestamp=' . $timestamp . '&update_time_from=1611311600&update_time_to=1611311631';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

if ($response === false) {
    echo 'Error: ' . curl_error($curl);
} else {
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($http_status != 200) {
        echo 'HTTP Status Code: ' . $http_status;
    } else {
        echo $response;
    }
}

curl_close($curl);
