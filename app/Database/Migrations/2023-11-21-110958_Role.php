<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_role' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'role'         => [
                'type'          => 'VARCHAR',
                'constraint'    => 15,
            ],
		]);
		$this->forge->addKey('id_role', true);
		$this->forge->createTable('tbl_role');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_role');
    }
}
