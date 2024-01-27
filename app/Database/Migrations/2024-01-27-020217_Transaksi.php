<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'waktu'         => [
                'type'          => 'DATE',
            ],
			'metode_bayar'       => [
				'type'           => 'VARCHAR',
                'constraint'     => 25,
			],
			'diskon' => [
				'type'           => 'VARCHAR',
				'constraint'     => 25,
			],
            'nominal' => [
				'type'           => 'VARCHAR',
				'constraint'     => 25,
			],
            'id_produk' => [
				'type'           => 'INT',
				'constraint'     => 10,
			],
		]);
		$this->forge->addKey('id_transaksi', true);
		$this->forge->createTable('tbl_transaksi');
    }

    public function down()
    {
        //
    }
}
