<?php

namespace Tests\Support\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSariposTables extends Migration
{
    protected $DBGroup = 'tests';

    public function up(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INTEGER', 'auto_increment' => true],
            'full_name'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'phone'      => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'created_at' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('customers');

        $this->forge->addField([
            'id'         => ['type' => 'INTEGER', 'auto_increment' => true],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'full_name'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'avatar'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down(): void
    {
        $this->forge->dropTable('users');
        $this->forge->dropTable('customers');
    }
}
