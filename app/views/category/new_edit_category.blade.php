@extends('template.generic_admin')
@section('body_content')
<div class="container-fluid">
    <hr>
    @if(!$show)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-list"></i>  @if($category->id) Editar @else Crear @endif categoria</h3>
        </div>
        <div class="panel-body">
            @if($category->id)
            @if(Auth::user()->hasRole('2.2'))
            {{ Form::model($category, ['id' => 'form_category', 'route' => ['admin.category.update', $category->id], 'method' => 'put', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @else
            @if(Auth::user()->hasRole('2.1'))
            {{ Form::model($category, ['id' => 'form_category', 'route' => 'admin.category.store', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @endif

            @if(!empty($category))
            <!--Mensajes de validaciones-->
            @include('alert.messages-validations')
            <!--Fin Mensajes de validaciones-->
            <div class="form-group">
                {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('name',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('description', 'Descripcion', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-8">
                    {{Form::textarea('description',null, array('class' => 'ckeditor form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), null, array('class'=>'form-control')) }}
                </div>
            </div>

            @else
            <p class="">No existe información para esta categoria</p>
            @endif
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    {{ Form::submit('Guardar', array('class' =>'btn btn-primary', 'id'=>'save_button')) }}
                    <span></span>
                    <a href="{{URL::to('/')}}/admin/category" class="btn btn-info">Cancelar</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

</div>
@else
<!-- Contenido de la visualizacion del item -->
<hr>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Detalles Categoria</h3>
    </div>
    <div class="panel-body">
        {{ Form::open(array('role'=>'form', 'class'=>'form-horizontal'))}}
        @if(!empty($category))
        <div class="form-group">
            {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('name',$category->name, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('description', 'Descripcion', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-8">
                {{Form::textarea('description',$category->description, array('class' => 'ckeditor form-control'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), $category->enable, array('class'=>'form-control','disabled' => 'true')) }}
            </div>
        </div>
        @else
        <p class="">No existe información para esta categoria</p>
        @endif
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <a href="{{URL::to('/')}}/admin/category" class="btn btn-info">Volver</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endif
@stop
<script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
