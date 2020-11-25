@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ajout d'un texte (lois, convention, norme)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Ajout d'un texte (lois, convention, norme)</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('lois.store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <div class="row">
              <label class="col-md-3 text-md-right">Catégorie de texte</label>
              <div class="col-md-6">
                
                <select name="Id" id="Id" class="form-control">
                    <option disabled selected> </option>
                    @foreach($Categorieslois as $c)
                        <option value="{{ $c->id }}">{{ $c->categorieslois }}</option>
                    @endforeach
                </select>
                
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3 text-md-right">Texte (lois, convention, norme)</label>
                <div class="col-md-6"><input type="text" name="LibLois" class="form-control"></div>
                <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3 text-md-right">Date de promulgation</label>
              <div class="col-md-6"><input type="date" name="DatePromulgation" class="form-control"></div>
              <div class="clearfix"></div>
            </div>
          </div>

        <!--
          <div class="row">
            <label class="col-md-3">Choisir un fichier</label>
            <div class="custom-file col-md-6" >
              <input type="file" name="file" class="custom-file-input" id="chooseFile">
              <label class="custom-file-label" for="chooseFile"></label>
            </div>
          </div>

          <input type="text" name="NomSociete" class="form-control" required autocomplete="NomSociete" autofocus>

          -->

          <div class="form-group">
            <div class="row">
            <label class="col-md-3 col-form-label text-md-right"></label>
            <div class="custom-file col-md-6" >
                <input type="hidden" name="MAX_FILE_SIZE" value="100000" class="custom-file-input"/>
                <input type="file" name="monfichier" />
                </div>
              <div class="clearfix"></div>
            </div>
          </div>



        <!--
        <div class="form-group">
            <label for="da_datequotation"></label>
            <input class="form-control form-control-sm" id="da_datequotation" type="date" name="da_datequotation" value="">
        </div>
        

        <div class="form-group">
              <label for="da_type">{{__('achat.type')}}</label>
              <select class="form-control form-control-sm" name="da_type">
                  <option disabled selected> </option>
                  <option value="comptant" {{old("da_type")=="comptant" ? "selected" :""}}> {{__('achat.comptant')}} </option>
                  <option value="terme" {{old("da_type")=="terme" ? "selected" : ""}}> {{__('achat.terme')}} </option>
              </select>
              {!! $errors->first('da_type', '<span class="error">:message</span>')!!}
          </div>
          -->

        <div class="form--group">
            <input type="submit" class="btn btn-info" value="Valider">
        </div>
      </form>
    </div>
  </section>
@endsection