<?php

class Client extends Eloquent {

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
    protected $table = 'client';

    protected $fillable = ['name', 'telephone', 'address', 'enable'];

    protected $guarded = ['id'];

    public $errors;
    public function isValid($data)
    {
        // se define la validacion de los campos
        $rules = array('name' => 'required|max:60', 'telephone' => 'required|numeric', 'enable'=>'in:SI,NO');
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
