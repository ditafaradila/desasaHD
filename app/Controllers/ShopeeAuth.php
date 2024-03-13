<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ShopeeAuth extends Controller
{
    private $host = "https://partner.shopeemobile.com";
    private $partnerId = 2007160;
    private $partnerKey = "694d505149626c7468547562576b507a6e6856776f5a59514852705872626243";
    private $code = "527a416a41646549526b4576716a794b";

    public function getTokenShopLevel($shopId)
    {
        $path = "/api/v2/auth/token/get";
        $timest = time();
        $body = array("code" => $this->code,  "shop_id" => $shopId, "partner_id" => $this->partnerId);
        $baseString = sprintf("%s%s%s", $this->partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $this->host, $path, $this->partnerId, $timest, $sign);

        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $resp = curl_exec($c);

        $ret = json_decode($resp, true);
        return $ret;
    }

    public function getTokenAccountLevel($mainAccountId)
    {
        $path = "/api/v2/auth/token/get";
        $timest = time();
        $body = array("code" => $this->code,  "main_account_id" => $mainAccountId, "partner_id" => $this->partnerId);
        $baseString = sprintf("%s%s%s", $this->partnerId, $path, $timest);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $this->host, $path, $this->partnerId, $timest, $sign);

        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($c);

        $ret = json_decode($result, true);
        return $ret;
    }
}
