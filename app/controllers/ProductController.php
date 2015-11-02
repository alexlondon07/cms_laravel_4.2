<?php

class ProductController extends \BaseController {
    ////////////////////////////////////////////////////////////////////////////
    //  SECCION DE CODIGO PARA CRUD DE ADMINISTRADOR Y UTILIZAR "RESOURCES" DE LARAVEL
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $items = Product::orderBy('name', 'ASC')->paginate(10);
        return View::make('product.view_product', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $array_category = array();
        $arr = Category::orderBy('name', 'ASC')->get();
        $array_category[0] = 'Seleccione...';
        foreach ($arr as $i) {
            $array_category[$i->id] = $i->name;
        }

        $product = new Product;
        $show = false;
        return View::make('product.new_edit_product', compact('product', 'show', 'array_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        // se define la validacion de los campos
        $rules = array('category_id' =>'array', 'name' => 'required|max:60', 'value'=>'numeric|required','cost'=>'numeric|required', 'enable'=>'in:SI,NO');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $product = new Product;
        if (Input::get('category_id')) {
            $product->category_id = Input::get('category_id');
        }
        if (Input::get('name')) {
            $product->name = Input::get('name');
        }
        if (Input::get('description')) {
            $product->description = Input::get('description');
        }
        if (Input::get('value')) {
            $product->value = Input::get('value');
        }
        if (Input::get('cost')) {
            $product->cost = Input::get('cost');
        }
        if (Input::get('enable')) {
            $product->enable = Input::get('enable');
        }
        $product->save();
        return Redirect::to('admin/product')->with('success_message', 'El registro ha sido ingresado correctamente.')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id=null) {
        $array_category = array();
        $arr = Category::orderBy('name', 'ASC')->get();
        $array_category[0] = 'Seleccione...';
        foreach ($arr as $i) {
            $array_category[$i->id] = $i->name;
        }

        $product = Product::find($id);
        $show = true;
        return View::make('product.new_edit_product', compact('product', 'show', 'array_category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id=null) {
        $array_category = array();
        $arr = Category::orderBy('name', 'ASC')->get();
        $array_category[0] = 'Seleccione...';
        foreach ($arr as $i) {
            $array_category[$i->id] = $i->name;
        }

        $product = Product::find($id);
        $show = false;
        return View::make('product.new_edit_product', compact('product', 'show', 'array_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        // se define la validacion de los campos
        $rules = array('name' => 'required|max:60', 'value'=>'numeric|required','cost'=>'numeric|required', 'enable'=>'in:SI,NO');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $product = Product::find($id);
        if (Input::get('category_id')) {
            $product->category_id = Input::get('category_id');
        }
        if (Input::get('name')) {
            $product->name = Input::get('name');
        }
        if (Input::get('description')) {
            $product->description = Input::get('description');
        }
        if (Input::get('value')) {
            $product->value = Input::get('value');
        }
        if (Input::get('cost')) {
            $product->cost = Input::get('cost');
        }
        if (Input::get('enable')) {
            $product->enable = Input::get('enable');
        }
        $product->save();
        return Redirect::to('admin/product')->with('success_message', 'El registro ha sido modificado correctamente.')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $product = Product::find($id);
        $product->delete();
        return Redirect::to('admin/product')->with('success_message', 'El registro ha sido borrado correctamente.')->withInput();
    }

    /**
     * Metodo para hacer la busqueda de un cliente
     */
    public static function search() {
        $items = array();
        $search = '';
        if (Input::get('search')) {
            $search = Input::get('search');
            $arrparam = explode(' ', $search);
            $items = Product::whereNested(function($q) use ($arrparam) {
                $p = $arrparam[0];
                $q->whereNested(function($q) use ($p) {
                    $q->where('name', 'LIKE', '%' . $p . '%');
                    $q->orwhere('description', 'LIKE', '%' . $p . '%');
                    $q->orwhere('cost', 'LIKE', '%' . $p . '%');
                    $q->orwhere('value', 'LIKE', '%' . $p . '%');
                });
                $c = count($arrparam);
                if ($c > 1) {
                    //para no repetir el primer elemento
                    //foreach ($arrparam as $p) {
                    for ($i = 1; $i < $c; $i++) {
                        $p = $arrparam[$i];
                        $q->whereNested(function($q) use ($p) {
                            $q->where('name', 'LIKE', '%' . $p . '%');
                            $q->orwhere('description', 'LIKE', '%' . $p . '%');
                            $q->orwhere('cost', 'LIKE', '%' . $p . '%');
                            $q->orwhere('value', 'LIKE', '%' . $p . '%');
                        }, 'OR');
                    }
                }
            })
            ->whereNull('deleted_at')
            ->orderBy('name', 'ASC')
            ->paginate(10);
            return View::make('product.view_product', compact('items', 'search'));
        }
    }

}
