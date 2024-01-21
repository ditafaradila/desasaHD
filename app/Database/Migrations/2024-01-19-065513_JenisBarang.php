<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_jenisBarang' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'jenis_barang'         => [
                'type'          => 'VARCHAR',
                'constraint'    => 30,
            ],
		]);
		$this->forge->addKey('id_jenisBarang', true);
		$this->forge->createTable('tbl_jenisBarang');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_jenisBarang');
    }
}
