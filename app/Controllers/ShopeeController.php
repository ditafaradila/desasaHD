<?php

namespace App\Controllers;

use App\Models\detailItemModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use App\Models\ItemModel;

class ShopeeController extends Controller
{
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
    $redirectUrl = "https://www.google.com/";
    $partnerId = 2007160;
    $partnerKey = "53426c5366705146516a724e6f51416d4b48797576475a496f6e4a6c78434275";

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
    $partnerKey = "53426c5366705146516a724e6f51416d4b48797576475a496f6e4a6c78434275";
    return $this->getTokenShopLevel($code, $partnerId, $partnerKey, $shopId);
  }

  public function getItemList()
  {
    $request = service('request');
    // Menangani paging
    $page = $request->getPost('page') ?? 1;
    $pageSize = $request->getPost('page_size') ?? 10;

    $partnerId = 2007160; // Ganti dengan partner ID Anda
    $partnerKey = "53426c5366705146516a724e6f51416d4b48797576475a496f6e4a6c78434275"; // Ganti dengan partner key Anda

    // Mendapatkan nilai access_token dari inputan di view
    $accessToken = $request->getPost('access_token');
    $shopId = $request->getPost('shop_id');
    $timest = time();
    $path = "/api/v2/product/get_item_list";
    $baseStringTmp = $partnerId . $path . $timest . $accessToken . $shopId;
    $baseString = hash_hmac('sha256', $baseStringTmp, $partnerKey);

    $url = "https://partner.shopeemobile.com/api/v2/product/get_item_list?access_token={$accessToken}&item_status=NORMAL&offset=0&page_size=100&partner_id={$partnerId}&shop_id={$shopId}&sign={$baseString}&timestamp={$timest}";

    // Membuat permintaan GET ke API Shopee
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($response, true);

    $itemsModel = new ItemModel();
    foreach ($data['response']['item'] as $item) {
      $existingItem = $itemsModel->where('item_id', $item['item_id'])->first();

      if (!$existingItem) {
        $itemsModel->saveItem($item);
      } else {
      }
    }

    // Menampilkan respons dalam bentuk tabel di view
    return $data['response']['item'];
  }

  public function showItemList()
  {
    // Memanggil method getItemList untuk mendapatkan data item
    $items = $this->getItemList();
    $items2 = $this->getItemBaseInfo();

    // Menampilkan view item_list.php bersama dengan data item
    return view('toko/item_list.php', ['items' => $items, 'items2' => $items2]);
  }

  public function getItemBaseInfo(){
    // // Set item_id yang ingin Anda minta informasinya
    //$item_id = 12048275043;

    $itemModel = new ItemModel();
    $items = $itemModel->findAll();

    $request = service('request');
    $partnerId = 2007160; // Ganti dengan partner ID Anda
    $partnerKey = "53426c5366705146516a724e6f51416d4b48797576475a496f6e4a6c78434275"; // Ganti dengan partner key Anda

    // Mendapatkan nilai access_token dari inputan di view
    $accessToken = $request->getPost('access_token');
    $shopId = $request->getPost('shop_id');
    $timest = time();
    $path = "/api/v2/product/get_item_base_info";
    $baseStringTmp = $partnerId . $path . $timest . $accessToken . $shopId;
    $baseString = hash_hmac('sha256', $baseStringTmp, $partnerKey);
    
    //menyimpan respon untuk setiap item_id
    $result = [];
    foreach ($items as $item){
      $url = "https://partner.shopeemobile.com/api/v2/product/get_item_base_info?access_token={$accessToken}&item_id_list={$item['item_id']}&need_complaint_policy=true&partner_id={$partnerId}&shop_id={$shopId}&sign={$baseString}&timestamp={$timest}";

      // Membuat permintaan GET ke API Shopee
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);
      curl_close($curl);

      $result = json_decode($response, true);

      $detailModel = new detailItemModel();
      foreach ($result['response']['item_list'] as $item) {
        $existingItem = $detailModel->where('item_id', $item['item_id'])->first();

        if (!$existingItem) {
          $detailModel->saveItem($item);
        } else {

        }
      }
    }  
    return $result['response']['item_list']; 
  }

  public function getOrderList()
  {
    $request = service('request');

    // Ganti nilai-nilai ini dengan nilai yang sesuai
    $accessToken = $request->getPost('access_token');
    $shopId = $request->getPost('shop_id');
    $partnerId = 2007160; // Ganti dengan partner ID Anda
    $partnerKey = "53426c5366705146516a724e6f51416d4b48797576475a496f6e4a6c78434275"; // Ganti dengan partner key Anda
    $timestamp = time();
    $timest = strtotime("-14 days");
    $path = "/api/v2/order/get_order_list";
    $baseStringTmp = $partnerId . $path . $timestamp . $accessToken . $shopId;
    $sign = hash_hmac('sha256', $baseStringTmp, $partnerKey);

    // Konfigurasi panggilan API
    $url = "https://partner.shopeemobile.com/api/v2/order/get_order_list?access_token={$accessToken}&cursor=0&order_status=COMPLETED&page_size=20&partner_id={$partnerId}&response_optional_fields=order_status&shop_id={$shopId}&sign={$sign}&time_range_field=create_time&time_from={$timest}&time_to={$timestamp}&timestamp={$timestamp}";

    // Panggil API menggunakan HTTP Client
    $client = service('curlrequest');
    $response = $client->request('GET', $url, [
      'headers' => [
        'Content-Type' => 'application/json'
      ]
    ]);

    // Ambil respons dari API
    $data = $response->getBody();

    // Tampilkan respons
    return $data;
  }

  public function showOrderList()
  {
    // Memanggil method getItemList untuk mendapatkan data item
    $orders = json_decode($this->getOrderList(), true);

    // Menampilkan view item_list.php bersama dengan data item
    return view('toko/order.php', ['orders' => $orders['response']['order_list']]);
  }
}
