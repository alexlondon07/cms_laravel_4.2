<?php

class DevelopmentTableSeeder extends Seeder {

    public function run() {

        //se ingresa el libro de darwin
        //DB::statement("INSERT INTO lor_lecture (title, author, year, publisher, content, created_at, updated_at, deleted_at) VALUES ('El origen de las especies', 'Charles Darwin', '1859', 'Dominio publico', 'temas vivos.', NOW(),NOW(), NULL);");
        $user = User::create(array(
            'profile' => 'super_admin',
            'firstname' => 'Alexander Andres Londono Espejo',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            ));
        $user->roles()->attach(1);
        $user->roles()->attach(2);
        $user->roles()->attach(3);
        $user->roles()->attach(4);
        $user->roles()->attach(5);
        $user->roles()->attach(6);
        $user->roles()->attach(7);
        $user->roles()->attach(8);
        $user->roles()->attach(9);
        $user->roles()->attach(10);
        $user->roles()->attach(11);
        $user->roles()->attach(12);
        $user->roles()->attach(13);
        $user->roles()->attach(14);
        $user->roles()->attach(15);
        $user->roles()->attach(16);
        $user->roles()->attach(17);
        $user->roles()->attach(18);
        $user->roles()->attach(19);
        $user->roles()->attach(20);
        $user->roles()->attach(21);
        $user->roles()->attach(22);
        $user->roles()->attach(23);
        $user->roles()->attach(24);
        $user->roles()->attach(25);
        $user->roles()->attach(26);
        $user->roles()->attach(27);
        $user->roles()->attach(28);
        $user->roles()->attach(29);
        $user->roles()->attach(30);
        $user->roles()->attach(31);
        $user->roles()->attach(32);

        $faker = Faker\Factory::create();
        $count_client = 50;
        foreach (range(1, $count_client) as $index) {
            $user = User::create([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'username' => 'admin' . $index,
                'email' => $faker->email,
                'identification' => $faker->numberBetween(19999999, 99999999),
                'password' => Hash::make('admin' . $index),
                ]);
            //Ingreso datos de prueba de categoria
            $category = Category::create([
                'name' => $faker->company,
                'description' => '',
                'enable' => 'SI',
                ]);
            //Ingreso datos de prueba de productos
            $product = Product::create([
                'name' => $faker->company,
                'description' => '',
                'cost' => $faker->numberBetween(1999, 9999),
                'value' => $faker->numberBetween(19999, 99999),
                'enable' => 'SI',
                ]);
        }
    }

}
