@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modification d'un niveau d'importance/h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Modification d'un niveau d'importance</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('niveauimportance.update', $niveauimportance->IdNivImportance) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Niveau d'importance</label>
            <div class="col-md-6"><input type="text" name="LibNivImportance" class="form-control" value="{{ $niveauimportance->LibNivImportance }}"></div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Valeur du niveau</label>
            <div class="col-md-6"><input type="text" name="ValeurNivImportance" class="form-control" value="{{ $niveauimportance->ValeurNivImportance }}"></div>
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