<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblBarangKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_barangKeluar' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_supply'         => [
                'type'          => 'INT',
                'constraint'    => 20,
            ],
			'jumlah_barangKeluar'       => [
				'type'           => 'VARCHAR',
                'constraint'    => 10,
			],
            'tanggal_barangKeluar' => [
				'type'           => 'DATE',
			],
		]);
		$this->forge->addKey('id_barangKeluar', true);
		$this->forge->createTable('tbl_barangKeluar');
    }

    public function down()
    {
        //
    }
}
