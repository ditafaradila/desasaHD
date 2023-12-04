<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_produk' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_produk'         => [
                'type'          => 'VARCHAR',
                'constraint'    => 30
            ],
			'jumlah_produk'       => [
				'type'           => 'VARCHAR',
                'constraint'    => 10,
			],
			'harga_produk' => [
				'type'           => 'VARCHAR',
				'constraint'     => 25,
			],
            'foto_produk' => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
			],
		]);
		$this->forge->addKey('id_produk', true);
		$this->forge->createTable('tbl_produk');
    }

    public function down()
    {
        //
    }
}
