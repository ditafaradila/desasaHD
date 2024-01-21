<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keuangan extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_keuangan' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'keterangan'         => [
                'type'          => 'VARCHAR',
                'constraint'    => 20
            ],
			'tanggal'       => [
				'type'           => 'DATE',
			],
			'debit' => [
				'type'           => 'VARCHAR',
				'constraint'     => 25,
			],
            'kredit' => [
				'type'           => 'VARCHAR',
				'constraint'     => 25,
			],
		]);
		$this->forge->addKey('id_keuangan', true);
		$this->forge->createTable('tbl_keuangan');
    }

    public function down()
    {
        //
    }
}
