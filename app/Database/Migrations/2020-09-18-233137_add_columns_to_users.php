<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsToUsers extends Migration
{
	public function up()
	{
		//
		$this->fields = [
			'contact_phone' => ['type' => 'VARCHAR(100)'],
			'user_name' => ['type' => 'VARCHAR(20)'],
		];
		$this->forge->addColumn('ma_users', $this->fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropColumn('ma_users', 'contact_phone');
		$this->forge->dropColumn('ma_users', 'user_id');
	}
}
