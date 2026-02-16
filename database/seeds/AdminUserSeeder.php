<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

/**
 * 🔑 Admin Seeder
 * 
 * This file creates the "First Administrator" so you can log in after a fresh install.
 * Run it using: php artisan db:seed --class=AdminUserSeeder
 */
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Ensure 'admin' role exists
        // We look for it first. If it's missing, we create it.
        $adminRole = Role::where('Rol_name', 'admin')->first();
        
        if(!$adminRole){
             $adminRole = Role::create(['Rol_name' => 'admin']);
        }

        // 2. Create the 'Super Admin' User
        // This is the master key account.
        User::create([
            'name' => ' Dylan Super Admin',
            'email' => 'dylanyesidflorez@plexbook.com',
            // Hash::make() encrypts the password. We NEVER store plain text passwords.
            'password' => Hash::make('Dylan123'), 
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ Admin User Created Successfully!');
        $this->command->info('📧 Email: dylanyesidflorez@plexbook.com');
        $this->command->info('🔑 Password: Dylan123');
    }
}
            'role_id' => $adminRole->id, // Asignamos el ID del rol Admin
        ]);

        $this->command->info('Usuario Administrador creado con éxito!');
        $this->command->info('Email: dylanyesidflorez@plexbook.com');
        $this->command->info('Password: Dylan123');


    }
}
