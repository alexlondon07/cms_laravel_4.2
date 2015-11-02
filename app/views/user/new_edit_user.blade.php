@extends('template.generic_admin')
@section('body_content')
<div class="container-fluid">
    <hr>
    @if(!$show)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>@if($user->id) Editar @else Crear @endif usuario</h3>
        </div>
        <div class="panel-body">
            @if($user->id)
              @if(Auth::user()->hasRole('2.2'))
              {{ Form::model($user, ['id' => 'form_user', 'route' => ['admin.user.update', $user->id], 'method' => 'put', 'files'=>true, 'role'=>'form', 'class'=>'form-horizontal']) }}
              {{Form::hidden('username_old', $user->username, array('id'=>'username_old'))}}
              @endif
            @else
              @if(Auth::user()->hasRole('2.1'))
              {{ Form::model($user, ['id' => 'form_user', 'route' => 'admin.user.store', 'files'=>true, 'role'=>'form', 'class'=>'form-horizontal']) }}
              @endif
            @endif

            @if (!empty($user))
                {{-- Campos del formulario --}}
                    @include ('user.partials.fields_create_edit')
                {{-- Fin Campos del formulario --}}
            @else
            <p class="">No existe información para éste usuario</p>
            @endif
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    {{ Form::submit('Guardar', array('class' =>'btn btn-primary', 'id'=>'save_button')) }}
                    <span></span>
                    <a href="{{URL::to('/')}}/admin/user" class="btn btn-info">Cancelar</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

    @else
    <!-- Contenido de la visualizacion del item -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Detalles Usuario</h3>
        </div>
        <div class="panel-body">
            {{ Form::open(array('role'=>'form', 'class'=>'form-horizontal'))}}
            @if (!empty($user))
                {{-- Campos del formulario --}}
                    @include ('user.partials.fields_view')
                {{-- Fin Campos del formulario --}}
            @else
            <p class="">No existe información para éste usuario</p>
            @endif
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    <a href="{{URL::to('/')}}/admin/user" class="btn btn-info">Volver</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    @endif
</div>
@stop
@section('javascript_content')
<script type="text/javascript" src="{{ URL::to('/') }}/js/User.js?v={{ Util::version() }}"></script>
@stop
