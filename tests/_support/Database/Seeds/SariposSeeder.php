<?php

namespace Tests\Support\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SariposSeeder extends Seeder
{
    public function run(): void
    {
        $this->db->table('customers')->insertBatch([
            ['full_name' => 'Andrea Santos', 'email' => 'andrea.santos@example.com', 'phone' => '0917 234 8101', 'created_at' => '2026-09-01 09:00:00'],
            ['full_name' => 'Rafael Lim', 'email' => 'rafael.lim@example.com', 'phone' => '0966 402 8395', 'created_at' => '2026-09-06 16:15:00'],
        ]);

        $password = password_hash('admin123', PASSWORD_DEFAULT);
        $this->db->table('users')->insertBatch([
            ['username' => 'admin', 'full_name' => 'Administrator', 'password' => $password, 'avatar' => null, 'created_at' => '2026-09-01 08:00:00'],
            ['username' => 'supervisor.sam', 'full_name' => 'Samuel Aquino', 'password' => $password, 'avatar' => null, 'created_at' => '2026-09-06 10:30:00'],
        ]);
    }
}
