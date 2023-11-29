<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengeluarann extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_pengeluaran' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'keperluan'         => [
                'type'          => 'VARCHAR',
                'constraint'    => 20
            ],
			'tanggal'       => [
				'type'           => 'DATE',
			],
			'nominal' => [
				'type'           => 'VARCHAR',
				'constraint'     => 25,
			],
		]);
		$this->forge->addKey('id_pengeluaran', true);
		$this->forge->createTable('tbl_pengeluaran');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_pengeluaran');
    }
}
