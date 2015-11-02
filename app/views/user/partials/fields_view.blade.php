 <div class="form-group">
                {{Form::label('firstname', 'Nombre', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('firstname',$user->firstname, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('lastname', 'Apellido', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('lastname',$user->lastname, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('email',$user->email, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('position', 'Cargo', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('position',$user->position, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('identification', 'Identificación', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('identification',$user->identification, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('telephone', 'Telefono', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('telephone',$user->telephone, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('cellphone', 'Celular', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('cellphone',$user->cellphone, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('username', 'Usuario', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::label('username',$user->username, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('profile', 'Perfil', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('profile',array('operario'=>'Operario','supervisor'=>'Supervisor','super_admin'=>'Administrador'), $user->profile, array('class'=>'form-control','disabled' => 'true')) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), $user->enable, array('class'=>'form-control','disabled' => 'true')) }}
                </div>
            </div>