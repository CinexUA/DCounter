<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class DefaultSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        $this->command->info('Creating default super admin');
        $email = 'admin@app.com';

        $user = User::updateOrCreate(['email' => $email], [
            'name' => 'Admin',
            'email' => $email,
            'email_verified_at' => now(),
            'password' => '12345678', //don't need to crypt password, because working mutator
            'remember_token' => Str::random(10),
        ]);
        $this->command->info('Created default super admin');

        $this->command->info('Adding super-administrator role for default admin');
        $role = Role::where('name', 'administrator')->firstOrFail();
        if(!$user->hasRole('administrator')){
            $user->attachRole($role);
        }
        $this->command->info('Super-administrator role for default admin has been added');

    }
}
