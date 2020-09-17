<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class m20200917080200 extends Migration
{

        public function up()
        {
                $this->fields = [
                        'job_description' => ['type' => 'VARCHAR(100)']
                ];
                $this->forge->addColumn('ma_users', $this->fields);
        }

        public function down()
        {
                $this->forge->dropColumn('ma_users', 'job_description');
        }
}