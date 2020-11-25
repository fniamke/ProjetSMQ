@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ajout d'une partie intéressée</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Ajout d'une partie intéressée</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('partiesinteressees.store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right" >Date de révision</label>
            <div class="col-md-6"><input type="date" name="DateRevision" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Processus</label>
            <div class="col-md-6">           
              <select name="IdProcessus" id="IdProcessus" class="form-control">
                  <option disabled selected> </option>
                  @foreach($Processus as $c)
                      <option value="{{ $c->id }}">{{ $c->LibProcessus }}</option>
                  @endforeach
              </select>
              
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Parties intéressées</label>
            <div class="col-md-6"><input type="text" name="LibPartiesInt" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Contexte</label>
            <div class="col-md-6"><input type="text" name="Contexte" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Niveau d'importance</label>
          <div class="col-md-6">
            <select name="IdNivImportance" id="IdNivImportance" class="form-control">
                <option disabled selected> </option>
                @foreach($NiveauImportance as $c)
                    <option value="{{ $c->IdNivImportance }}">{{ $c->LibNivImportance }}</option>
                @endforeach
            </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Attentes</label>
            <div class="col-md-6"><input type="text" name="Attentes" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Niveau de relation</label>
          <div class="col-md-6">
            <select name="IdNivRelation" id="IdNivRelation" class="form-control">
                <option disabled selected> </option>
                @foreach($NiveauRelation as $c)
                    <option value="{{ $c->IdNivRelation }}">{{ $c->LibNivRelation }}</option>
                @endforeach
            </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Risques</label>
            <div class="col-md-6"><input type="text" name="Risques" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Opportunités</label>
            <div class="col-md-6"><input type="text" name="Opportunites" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Pertinence</label>
          <div class="col-md-6">
            <select name="IdCotation" id="IdCotation" class="form-control">
                <option disabled selected> </option>
                @foreach($Cotation as $c)
                    <option value="{{ $c->IdCotation }}">{{ $c->LibCotation }}</option>
                @endforeach
            </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form--group">
            <input type="submit" class="btn btn-info" value="Valider">
        </div>
      </form>
    </div>

  </section>
@endsection