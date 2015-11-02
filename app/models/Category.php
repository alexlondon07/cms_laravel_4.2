<?php

class Category extends Eloquent {

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
    protected $table = 'category';


        /**
         * Relacion uno a muchos has_many
         * Un producto pertence una categoria asociada, y una catagoria pertence a muchos productos
         * asociados
         * @return Relation
         */
    public function product() {
        return $this->has_many('Product');
    }

    protected $fillable = ['name', 'description', 'enable'];

    protected $guarded = ['id'];

    public $errors;
    public function isValid($data)
    {
        // se define la validacion de los campos
        $rules = array('name' => 'required|max:60', 'enable'=>'in:SI,NO');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make($data, $rules);
        if ($validator->passes())
        {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

}
