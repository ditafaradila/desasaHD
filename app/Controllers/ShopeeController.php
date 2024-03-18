<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ShopeeController extends Controller
{
  // public function index(){
  //   // Inisialisasi cURL
  //   $curl = curl_init();

  //   // Set opsi cURL
  //   curl_setopt_array($curl, array(
  //     CURLOPT_URL => 'https://partner.shopeemobile.com/api/v2/product/get_item_list?access_token=61694c577056556e485859577a594268&item_status=NORMAL&offset=0&page_size=10&partner_id=2007160&shop_id=55694070&sign=e81e4624e96203f0759ab7fc5e35c30f3e58d0311695565f3bb0f3212881dab9&timestamp=1710697676&update_time_from=1611311600&update_time_to=1611311631',
  //     CURLOPT_RETURNTRANSFER => true,
  //     CURLOPT_ENCODING => '',
  //     CURLOPT_MAXREDIRS => 10,
  //     CURLOPT_TIMEOUT => 0,
  //     CURLOPT_FOLLOWLOCATION => true,
  //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //     CURLOPT_CUSTOMREQUEST => 'GET',
  //     CURLOPT_HTTPHEADER => array(
  //       'Content-Type: application/json'
  //     ),
  //   ));

  //   // Eksekusi permintaan cURL dan simpan responsnya
  //   $response = curl_exec($curl);

  //   // Tutup sumber cURL dan lepaskan sumber daya yang dialokasikan
  //   curl_close($curl);

  //   // Menguraikan respons JSON menjadi array asosiatif
  //   $data['items'] = json_decode($response, true);
  //   // Debug the response structure
  //   var_dump($data['items']);

  //   // Periksa kesalahan dalam proses decoding JSON
  //   if (json_last_error() !== JSON_ERROR_NONE) {
  //     echo "Terjadi kesalahan dalam decoding JSON: " . json_last_error_msg();
  //   }

  //   // Kirim data ke view untuk ditampilkan
  //   return view('toko/item_list', $data);
  // }

  // public function index(){
  //   $data = [
  //     'title' => 'API',
  //   ];
  //   return view('toko/api.php', $data);
  // }

  public function auth()
  {
    $timest = time();
    $host = "https://partner.shopeemobile.com";
    $path = "/api/v2/shop/auth_partner";
    $redirect_url = "https://www.google.com/";
    $partner_id = 2007160;
    $partner_key = "694d505149626c7468547562576b507a6e6856776f5a59514852705872626243";

    $base_string = $partner_id . $path . $timest;
    $sign = hash_hmac("sha256", $base_string, $partner_key);

    $data['auth_url'] = $host . $path . "?partner_id=$partner_id&timestamp=$timest&sign=$sign&redirect=$redirect_url";

    $extra_data = [
      'title' => 'API'
    ];

    // Gabungkan array $data dengan $extra_data
    $data = array_merge($data, $extra_data);

    return view('toko/api.php', $data);
  }

  public function process()
  {
    // Ambil inputan dari form
    $request = service('request');
    $shop_id = $request->getPost('shop_id');
    $code = $request->getPost('code');
    $partner_id = 2007160;
    $tmp_partner_key = "694d505149626c7468547562576b507a6e6856776f5a59514852705872626243";
    $timest = time();

    // Konfigurasi GuzzleHttp Client
    $client = service('curlrequest', [
      'base_uri' => 'https://partner.shopeemobile.com',
      'headers' => ['Content-Type' => 'application/json']
    ]);

    // Membuat body request dalam bentuk JSON
    $body = json_encode([
      'code' => $code,
      'shop_id' => $shop_id,
      'partner_id' => $partner_id
    ]);

    // Membuat tanda tangan HMAC
    $path = "/api/v2/auth/token/get";
    $tmp_base_string = $partner_id . $path . $timest;
    $base_string = hash_hmac("sha256", $tmp_base_string, $tmp_partner_key);

    // Membuat URL request
    $url = $path . "?partner_id=$partner_id&timestamp=$timest&sign=$base_string";

    // Melakukan request POST menggunakan GuzzleHttp Client
    $response = $client->post($url, ['body' => $body]);

    // Mendapatkan response
    $ret = json_decode($response->getBody(), true);
    $access_token = $ret['access_token'];
    $new_refresh_token = $ret['refresh_token'];

    // Tampilkan hasil token dalam modal
    $data['access_token'] = $access_token;
    $data['refresh_token'] = $new_refresh_token;

    return view('auth_token_modal', $data);
  }
}
