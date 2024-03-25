<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;

class ShopeeController extends Controller{
  protected $host = "https://partner.shopeemobile.com";
  protected $partnerId = 2007160;
  protected $partnerKey = "694d505149626c7468547562576b507a6e6856776f5a59514852705872626243";

  public function index()
  {
    $data = [
      'title' => 'API',
    ];
    return view('toko/api.php', $data);
  }

  public function auth()
  {
    $host = "https://partner.shopeemobile.com";
    $path = "/api/v2/shop/auth_partner";
    $redirectUrl = "https://open.shopee.com";
    $partnerId = 2007160;
    $partnerKey = "694d505149626c7468547562576b507a6e6856776f5a59514852705872626243";

    $timest = time();
    $baseString = $partnerId . $path . $timest;
    $sign = hash_hmac('sha256', $baseString, $partnerKey);

    $url = $host . $path . "?partner_id=" . $partnerId . "&timestamp=" . $timest . "&sign=" . $sign . "&redirect=" . urlencode($redirectUrl);

    return redirect()->to($url);
  }

  // public function process(){
  //   $host = "https://partner.shopeemobile.com";
  //   $path = "/api/v2/auth/token/get";
  //   // Ambil inputan dari form
  //   $request = service('request');
  //   $shopId = 55694070;
  //   $code = "644f54624d5542695270484470596267";
  //   $partnerId = 2007160;
  //   $partnerKey = "694d505149626c7468547562576b507a6e6856776f5a59514852705872626243";
  //   $timest = time();

  //   $body = array("code" => $code,  "shop_id" => $shopId, "partner_id" => $partnerId);
  //   $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
  //   $sign = hash_hmac('sha256', $baseString, $partnerKey);
  //   $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $host, $path, $partnerId, $timest, $sign);

  //   $c = curl_init($url);
  //   curl_setopt($c, CURLOPT_POST, 1);
  //   curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
  //   curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  //   curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  //   $resp = curl_exec($c);
  //   echo "raw result: $resp";

  //   $ret = json_decode($resp, true);
  //   $accessToken = $ret["access_token"];
  //   $newRefreshToken = $ret["refresh_token"];
  //   echo "\naccess_token: $accessToken, refresh_token: $newRefreshToken raw: $ret"."\n";
  //   var_dump($ret);
  //   //return $ret;

  //   //return view('auth_token_modal', $data);
  // }

  public function getTokenShopLevel($code, $partnerId, $partnerKey, $shopId)
  {
    $host = "https://partner.shopeemobile.com";
    $path = "/api/v2/auth/token/get";
    $shopId = (int) $shopId;
    $timest = time();
    $body = array("code" => $code, "shop_id" => $shopId, "partner_id" => $partnerId);
    $baseString = sprintf("%s%s%s", $partnerId, $path, $timest);
    $sign = hash_hmac('sha256', $baseString, $partnerKey);
    $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s", $host, $path, $partnerId, $timest, $sign);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $resp = curl_exec($curl);

    $ret = json_decode($resp, true);
    $accessToken = $ret["access_token"] ?? null;
    $newRefreshToken = $ret["refresh_token"] ?? null;
    echo "\naccess_token: $accessToken, refresh_token: $newRefreshToken raw: $resp" . "\n";
    //return $ret;
  }

  public function process()
  {
    $request = service('request');
    $code = $request->getPost('code');
    $shopId = $request->getPost('shop_id');
    if (!is_numeric($shopId)) {
      return "Shop ID harus berupa angka yang valid";
    }
    $partnerId = 2007160;
    $partnerKey = "694d505149626c7468547562576b507a6e6856776f5a59514852705872626243";
    return $this->getTokenShopLevel($code, $partnerId, $partnerKey, $shopId);
  }

  public function getItemList(){
    $request = service('request');
    // Menangani paging
    $page = $request->getPost('page') ?? 1;
    $pageSize = $request->getPost('page_size') ?? 10;

    $partnerId = 2007160; // Ganti dengan partner ID Anda
    $partnerKey = "694d505149626c7468547562576b507a6e6856776f5a59514852705872626243"; // Ganti dengan partner key Anda

    // Mendapatkan nilai access_token dari inputan di view
    $accessToken = $request->getPost('access_token');
    $shopId = $request->getPost('shop_id');
    $timest = time();
    $path = "/api/v2/product/get_item_list";
    $baseStringTmp = $partnerId . $path . $timest . $accessToken . $shopId;
    $baseString = hash_hmac('sha256', $baseStringTmp, $partnerKey);

    $url = "https://partner.shopeemobile.com/api/v2/product/get_item_list?access_token={$accessToken}&item_status=NORMAL&offset=0&page_size=10&partner_id={$partnerId}&shop_id={$shopId}&sign={$baseString}&timestamp={$timest}";

    // Membuat permintaan GET ke API Shopee
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($response, true);

    // Menampilkan respons dalam bentuk tabel di view
    return [
      'items' => $data['response']['item'],
      'totalCount' => $data['response']['total_count']
    ];
  }

  public function getOrderList(){
    $request = service('request');
    // Menangani paging
    $page = $request->getPost('page') ?? 1;
    $pageSize = $request->getPost('page_size') ?? 10;

    $partnerId = 2007160; // Ganti dengan partner ID Anda
    $partnerKey = "694d505149626c7468547562576b507a6e6856776f5a59514852705872626243"; // Ganti dengan partner key Anda

    // Mendapatkan nilai access_token dari inputan di view
    $accessToken = $request->getPost('access_token');
    $shopId = $request->getPost('shop_id');
    $timest = time();
    $path = "/api/v2/order/get_order_list";
    $baseStringTmp = $partnerId . $path . $timest . $accessToken . $shopId;
    $baseString = hash_hmac('sha256', $baseStringTmp, $partnerKey);

    //$url = "https://partner.shopeemobile.com/api/v2/order/get_order_list?access_token={$accessToken}&item_status=NORMAL&offset=0&page_size=10&partner_id={$partnerId}&shop_id={$shopId}&sign={$baseString}&timestamp={$timest}";
    $url = "https://partner.shopeemobile.com/api/v2/order/get_order_list?access_token={$accessToken}&cursor=%22%22&order_status=COMPLETED&page_size=20&partner_id={$partnerId}&response_optional_fields=order_status&shop_id={$shopId}&sign={$baseString}&timestamp={$timest}";
    // Membuat permintaan GET ke API Shopee
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($response, true);

    // Menampilkan respons dalam bentuk tabel di view
    return [
      'orders' => $data['response']['order_list'],
      'totalCount' => $data['response']['total_count']
    ];
  }

  public function displayData(){
    $itemList = $this->getItemList();
    $orderList = $this->getOrderList();

    // Meneruskan data ke view
    return view('toko/display_data', [
        'itemList' => $itemList,
        'orderList' => $orderList
    ]);
  }

}
