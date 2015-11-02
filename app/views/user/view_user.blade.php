@extends('template.generic_admin')

@section('head_content')
@stop

@section('body_content')
<div class="container-fluid">
    <div class="row">
        <div class="main">
            <h1 class="page-header">Usuarios</h1>
            <div class="controls form-inline">
                @if(Auth::user()->hasRole('2.1'))
                    <a href="{{ URL::to('/') }}/admin/user/create" class="btn btn-primary pull-right">Ingresar usuarios</a>
                @endif
                <div class="input-group">
                  {{ Form::open(array('url' => 'admin/users/search', 'id' => 'search_form', 'method'=>'GET', 'class'=>'control-group')) }}
                  <div class="form-group">
                        <input id="search"  name="search"  type="text" required="true" class="form-control" placeholder="Buscar..." value="@if(isset($search)){{ $search }}@endif" >
                  </div>
                  <button class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                  <a href="{{URL::to('/')}}/admin/user" title="Refrescar Usuarios"class="btn btn-default"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
                  {{ Form::close() }}
              </div>
          </div>
            <div class="table-responsive">
                @if (count($items) > 0)
                <h4>{{$items->getTotal()}} resultados </h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Identificación</th>
                            <th>Identificación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td style="width: 150px !important">
                                <table>
                                    <tr>
                                        <td><a title="Detalles" href="{{ URL::to('/') }}/admin/user/{{ $item->id }}"><span class="glyphicon glyphicon-eye-open btn btn-default btn-xs"></span></a></td>
                                        @if(Auth::user()->hasRole('2.2'))
                                        <td><a title="Editar" href="{{ URL::to('/') }}/admin/user/{{ $item->id }}/edit"><span class="glyphicon glyphicon-edit btn btn-default btn-xs"></span></a></td>
                                        @endif
                                        @if(Auth::user()->hasRole('2.3'))
                                        <td>{{ Form::open(['action' => ['UserController@destroy', $item->id], 'method' => 'delete', 'style' => 'display: inline;']) }}
                                            <button title="Eliminar" type="submit" onclick="return Util.confirmDelete(this);" class="glyphicon glyphicon-trash btn btn-default btn-xs"></button>
                                            {{ Form::close() }}
                                        </td>
                                        @endif
                                    </tr>
                                </table>
                            </td>
                            <td>{{ $item->firstname }}</td>
                            <td>{{ $item->lastname }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->identification }}</td>
                            <td>
                                @if(count($item->attachment) > 0)
                                <a href="{{AttachmentController::getAttachmentURL($item->attachment[0]->id, 'download')}}" target="_blank" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-download-alt "></span>&nbsp;&nbsp;
                                    <!--{{ $item->attachment[0]->name }}-->Descargar
                                </a><br>
                                <a href="{{AttachmentController::getAttachmentURL($item->attachment[0]->id)}}" target="_blank" >
                                    <img src="{{AttachmentController::getAttachmentURL($item->attachment[0]->id)}}" style="max-height: 50px"/>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav class="text-center">
                    {{$items->appends(Request::input())->links()}}
                </nav>
                @else
                No hay datos!
                @endif
            </div>
        </div>
    </div>
</div>
@stop