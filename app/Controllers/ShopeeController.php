<?php

namespace App\Controllers;

use App\Models\detailItemModel;
use App\Models\detailOrderList;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Request;
use App\Controllers\Services;
use App\Models\Api;
use App\Models\ItemModel;
use App\Models\Keuangan;
use App\Models\OrderList;
use App\Models\Pemasukan;

class ShopeeController extends Controller
{
  protected $host = "https://partner.shopeemobile.com";
  protected $partnerId = 2007160;
  protected $partnerKey = "694d505149626c7468547562576b507a6e6856776f5a59514852705872626243";

  public function index(){
    // Periksa id_role
    if (session()->get('id_role') == 2) {
      return redirect()->to(base_url('/dashboard'));
    }

    $apiModel = new Api();
    $api = $apiModel->find(1);

    $data = [
      'title' => 'API',
      'api' =>$api
    ];
    return view('toko/api.php', $data);
  }

  public function updateApi($id_api){
    $request = service('request');
    $apiModel = new Api();

    $partner_key = $request->getPost('partner_key');
    $partner_id = $request->getPost('partner_id');
    $shop_id = $request->getPost('shop_id');
    $code = $request->getPost('code');
    $access_token = $request->getPost('access_token');
    $refresh_token = $request->getPost('refresh_token');

    $data = [
      'partner_key' => $partner_key,
      'partner_id' => $partner_id,
      'shop_id' => $shop_id,
      'code' => $code,
      'access_token' => $access_token,
      'refresh_token' => $refresh_token,
    ];
    $apiModel->update($id_api, $data);

    return redirect()->to('/api'); 
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

  public function process(){
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
  
  public function refreshToken($partnerId, $partnerKey, $shopId, $refreshToken){
    $host = "https://partner.shopeemobile.com";
    $path = "/api/v2/auth/access_token/get";
    $shopId = (int) $shopId;
    $timest = time();
    $body = array("partner_id" => $partnerId, "shop_id" => $shopId, "refresh_token" => $refreshToken);
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
    $expireIn = $ret["expire_in"] ?? 14400;

    if ($accessToken && $newRefreshToken) {
      $apiModel = new Api();
      $apiModel->updateTokens($partnerId, $shopId, $accessToken, $newRefreshToken, $expireIn);
    }
    // echo "\naccess_token: $accessToken, refresh_token: $newRefreshToken";
    return redirect()->to('/api')->with('success', 'Token berhasil didapat');
  }

  public function processRefreshToken(){
    $request = service('request');
    $refreshToken = $request->getPost('refreshToken');
    $shopId = $request->getPost('shop_id');
    if (!is_numeric($shopId)) {
      return "Shop ID harus berupa angka yang valid";
    }
    $partnerId = 2007160;
    $partnerKey = "53426c5366705146516a724e6f51416d4b48797576475a496f6e4a6c78434275";
    return $this->refreshToken($partnerId, $partnerKey, $shopId, $refreshToken);
    // return redirect()->to('/api')->with('success', 'Token berhasil didapat');
  }


  public function getItemList()
  {
    $request = service('request');

    $partnerId = 2007160; // Ganti dengan partner ID Anda
    $partnerKey = "53426c5366705146516a724e6f51416d4b48797576475a496f6e4a6c78434275"; // Ganti dengan partner key Anda

    // Mendapatkan nilai access_token dari inputan di view
    $accessToken = $request->getPost('access_token');
    $shopId = $request->getPost('shop_id');
    $timest = time();
    $path = "/api/v2/product/get_item_list";
    $baseStringTmp = $partnerId . $path . $timest . $accessToken . $shopId;
    $baseString = hash_hmac('sha256', $baseStringTmp, $partnerKey);

    $url = "https://partner.shopeemobile.com/api/v2/product/get_item_list?access_token={$accessToken}&item_status=NORMAL&item_status=SHOPEE_DELETE&offset=0&page_size=100&partner_id={$partnerId}&shop_id={$shopId}&sign={$baseString}&timestamp={$timest}";

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
      $items3 = $this->getItemExtraInfo();

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
    //return view('toko/item_list.php', ['items2' => $items2]);
  }

  public function getItemBaseInfo(){
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
            $detailModel->update($existingItem['id_detailItem'], $item);
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

  public function getItemExtraInfo(){
    $itemModel = new ItemModel();
    $items = $itemModel->findAll();

    $request = service('request');
    $partnerId = 2007160; // Ganti dengan partner ID Anda
    $partnerKey = "53426c5366705146516a724e6f51416d4b48797576475a496f6e4a6c78434275"; // Ganti dengan partner key Anda

    $accessToken = $request->getPost('access_token');
    $shopId = $request->getPost('shop_id');
    $timest = time();
    $path = "/api/v2/product/get_item_extra_info";
    $baseStringTmp = $partnerId . $path . $timest . $accessToken . $shopId;
    $baseString = hash_hmac('sha256', $baseStringTmp, $partnerKey);
    
    $result = [];
    foreach ($items as $item){
      try{
        $url = "https://partner.shopeemobile.com/api/v2/product/get_item_extra_info?access_token={$accessToken}&item_id_list={$item['item_id']}&need_complaint_policy=true&partner_id={$partnerId}&shop_id={$shopId}&sign={$baseString}&timestamp={$timest}";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);
        // error_log('API Response: ' . json_encode($result));

        $detailModel = new detailItemModel();
        foreach ($result['response']['item_list'] as $item) {
          // error_log('Item Data: ' . json_encode($item));
          $existingItem = $detailModel->where('item_id', $item['item_id'])->first();

          if (!$existingItem) {
            $detailModel->saveItem($item);
          } else {
            $detailModel->update($existingItem['id_detailItem'], $item); // Anda perlu mengganti 'id' dengan nama kolom id yang sesuai
          }
        }
      } catch (\Exception $e){
        error_log('Error: ' . $e->getMessage());
        continue;
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
    $orders = $orderModel->findAll();

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
    $pemasukanModel = new Pemasukan();
    $keuanganModel = new Keuangan();
    foreach ($orders as $order){
      try{
        $url = "https://partner.shopeemobile.com/api/v2/order/get_order_detail?access_token={$accessToken}&order_sn_list={$order['order_sn']}&request_order_status_pending=false&response_optional_fields=order_sn,region,currency,cod,total_amount,pending_terms,order_status,shipping_carrier,payment_method,estimated_shipping_fee,message_to_seller,create_time,update_time,days_to_ship,ship_by_date,buyer_user_id,buyer_username,item_list,item_id,item_name&partner_id={$partnerId}&shop_id={$shopId}&sign={$baseString}&timestamp={$timest}";

        // Membuat permintaan GET ke API Shopee
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);

        $detailOrderModel = new detailOrderList();
        foreach ($data['response']['order_list'] as $order) {
          $existingItem = $detailOrderModel->where('order_sn', $order['order_sn'])->first();

          if (!$existingItem) {
            $detailOrderModel->saveItem($order);
          } else {
            $detailOrderModel->update($existingItem['id_orderList'], $order); // Anda perlu mengganti 'id' dengan nama kolom id yang sesuai
          }

          // Simpan data pemasukan di luar loop detail order
          $existingPemasukan = $pemasukanModel->where('order_sn', $order['order_sn'])->first();
          if (!$existingPemasukan) {
            // Data pemasukan belum ada, simpan sebagai entri baru
            $dataPemasukan = [
              'order_sn' => $order['order_sn'],
              'sumber' => 'Shopee',
              'tanggal' => date('Y-m-d H:i:s', $order['update_time']),
              'jumlah' => $order['total_amount'],
            ];
            $pemasukanModel->save($dataPemasukan);
          } else {
            // Data pemasukan sudah ada, lakukan pembaruan
            $pemasukanModel->update($existingPemasukan['id_pemasukan'], [
                'jumlah' => $order['total_amount'],
                'tanggal' => date('Y-m-d H:i:s', $order['update_time']),
            ]);
          }

          // Simpan data keuangan
          $existingKeuangan = $keuanganModel->where('id_pemasukan', $order['order_sn'])->first();
          if (!$existingKeuangan) {
            $dataKeuangan = [
              'id_pemasukan' => $order['order_sn'],
              'tanggal' => date('Y-m-d H:i:s', $order['update_time']),
              'keterangan' => "Shopee",
              'debit' => $order['total_amount'],
            ];
            $keuanganModel->save($dataKeuangan);
          } else {
            $keuanganModel->update($existingKeuangan['id_keuangan'], [
                'debit' => $order['total_amount'],
                'tanggal' => date('Y-m-d H:i:s', $order['update_time']),
            ]);
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
    set_time_limit(600);
    $order = $this->getOrderList();
    $orders = $this->getDetailOrderList();
    return redirect()->to('/api')->with('success', 'Data berhasil diambil');
  }
}
