<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
        //se limpian las tablas intermedias
        DB::table('users_roles')->delete();
        //se limpian las tablas de los modelos
        User::truncate();
        Roles::truncate();
        Category::truncate();
        Product::truncate();
        // se insertan los roles del sistema
        $this->call('RolesTableSeeder');
        // se ponen datos de pruebas
        $this->call('DevelopmentTableSeeder');
    }

}
