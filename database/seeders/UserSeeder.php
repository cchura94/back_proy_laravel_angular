<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eloquent ORM
        $usuario = new User;
        $usuario->name = "Administrador";
        $usuario->email = "admin@mail.com";
        $usuario->password = Hash::make("admin54321");
        $usuario->save();

        $usuario = new User;
        $usuario->name = "Juan";
        $usuario->email = "juan@mail.com";
        $usuario->password = Hash::make("juan54321");
        $usuario->save();

        $usuario = new User;
        $usuario->name = "Maria";
        $usuario->email = "maria@mail.com";
        $usuario->password = Hash::make("maria54321");
        $usuario->save();
    }
}
