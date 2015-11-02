            <div class="form-group">
                {{Form::label('file', 'Imagen relacionada', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    @if(count($user->attachment) > 0)
                    <div class="wrapper">
                        <div id="image_refresh">
                            <a href="{{AttachmentController::getAttachmentURL($user->attachment[0]->id, 'download')}}" target="_blank" class="btn btn-success"><span class="glyphicon glyphicon-download-alt"></span>&nbsp;&nbsp;Descargar</a><br>
                            <img src="{{AttachmentController::getAttachmentURL($user->attachment[0]->id)}}" style="max-height: 100px"/><br><br>
                        </div>
                    </div>
                    @endif
                    <input type="file" name="file" accept="image/*"/>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('firstname', 'Nombre', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('firstname',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('lastname', 'Apellido', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('lastname',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::email('email',null, array('class' => 'form-control'))}}
                    <div></div>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('position', 'Cargo', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('position',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('identification', 'Identificación', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('identification',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('telephone', 'Telefono', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('telephone',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('cellphone', 'Celular', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('cellphone',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('username', 'Usuario', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('username',null, array('class' => 'form-control'))}}
                    <div></div>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('password', 'Contraseña', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::password('password', array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('profile', 'Perfil', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('profile',array('operario'=>'Operario','supervisor'=>'Supervisor','super_admin'=>'Administrador'), null, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), null, array('class'=>'form-control')) }}
                </div>
            </div>