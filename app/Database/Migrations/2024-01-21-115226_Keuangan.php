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
            'id_pemasukan' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'not_null' => true,
            ],
            'id_pengeluaran' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'not_null' => true,
            ],
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'not_null' => true,
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
                'not_null' => true,
			],
            'kredit' => [
				'type'           => 'VARCHAR',
				'constraint'     => 25,
                'not_null' => true,
			],
		]);
		$this->forge->addKey('id_keuangan', true);
        $this->forge->addForeignKey('id_pemasukan', 'tbl_pemasukan', 'id_pemasukan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pengeluaran', 'tbl_pengeluaran', 'id_pengeluaran', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_transaksi', 'tbl_transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');
		$this->forge->createTable('tbl_keuangan');
    }

    public function down()
    {
        //
    }
}
