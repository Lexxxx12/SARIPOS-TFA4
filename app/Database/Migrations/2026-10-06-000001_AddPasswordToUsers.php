<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordToUsers extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('users', [
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'full_name',
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('users', 'password');
    }
}
