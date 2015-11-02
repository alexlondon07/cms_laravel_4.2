<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * Relacion con roles. Un usuario puede tener muchos roles
     */
    public function roles() {
        return $this->belongsToMany('Roles', 'users_roles');
    }

    /**
     * Find out if user has a specific role
     *
     * @return boolean
     */
    public function hasRole($check) {
        return in_array($check, array_fetch($this->roles->toArray(), 'code'));
    }

    public function attachment() {
        return $this->hasMany('Attachment');
    }
    /**
     * Relacion, un cliente puede pertenecer a un cliente
     * @return Relation
     */
    // public function client() {
    //     return $this->belongsTo('Client');
    // }

    public static function getIdFromRoles($variable, $term) {
        $id = 0;
        foreach ($variable as $array) {
            foreach ($array as $key => $value) {
                if ($key == 'code' && $value == $term) {
                    $id = $array['id'];
                    break;
                }
            }
        }
        return $id;
    }

    public static function makeProfile($title) {
        $assigned_roles = array();
        $roles = Roles::all()->toArray();
        switch ($title) {
            case 'super_admin':
                //Acceder al modulo de clientes
                $assigned_roles[] = User::getIdFromRoles($roles, '1');
                //Crear clientes
                $assigned_roles[] = User::getIdFromRoles($roles, '1.1');
                //Editar clientes
                $assigned_roles[] = User::getIdFromRoles($roles, '1.2');
                //Eliminar clientes
                $assigned_roles[] = User::getIdFromRoles($roles, '1.3');
                //Acceder al modulo de usuarios
                $assigned_roles[] = User::getIdFromRoles($roles, '2');
                //Crear usuarios
                $assigned_roles[] = User::getIdFromRoles($roles, '2.1');
                //Editar usuarios
                $assigned_roles[] = User::getIdFromRoles($roles, '2.2');
                //Eliminar usuarios
                $assigned_roles[] = User::getIdFromRoles($roles, '2.3');
                //Acceder al modulo de proveedores
                $assigned_roles[] = User::getIdFromRoles($roles, '3');
                //Crear proveedores
                $assigned_roles[] = User::getIdFromRoles($roles, '3.1');
                //Editar proveedore
                $assigned_roles[] = User::getIdFromRoles($roles, '3.2');
                //Eliminar proveedores
                $assigned_roles[] = User::getIdFromRoles($roles, '3.3');
                //costos
                $assigned_roles[] = User::getIdFromRoles($roles, '4');
                $assigned_roles[] = User::getIdFromRoles($roles, '4.1');
                $assigned_roles[] = User::getIdFromRoles($roles, '4.2');
                $assigned_roles[] = User::getIdFromRoles($roles, '4.3');
                //Cateoria
                $assigned_roles[] = User::getIdFromRoles($roles, '5');
                $assigned_roles[] = User::getIdFromRoles($roles, '5.1');
                $assigned_roles[] = User::getIdFromRoles($roles, '5.2');
                $assigned_roles[] = User::getIdFromRoles($roles, '5.3');
                //Productos
                $assigned_roles[] = User::getIdFromRoles($roles, '6');
                $assigned_roles[] = User::getIdFromRoles($roles, '6.1');
                $assigned_roles[] = User::getIdFromRoles($roles, '6.2');
                $assigned_roles[] = User::getIdFromRoles($roles, '6.3');
                // //Marcos
                // $assigned_roles[] = User::getIdFromRoles($roles, '7');
                // $assigned_roles[] = User::getIdFromRoles($roles, '7.1');
                // $assigned_roles[] = User::getIdFromRoles($roles, '7.2');
                // $assigned_roles[] = User::getIdFromRoles($roles, '7.3');
                // // Tinta Mezcla
                // $assigned_roles[] = User::getIdFromRoles($roles, '8');
                // $assigned_roles[] = User::getIdFromRoles($roles, '8.1');
                // $assigned_roles[] = User::getIdFromRoles($roles, '8.2');
                // $assigned_roles[] = User::getIdFromRoles($roles, '8.3');
                // // Referencias
                // $assigned_roles[] = User::getIdFromRoles($roles, '9');
                // $assigned_roles[] = User::getIdFromRoles($roles, '9.1');
                // $assigned_roles[] = User::getIdFromRoles($roles, '9.2');
                // $assigned_roles[] = User::getIdFromRoles($roles, '9.3');
                // // Kit
                // $assigned_roles[] = User::getIdFromRoles($roles, '10');
                // $assigned_roles[] = User::getIdFromRoles($roles, '10.1');
                // $assigned_roles[] = User::getIdFromRoles($roles, '10.2');
                // $assigned_roles[] = User::getIdFromRoles($roles, '10.3');
                // // Pedidos
                // $assigned_roles[] = User::getIdFromRoles($roles, '11');
                // $assigned_roles[] = User::getIdFromRoles($roles, '11.1');
                // $assigned_roles[] = User::getIdFromRoles($roles, '11.2');
                // $assigned_roles[] = User::getIdFromRoles($roles, '11.3');
                // // Ordenes
                // $assigned_roles[] = User::getIdFromRoles($roles, '12');
                // $assigned_roles[] = User::getIdFromRoles($roles, '12.1');
                // $assigned_roles[] = User::getIdFromRoles($roles, '12.2');
                // $assigned_roles[] = User::getIdFromRoles($roles, '12.3');
                break;
            case 'supervisor':
                $assigned_roles[] = User::getIdFromRoles($roles, '10');
                break;
            case 'operario':
                $assigned_roles[] = User::getIdFromRoles($roles, '11');
                break;
        }
        // print_r($assigned_roles); die();
        return $assigned_roles;
    }

}
