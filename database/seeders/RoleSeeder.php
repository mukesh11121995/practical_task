<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        if (!Role::where('name', 'hr')->exists()) {
            Role::create(['name' => 'hr']);
        }
        if (!Role::where('name', 'employee')->exists()) {
            Role::create(['name' => 'employee']);
        }
    }
}
