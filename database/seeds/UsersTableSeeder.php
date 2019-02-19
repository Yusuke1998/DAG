<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $usuario = User::create([
        	'name'		=>	'admin',
        	'email'		=>	'admin@admin.com',
        	'password'	=>	'$2y$10$axUjxmv8ugPjwtLPaE0DGOqLndcNWDihBqOlFnonugEQp3DTvDG1u',
        	'type'		=>	'administrador',
        ]);
    }
}
