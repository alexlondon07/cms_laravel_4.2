<?php

class RolesTableSeeder extends Seeder {

    public function run() {
        // se crean todos los roles del sistema
        $arr_roles = array(
            array('code' => '1', 'name' => 'Ver Clientes'),
            array('code' => '1.1', 'name' => 'Crear Clientes'),
            array('code' => '1.2', 'name' => 'Editar Clientes'),
            array('code' => '1.3', 'name' => 'Eliminar Clientes'),
            array('code' => '2', 'name' => 'Ver Categoria'),
            array('code' => '2.1', 'name' => 'Crear Categoria'),
            array('code' => '2.2', 'name' => 'Editar Categoria'),
            array('code' => '2.3', 'name' => 'Eliminar Categoria'),
            array('code' => '3', 'name' => 'Ver Sub Categoria'),
            array('code' => '3.1', 'name' => 'Crear Sub Categoria'),
            array('code' => '3.2', 'name' => 'Editar Sub Categoria'),
            array('code' => '3.3', 'name' => 'Eliminar Sub Categoria'),
            array('code' => '4', 'name' => 'Ver Productos'),
            array('code' => '4.1', 'name' => 'Crear Productos'),
            array('code' => '4.2', 'name' => 'Editar Productos'),
            array('code' => '4.3', 'name' => 'Eliminar Productos'),
            // array('code' => '5', 'name' => 'Ver Categoria'),
            // array('code' => '5.1', 'name' => 'Crear Categoria'),
            // array('code' => '5.2', 'name' => 'Editar Categoria'),
            // array('code' => '5.3', 'name' => 'Eliminar Categoria'),
            // array('code' => '6', 'name' => 'Ver Productos'),
            // array('code' => '6.1', 'name' => 'Crear Productos'),
            // array('code' => '6.2', 'name' => 'Editar Productos'),
            // array('code' => '6.3', 'name' => 'Eliminar Productos'),
            // array('code' => '7', 'name' => 'Ver Compras'),
            // array('code' => '7.1', 'name' => 'Crear Compras'),
            // array('code' => '7.2', 'name' => 'Editar Compras'),
            // array('code' => '7.3', 'name' => 'Eliminar Compras'),
            // array('code' => '8', 'name' => 'Ver Pedidos'),
            // array('code' => '8.1', 'name' => 'Crear Pedidos'),
            // array('code' => '8.2', 'name' => 'Editar Pedidos'),
            // array('code' => '8.3', 'name' => 'Eliminar Pedidos'),
        );
        $db_roles = Roles::all()->toArray();
        for ($i = 0; $i < count($arr_roles); $i++) {
            $inser = true;
            for ($j = 0; $j < count($db_roles); $j++) {
                if ($arr_roles[$i]['code'] == $db_roles[$j]['code']) {
                    $inser = false;
                }
            }
            if ($inser) {
                Roles::create($arr_roles[$i]);
            }
        }
    }

}
