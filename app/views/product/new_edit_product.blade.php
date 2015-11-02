@extends('template.generic_admin')
@section('body_content')
<div class="container-fluid">
    <hr>
    @if(!$show)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-oil"></i> @if($product->id) Editar @else Crear @endif producto</h3>
        </div>
        <div class="panel-body">
            @if($product->id)
            @if(Auth::user()->hasRole('4.2'))
            {{ Form::model($product, ['id' => 'form_product', 'route' => ['admin.product.update', $product->id], 'method' => 'put', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @else
            @if(Auth::user()->hasRole('4.1'))
            {{ Form::model($product, ['id' => 'form_product', 'route' => 'admin.product.store', 'role'=>'form', 'class'=>'form-horizontal']) }}
            @endif
            @endif

            @if (!empty($product))
            <!--Mensajes de validaciones-->
            @include('alert.messages-validations')
            <!--Fin Mensajes de validaciones-->
            <div class="form-group">
                {{Form::label('category_id', 'Pertenence a', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('category_id',$array_category, null, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('name',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('description', 'Descripcion', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::textarea('description',null, array('class' => 'form-control' , 'size' => '20x4'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('cost', 'Costo', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('cost',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('value', 'Valor', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{Form::text('value',null, array('class' => 'form-control'))}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
                <div class="col-sm-4">
                    {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), null, array('class'=>'form-control')) }}
                </div>
            </div>
            @else
            <p class="">No existe información para éste producto</p>
            @endif
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-4">
                    {{ Form::submit('Guardar', array('class' =>'btn btn-primary', 'id'=>'save_button')) }}
                    <span></span>
                    <a href="{{URL::to('/')}}/admin/product" class="btn btn-info">Cancelar</a>
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
        <h3 class="panel-title">Detalles Producto</h3>
    </div>
    <div class="panel-body">
        {{ Form::open(array('role'=>'form', 'class'=>'form-horizontal'))}}
        @if(!empty($product))
        <div class="form-group">
            {{Form::label('category_id', 'Pertenence a', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{ Form::select('category_id',$array_category, $product->category_id, array('class'=>'form-control','disabled' => 'true')) }}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('name', 'Nombre', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('name',$product->name, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('description', 'Descripcion', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('description',$product->description, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('cost', 'Costo', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('value',$product->cost, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('value', 'Valor', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{Form::label('value',$product->value, array('class' => 'form-control'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('enable', 'Habilitado', array('class' => 'control-label col-sm-2'))}}
            <div class="col-sm-4">
                {{ Form::select('enable',array('SI'=>'SI','NO'=>'NO'), $product->enable, array('class'=>'form-control','disabled' => 'true')) }}
            </div>
        </div>
        @else
        <p class="">No existe información para éste producto</p>
        @endif
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <a href="{{URL::to('/')}}/admin/product" class="btn btn-info">Volver</a>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endif
@stop