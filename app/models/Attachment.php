<?php

class Attachment extends Eloquent {
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
    protected $table = 'attachment';

    /**
     * Atributos que se pueden insertar en Mass-Assignment
     * @var array
     */
    protected $fillable = array('name');
    /**
     * Validacion de campos
     * @var array
     */
    public static $RULES_CREATE = array(
        //'file' => 'required|mimes:doc,docx,pdf,jpg,jpeg,bmp,png,txt',
           'file' => 'required|mimes:jpg,jpeg,bmp,png',
//        'size' => 'max:1024',
    );

    /**
     * Relacion, un archivo pertenece a un usuario
     * @return Relation
     */
    public function user() {
        return $this->belongsTo('User');
    }

    public function product() {
        return $this->belongsTo('Product');
    }

}
