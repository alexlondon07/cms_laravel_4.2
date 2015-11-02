<?php

class CategoryController extends \BaseController {
    ////////////////////////////////////////////////////////////////////////////
    //  SECCION DE CODIGO PARA CRUD DE ADMINISTRADOR Y UTILIZAR "RESOURCES" DE LARAVEL
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $items = Category::orderBy('name', 'ASC')->paginate(10);
        return View::make('category.view_category', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $category = new Category;
        $show = false;
        return View::make('category.new_edit_category', compact('category', 'show'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $category = new Category;
        $data = Input::all();
        // Revisamos si la data es válido
        if ($category->isValid($data)){
            // Si la data es valida se la asignamos al category
            $category->fill($data);
            // Guardamos el category
            $category->save();
            return Redirect::to('admin/category')->with('success_message', 'El registro ha sido ingresado correctamente.')->withInput();
        }else{
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::back()->withInput()->withErrors($category->errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id=null) {
        $category = Category::find($id);
        $show = true;
        return View::make('category.new_edit_category', compact('category', 'show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id=null) {
        $category = Category::find($id);
        $show = false;
        return View::make('category.new_edit_category', compact('category', 'show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $category = Category::find($id);
        $data = Input::all();
        // Revisamos si la data es válido
        if ($category->isValid($data)){
            // Si la data es valida se la asignamos al category
            $category->fill($data);
            // Guardamos el category
            $category->save();
            return Redirect::to('admin/category')->with('success_message', 'El registro ha sido modificado correctamente.')->withInput();
        }else{
            // En caso de error regresa a la acción create con los datos y los errores encontrados
            return Redirect::back()->withInput()->withErrors($category->errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $category = Category::find($id);
        $category->delete();
        return Redirect::to('admin/category')->with('success_message', 'El registro ha sido borrado correctamente.')->withInput();
    }

    /**
     * Metodo para hacer la busqueda de un categorye
     */
    public static function search() {
        $items = array();
        $search = '';
        if (Input::get('search')) {
            $search = Input::get('search');
            $arrparam = explode(' ', $search);
            $items = Category::whereNested(function($q) use ($arrparam) {
                        $p = $arrparam[0];
                        $q->whereNested(function($q) use ($p) {
                            $q->where('name', 'LIKE', '%' . $p . '%');
                            $q->orwhere('description', 'LIKE', '%' . $p . '%');
                            $q->orwhere('enable', 'LIKE', '%' . $p . '%');
                        });
                        $c = count($arrparam);
                        if ($c > 1) {
                            for ($i = 1; $i < $c; $i++) {
                                $p = $arrparam[$i];
                                $q->whereNested(function($q) use ($p) {
                                    $q->where('name', 'LIKE', '%' . $p . '%');
                                    $q->orwhere('description', 'LIKE', '%' . $p . '%');
                                    $q->orwhere('enable', 'LIKE', '%' . $p . '%');
                                }, 'OR');
                            }
                        }
                    })
                    ->whereNull('deleted_at')
                    ->orderBy('name', 'ASC')
                    ->paginate(10);
            return View::make('category.view_category', compact('items', 'search'));
        }
    }

}
