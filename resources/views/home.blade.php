@section('title')
    {{ $title }}
@endsection

@extends('layouts.master')

@section('content')
{{-- {{ $blade }} --}}

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
    @includeif('admin.'.$blade,['idMenu'=>$idMenu])
  </div>

</div>

@endsection

@section('script')
  @php
    echo filescripts($idMenu);
  @endphp
@endsection
