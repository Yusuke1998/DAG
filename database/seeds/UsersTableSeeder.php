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
        	'password'	=>	bcrypt('admin'),
        	'type'		=>	'administrador',
        ]);

        $usuario = User::create([
        	'name'		=>	'almacenista',
        	'email'		=>	'almacenista@almacenista.com',
        	'password'	=>	bcrypt('almacenista'),
        	'type'		=>	'almacenista',
        ]);
    }
}
