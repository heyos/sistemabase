@section('title')
    {{ $title }}
@endsection

@extends('layouts.master')

@section('content')

<input type="hidden" id="slug" value="{{ $slug }}">

<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left  col-12 mb-2">
      <h3 class="content-header-title mb-0">{{ $title }}</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ url('/') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
              {{ $title }}
            </li>
          </ol>
        </div>
        {{-- <div class="content-header-right text-md-right col-md-6 col-12">
          <div class="btn-group">
            <button class="btn btn-round btn-info" type="button"><i class="icon-cog3"></i> Settings</button>
          </div>
        </div> --}}
      </div>
    </div>
  </div>
  <div class="content-body">
    {{-- {{ dd(accesosPerfil(2)) }} --}}
    <div class="card">
      <div class="card-head">
        <div class="card-header">
          <h4 class="card-title">Todos los Perfiles </h4>
          <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
          <div class="heading-elements">
            <button type="button" id="btnAdd" class="btn btn-black text-white btn-sm"><i class="ft-plus white"></i> Agregar Perfil</button>
          </div>
        </div>
      </div>
      <div class="card-content">
        <div class="card-body">
          <!-- Task List table -->
          <div class="table-responsive">
            <table id="list-users" class="table table-condensed table-bordered table-middle compact">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Pagina de Inicio</th>
                  <th>Es Root?</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="listadoOk">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div id="modalRegistro" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Registrar Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="formRol">
                @csrf
                <input type="hidden" id="accion" name="accion" value="add" required>
                <input type="hidden" id="id" name="id" value="0" required="">

                <div class="form-group">
                    <div class="controls">
                      <label>Nombre</label>
                      <input type="text" id="nombre" name="nombre" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="controls">
                      <label>Es Root?</label><br>
                      <input type="checkbox" id="is_root" class="switch" data-class="switcher-success" name="is_root" value="1">
                    </div>
                </div>
                
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btn-save" class="btn btn-success">Guardar</button>
        </div>
    </div>
  </div>
</div>

<div id="modalInicio" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seleccionar Inicio de Pagina</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPage">
                  @csrf
                  <input type="hidden" id="accion" name="accion" value="start" required>
                  <input type="hidden" id="id" name="id" value="0" required="">
                  <div class="form-group">
                      <label>Perfil</label>
                      <input name="nombre" id="nombre" class="form-control" type="text" readonly="readonly">
                  </div>
                  <div class="form-group">
                      <label>Pagina de Inicio</label>
                      <select class="form-control select2" id="page_default" name="page_default">
                      </select>
                  </div>
                </form>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn-save" class="btn btn-success">Guardar</button>
            </div>
        </div> 
    </div>
</div>

@endsection

@section('script')
  @php
    echo filescripts($idMenu);
  @endphp
@endsection

    

