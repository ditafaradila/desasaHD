<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Supply extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_supply' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_supply'         => [
                'type'          => 'VARCHAR',
                'constraint'    => 30
            ],
			'jumlah_supply'       => [
				'type'           => 'VARCHAR',
                'constraint'    => 10,
			],
			'harga_supply' => [
				'type'           => 'VARCHAR',
				'constraint'     => 25,
			],
            'tanggal_supply' => [
				'type'           => 'DATE',
			],
		]);
		$this->forge->addKey('id_supply', true);
		$this->forge->createTable('tbl_supply');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_supply');
    }
}
