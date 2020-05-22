@section('title')
    {{ $title }}
@endsection

@extends('layouts.master')

@section('content')
{{ $blade ?? $idMenu}}
@includeif('admin.'.$blade,['idMenu'=>$idMenu])

{{-- @includeif(); --}}

<!-- Large modal -->
{{-- <button type="button" class="btn btn-primary" id="openModal">Large modal</button>


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form id="form-cateproducto">
          <input type="text" name="id"> <br>
          <input type="text" name="nombre">
          
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
 --}}
@endsection

@section('script')
    @php
        echo filescripts($idMenu);
    @endphp
@endsection
