@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modification d'un texte (lois, convention, norme)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Modification d'un texte (lois, convention, norme)</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('lois.update', $Lois->id) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="row">
            <label class="col-md-3">Catégorie de texte</label>
            <div class="col-md-6">
              <select name="Id" id="Id" class="form-control">
                  <option disabled selected> </option>
                  @foreach($Categorieslois as $c)
                      <option value="{{ $c->id }}" @if($Lois->IdCategoriesLois==$c->id) selected="selected" @endif>{{ $c->categorieslois }}</option>
                  @endforeach
              </select>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="row">
            <label class="col-md-3">Texte (lois, convention, norme)</label>
              <div class="col-md-6"><input type="text" name="LibLois" class="form-control" value="{{ $Lois->LibLois }}"></div>
              <div class="clearfix"></div>
          </div>

          <div class="row">
            <label class="col-md-3">Date de promulgation</label>
            <div class="col-md-6"><input type="date" name="DatePromulgation" class="form-control" value="{{ $Lois->DatePromulgation }}"></div>
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