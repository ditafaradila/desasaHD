<?php

namespace App\Models;

use CodeIgniter\Model;

class Api extends Model{
    protected $table            = 'tbl_api';
    protected $primaryKey       = 'id_api';
    protected $allowedFields    = ['id_api', 'partner_id', 'partner_key', 'shop_id', 'code', 'access_token', 'refresh_token', 'expire_in'];

    public function updateTokens($partnerId, $shopId, $accessToken, $refreshToken, $expireIn) {
        date_default_timezone_set('Asia/Jakarta');
        $currentTime = time();
        $expireIn = date('Y-m-d H:i:s', strtotime('+4 hours', $currentTime));
        $data = [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'expire_in' => $expireIn
        ];

        // Assuming there's a unique combination of partner_id and shop_id
        $this->where('partner_id', $partnerId)
             ->where('shop_id', $shopId)
             ->set($data)
             ->update();
    }
}