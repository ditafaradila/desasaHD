<?php

namespace App\Models;

use CodeIgniter\Model;

class Api extends Model{
    protected $table            = 'tbl_api';
    protected $primaryKey       = 'id_api';
    protected $allowedFields    = ['id_api', 'partner_id', 'partner_key', 'shop_id', 'code', 'access_token', 'refresh_token'];
}