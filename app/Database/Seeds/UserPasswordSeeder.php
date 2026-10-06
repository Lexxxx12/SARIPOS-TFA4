<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserPasswordSeeder extends Seeder
{
    public function run(): void
    {
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $this->db->table('users')->where('password', null)->update(['password' => $hash]);
        $this->db->table('users')->where('password', '')->update(['password' => $hash]);
    }
}
