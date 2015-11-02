<?php

class UserController extends \BaseController {
    ////////////////////////////////////////////////////////////////////////////
    // SECCION DE CODIGO PARA CRUD DE ADMINISTRADOR Y UTILIZAR "RESOURCES" DE LARAVEL
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $items = User::orderBy('username', 'ASC')->paginate(10);
        return View::make('user.view_user', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $user = new User;
        $show = false;
        return View::make('user.new_edit_user', compact('user', 'show'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $user = new User;
        if (Input::get('lastname')) {
            $user->lastname = Input::get('lastname');
        }
        if (Input::get('firstname')) {
            $user->firstname = Input::get('firstname');
        }
        if (Input::get('username')) {
            $user->username = Input::get('username');
        }
        if (Input::get('email')) {
            $user->email = Input::get('email');
        }
        if (Input::get('password')) {
            $user->password = Hash::make(Input::get('password'));
        }
        if (Input::get('position')) {
            $user->position = Input::get('position');
        }
        if (Input::get('identification')) {
            $user->identification = Input::get('identification');
        }
        if (Input::get('telephone')) {
            $user->telephone = Input::get('telephone');
        }
        if (Input::get('cellphone')) {
            $user->cellphone = Input::get('cellphone');
        }
        if (Input::get('enable')) {
            $user->enable = Input::get('enable');
        }
        $user->save();
        if (Input::get('profile')) {
            $profile = Input::get('profile');
            $user->profile = Input::get('profile');
            $user->roles()->sync(User::makeProfile($profile));
            $user->save();
        }
        //Imagen asociada
        if (Input::hasFile('file')) {
            $f = Input::file('file');
            if ($f) {
                $att = new Attachment;
                $att->user_id = $user->id;
                $r = array();
                $r = AttachmentController::uploadAttachment($f, $att);
            }
        }
        return Redirect::to('admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id= null) {
        $user = User::find($id);
        $show = true;
        return View::make('user.new_edit_user', compact('user', 'show'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id= null) {
        $user = User::find($id);
        $show = false;
        return View::make('user.new_edit_user', compact('user', 'show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $user = User::find($id);
        if (Input::get('lastname')) {
            $user->lastname = Input::get('lastname');
        }
        if (Input::get('firstname')) {
            $user->firstname = Input::get('firstname');
        }
        if (Input::get('username')) {
            $user->username = Input::get('username');
        }
        if (Input::get('email')) {
            $user->email = Input::get('email');
        }
        if (Input::get('password')) {
            $user->password = Hash::make(Input::get('password'));
        }
        if (Input::get('position')) {
            $user->position = Input::get('position');
        }
        if (Input::get('identification')) {
            $user->identification = Input::get('identification');
        }
        if (Input::get('telephone')) {
            $user->telephone = Input::get('telephone');
        }
        if (Input::get('cellphone')) {
            $user->cellphone = Input::get('cellphone');
        }
        if (Input::get('enable')) {
            $user->enable = Input::get('enable');
        }
        if (Input::get('profile')) {
            $user->profile = Input::get('profile');
            $profile = Input::get('profile');
            $user->roles()->sync(User::makeProfile($profile));
        }
        //Imagen relacionada
        if (Input::hasFile('file')) {
            AttachmentController::destroyAllBy('user_id', $user->id);
            $f = Input::file('file');
            if ($f) {
                $att = new Attachment;
                $att->user_id = $user->id;
                $r = array();
                $r = AttachmentController::uploadAttachment($f, $att);
            }
        }
        $user->save();
        return Redirect::to('admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        //Eliminamos imagen asociada de usuario
        AttachmentController::destroyAllBy('user_id', $user->id);
        return Redirect::to('admin/user');
    }

    ////////////////////////////////////////////////////////////////////////////
    // SECCION DE CODIGO PARA OTROS USOS
    ////////////////////////////////////////////////////////////////////////////

    /**
     * Metodo para llamar la vista de login de la aplicacion
     */
    public function login() {
        return View::make('login');
    }

    /**
     * Autentica el ingreso de un usuario desde el hoe
     */
    public function doLogin() {
        // se define la validacion de los campos
        $rules = array('username' => 'required', 'password' => 'required|min:4');
        // Se validan los datos ingresados segun las reglas definidas
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            if (Request::ajax()) {
                $error = implode(' ', $validator->messages()->all());
                $error = str_ireplace('username', 'usuario', $error);
                $error = str_ireplace('password', 'contraseña', $error);
                return Response::json(array(
                            'valid' => false,
                            'error' => $error), 200);
            } else {
                return Redirect::to(URL::previous())
                                ->withErrors($validator) // send back all errors to the login form
                                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
            }
        } else {
            // Se capturan los datos para la autenticacion
            $userdata = array(
                'username' => Input::get('username'),
                'password' => Input::get('password')
            );

            if (Request::ajax()) {
                $arrjson = array();
                // se hace autenticacion para AJAX
                if (Auth::attempt($userdata)) {
                    // Autenticacion Correcta, redirecciona al respectivo main
                    //$redirect = ($this->userIsAdmin()) ? URL::to('admin/main') : URL::previous();
                    $redirect = URL::to('admin/main');
                    $arrjson = array(
                        'valid' => true,
                        'redirect' => $redirect,
                        'user' => Auth::user(), 200);
                } else {
                    // Autenticacion Incorrecta, redireciona a pagina anterior
                    $arrjson = array(
                        'valid' => false,
                        'redirect' => URL::previous(),
                        'error' => 'Usuario o Contraseña incorrectos!', 200);
                }
                return Response::json($arrjson);
            } else {
                // se hace autenticacion para HTTP
                if (Auth::attempt($userdata)) {
                    return Redirect::to(URL::to('admin/main')); //: Redirect::to(URL::previous());
                } else {
                    // Autenticacion Incorrecta, redireciona a pagina anterior
                    //return Redirect::to(URL::previous());
                    return Redirect::back()->with('error_message', 'Usuario o Contraseña incorrectos!')->withInput();
                }
            }
        }
    }

    /**
     * Metodo para cerrar la sesion del usuario
     */
    public function doLogout() {
        if (Auth::check()) {
            Auth::logout();
        }
        return Redirect::to('/');
    }

    /**
     * Metodo para verificar si un usuario ya existe
     * @param String username, nombre de usuario a verificar
     * @return Bool
     */
    public static function checkUserNameExist($username) {
        $user = User::where('username', '=', $username)->get();
        return (count($user) > 0) ? true : false;
    }

    /**
     * Metodo para verificar si un usuario ya existe
     */
    public function userNameExist() {
        if (Input::get('username')) {
            $username = Input::get('username');
            $exist = UserController::checkUserNameExist($username);
            if (Request::ajax()) {
                return Response::json(array('valid' => true, 'response' => $exist), 200);
            } else {
                echo 'existe? ' . $exist;
            }
        }
    }

    /**
     * Metodo para hacer la busqueda de un usuario
     */
    public static function search() {
        $items = array();
        $search = '';
        if (Input::get('search')) {
            $search = Input::get('search');
            $arrparam = explode(' ', $search);
            $items = User::whereNested(function($q) use ($arrparam) {
                        $p = $arrparam[0];
                        $q->whereNested(function($q) use ($p) {
                            $q->where('firstname', 'LIKE', '%' . $p . '%');
                            $q->orwhere('lastname', 'LIKE', '%' . $p . '%');
                            $q->orwhere('username', 'LIKE', '%' . $p . '%');
                            $q->orwhere('email', 'LIKE', '%' . $p . '%');
                            $q->orwhere('identification', 'LIKE', '%' . $p . '%');
                        });
                        $c = count($arrparam);
                        if ($c > 1) {
                            //para no repetir el primer elemento
                            //foreach ($arrparam as $p) {
                            for ($i = 1; $i < $c; $i++) {
                                $p = $arrparam[$i];
                                $q->whereNested(function($q) use ($p) {
                                    $q->where('firstname', 'LIKE', '%' . $p . '%');
                                    $q->orwhere('lastname', 'LIKE', '%' . $p . '%');
                                    $q->orwhere('username', 'LIKE', '%' . $p . '%');
                                    $q->orwhere('email', 'LIKE', '%' . $p . '%');
                                    $q->orwhere('identification', 'LIKE', '%' . $p . '%');
                                }, 'OR');
                            }
                        }
                    })
                    ->whereNull('deleted_at')
                    ->orderBy('firstname', 'ASC')
                    ->paginate(10);
            return View::make('user.view_user', compact('items', 'search'));
        }
    }

}
