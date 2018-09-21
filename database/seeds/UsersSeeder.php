<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = new User();
       $user->name = "Marcos Sibilio";
       $user->email = "sibiliojr@gmail.com";
       $user->papel_id = 1;
       $user->password = bcrypt("m74e71");
       $user->save();
       
       $user = new User();
       $user->name = "Master";
       $user->email = "master@gmail.com";
       $user->papel_id = 2;
       $user->password = bcrypt("master");
       $user->save();
       
       $user = new User();
       $user->name = "Administrador";
       $user->email = "admin@gmail.com";
       $user->papel_id = 3;
       $user->password = bcrypt("admin");
       $user->save();
       
       $user = new User();
       $user->name = "Gerente";
       $user->email = "gerente@gmail.com";
       $user->papel_id = 4;
       $user->password = bcrypt("gerente");
       $user->save();
       
       $user = new User();
       $user->name = "Operador";
       $user->email = "operador@gmail.com";
       $user->papel_id = 5;
       $user->password = bcrypt("operador");
       $user->save();
       
       $user = new User();
       $user->name = "Cliente";
       $user->email = "cliente@gmail.com";
       $user->papel_id = 6;
       $user->password = bcrypt("cliente");
       $user->save();
       
    }
}
