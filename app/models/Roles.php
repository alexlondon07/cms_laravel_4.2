<?php

class Roles extends Eloquent {

    use SoftDeletingTrait;

    /**
     * Enable soft deletes for a model
     * @var string
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Atributos que se pueden insertar en Mass-Assignment
     * @var array
     */
    protected $fillable = array('code', 'name');

    /**
     * Relacion con usuarios. Un rol puede pertenecer a muchos usuarios
     */
    public function users() {
        return $this->belongsToMany('User', 'users_roles');
    }

}
