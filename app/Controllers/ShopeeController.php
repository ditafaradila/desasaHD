<?php

namespace App\Controllers;

use App\Models\detailItemModel;
use App\Models\detailOrderList;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use App\Controllers\Services;
use App\Models\ItemModel;
use App\Models\OrderList;

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
    set_time_limit(300);
    try {
      // Memanggil method getItemList untuk mendapatkan data item
      $items = $this->getItemList();
      $items2 = $this->getItemBaseInfo();

      // Menampilkan view item_list.php bersama dengan data item
      // return view('toko/item_list.php', ['items' => $items, 'items2' => $items2]);
      return redirect()->to('/api')->with('success', 'Data berhasil diambil');
    } catch (\Exception $e) {
        // Jika terjadi kesalahan selain maximum execution time exceeded,
        // kembalikan ke halaman sebelumnya dengan pesan error
        if ($e instanceof \ErrorException && strpos($e->getMessage(), 'Maximum execution time') !== false) {
          return redirect()->back()->with('error', 'Waktu eksekusi maksimum terlampaui. Silakan coba lagi.');
      } else {
          return redirect()->back()->with('error', 'Gagal mengambil data: ' . $e->getMessage());
      }
    }
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
      try{
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
      } catch (\Exception $e){
        // Tangani kesalahan dengan mencatatnya ke log atau melakukan tindakan yang sesuai
        error_log('Error: ' . $e->getMessage());
        continue; // Lanjutkan ke item berikutnya
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
    $timest = strtotime("-15 days");
    $path = "/api/v2/order/get_order_list";
    $baseStringTmp = $partnerId . $path . $timestamp . $accessToken . $shopId;
    $sign = hash_hmac('sha256', $baseStringTmp, $partnerKey);

    // Konfigurasi panggilan API
    $url = "https://partner.shopeemobile.com/api/v2/order/get_order_list?access_token={$accessToken}&cursor=0&order_status=COMPLETED&page_size=100&partner_id={$partnerId}&response_optional_fields=order_status&shop_id={$shopId}&sign={$sign}&time_range_field=create_time&time_from={$timest}&time_to={$timestamp}&timestamp={$timestamp}";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($response, true);

    $orderModel = new OrderList();
    foreach ($data['response']['order_list'] as $order) {
      $existingItem = $orderModel->where('order_sn', $order['order_sn'])->first();

      if (!$existingItem) {
        $orderModel->saveItem($order);
      } else {
      }
    }
    return redirect()->to('/api')->with('success', 'Data berhasil diambil');

    // // Menampilkan respons dalam bentuk tabel di view
    // return $data['response']['item'];

    // // Panggil API menggunakan HTTP Client
    // $client = service('curlrequest');
    // $response = $client->request('GET', $url, [
    //   'headers' => [
    //     'Content-Type' => 'application/json'
    //   ]
    // ]);

    // // Ambil respons dari API
    // $data = $response->getBody();

    // // Tampilkan respons
    // return $data;
  }

  public function getDetailOrderList(){
    $orderModel = new OrderList();
    $order = $orderModel->findAll();

    $request = service('request');
    $partnerId = 2007160; // Ganti dengan partner ID Anda
    $partnerKey = "53426c5366705146516a724e6f51416d4b48797576475a496f6e4a6c78434275"; // Ganti dengan partner key Anda

    // Mendapatkan nilai access_token dari inputan di view
    $accessToken = $request->getPost('access_token');
    $shopId = $request->getPost('shop_id');
    $timest = time();
    $path = "/api/v2/order/get_order_detail";
    $baseStringTmp = $partnerId . $path . $timest . $accessToken . $shopId;
    $baseString = hash_hmac('sha256', $baseStringTmp, $partnerKey);

    //menyimpan respon untuk setiap order_sn
    $result = [];
    foreach ($order as $orders){
      try{
        $url = "https://partner.shopeemobile.com/api/v2/order/get_order_detail?access_token={$accessToken}&item_sn_list={$orders['order_sn']}&partner_id={$partnerId}&request_order_status_pending=true&response_optional_fields=total_amount,buyer_username,buyer_user_id,estimated_shipping_fee,recipient_address,shipping_carrier,payment_method&shop_id={$shopId}&sign={$baseString}&timestamp={$timest}";

        $client = service('curlrequest');
        $response = $client->request('GET', $url, [
          'headers' => [
            'Content-Type' => 'application/json'
          ]
        ]);

        // Ambil respons dari API
        $responseBody = $response->getBody();
        $result = json_decode($responseBody, true);
        $results[] = $result;
        $detailOrderModel = new detailOrderList();
        foreach ($result['response']['order_list'] as $item) {
          $existingItem = $detailOrderModel->where('order_sn', $item['order_sn'])->first();

          if (!$existingItem) {
            $detailOrderModel->saveItem($item);
          } else {

          }
        }
      } catch (\Exception $e){
        // Tangani kesalahan dengan mencatatnya ke log atau melakukan tindakan yang sesuai
        error_log('Error: ' . $e->getMessage());
        continue; // Lanjutkan ke item berikutnya
      }
    }  
    return $result['response']['order_list']; 
  }


  public function tes(){
    $orderModel = new OrderList();
    $order = $orderModel->findAll();

    $request = service('request');
    $partnerId = 2007160; // Ganti dengan partner ID Anda
    $partnerKey = "53426c5366705146516a724e6f51416d4b48797576475a496f6e4a6c78434275"; // Ganti dengan partner key Anda

    // Mendapatkan nilai access_token dari inputan di view
    $accessToken = $request->getPost('access_token');
    $shopId = $request->getPost('shop_id');
    $timest = time();
    $path = "/api/v2/order/get_order_detail";
    $baseStringTmp = $partnerId . $path . $timest . $accessToken . $shopId;
    $baseString = hash_hmac('sha256', $baseStringTmp, $partnerKey);
    
    //menyimpan respon untuk setiap item_id
    $result = [];
    foreach ($order as $order){
      try{
        $url = "https://partner.shopeemobile.com/api/v2/order/get_order_detail?access_token={$accessToken}&item_sn_list={$order['order_sn']}&partner_id={$partnerId}&request_order_status_pending=true&response_optional_fields=total_amount,buyer_username,buyer_user_id,estimated_shipping_fee,recipient_address,shipping_carrier,payment_method&shop_id={$shopId}&sign={$baseString}&timestamp={$timest}";

        // Membuat permintaan GET ke API Shopee
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);

        $detailModel = new detailOrderList();
        foreach ($result['response']['order_list'] as $order) {
          $existingItem = $detailModel->where('order_sn', $order['order_sn'])->first();

          if (!$existingItem) {
            $detailModel->saveItem($order);
          } else {

          }
        }
      } catch (\Exception $e){
        // Tangani kesalahan dengan mencatatnya ke log atau melakukan tindakan yang sesuai
        error_log('Error: ' . $e->getMessage());
        continue; // Lanjutkan ke item berikutnya
      }
    }  
    return $result['response']['order_list']; 
  }
  public function showOrderList()
  {
    // Memanggil method getItemList untuk mendapatkan data item
    $order = $this->getOrderList();
    $orders = $this->tes();
    // Menampilkan view item_list.php bersama dengan data item
    return redirect()->to('/api')->with('success', 'Data berhasil diambil');
  }
}
