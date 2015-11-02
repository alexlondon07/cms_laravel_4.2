<?php

class Product extends Eloquent {

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
    protected $table = 'product';

        /**
         * Relacion uno a muchos has_many
         * Un producto pertence una categoria asociada, y una catagoria pertence a muchos productos
         * asociados
         * @return Relation
         */
        public function category() {
            return $this->has_many('Category');
        }
}
