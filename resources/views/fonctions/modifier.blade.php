@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modification d'une fonction</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Modification d'une fonction</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('fonctions.update', $Fonctions->id) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Fonctions</label>
            <div class="col-md-6"><input type="text" name="LibFonction" class="form-control" value="{{ $Fonctions->LibFonction }}"></div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="form--group">
            <input type="submit" class="btn btn-info" value="Valider">
        </div>
      </form>
    </div>
  </section>
@endsection