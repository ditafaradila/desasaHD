<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemasukan extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_pemasukan' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'not_null' => true,
            ],
            'sumber'         => [
                'type'          => 'VARCHAR',
                'constraint'    => 20
            ],
			'tanggal'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 20,
			],
			'jumlah' => [
				'type'           => 'VARCHAR',
				'constraint'     => 25,
			],
		]);
		$this->forge->addKey('id_pemasukan', true);
        $this->forge->addForeignKey('id_transaksi', 'tbl_transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');
		$this->forge->createTable('tbl_pemasukan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_pemasukan');
    }
}
