<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Fernando Acosta';
        $user->email = 'fernando@gmail.com';
        $user->password = Hash::make('123');
        $user->url = 'http://fernando.com';
        $user->save();

        $user->perfil()->update(
            ['biografia' => 'Sit incididunt nisi ut mollit incididunt ullamco duis eiusmod exercitation aliquip. Proident dolore est minim in excepteur qui irure et sint. Excepteur cupidatat et duis officia in aute laborum irure dolor amet tempor pariatur veniam minim. Ea duis veniam pariatur ea quis ad reprehenderit. Ipsum exercitation non adipisicing reprehenderit. Sint ea eu ad anim aliquip aute eu irure aliquip sit tempor nisi laboris.']
        );

        $user = new User();
        $user->name = 'Fernando Acosta';
        $user->email = 'fernando2@gmail.com';
        $user->password = Hash::make('123');
        $user->url = 'http://fernando.com';
        $user->save();

        $user->perfil()->update(
            ['biografia' => 'Sit incididunt nisi ut mollit incididunt ullamco duis eiusmod exercitation aliquip. Proident dolore est minim in excepteur qui irure et sint. Excepteur cupidatat et duis officia in aute laborum irure dolor amet tempor pariatur veniam minim. Velit quis exercitation ea quis. Officia in exercitation cillum cupidatat mollit in. Amet exercitation elit sunt eiusmod reprehenderit irure consequat qui quis.']
        );
    }
}
