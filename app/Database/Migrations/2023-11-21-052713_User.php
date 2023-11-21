<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_user' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username'         => [
                'type'          => 'VARCHAR',
                'constraint'    => 15,
            ],
			'password'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 8,
			],
			'id_role' => [
				'type'           => 'INT',
				'constraint'     => 5,
			],
			'nama' => [
				'type'           => 'VARCHAR',
				'constraint'       	 => 100,
            ],
 
		]);
		$this->forge->addKey('id_user', true);
		$this->forge->createTable('tbl_user');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_user');
    }
}
