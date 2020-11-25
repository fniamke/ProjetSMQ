@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ajout d'un indicateur</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Ajout d'un indicateur</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('indicateurs.store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Processus</label>
            <div class="col-md-6">           
              <select name="IdProcessus" id="IdProcessus" class="form-control">
                  <option disabled selected> </option>
                  @foreach($processus as $c)
                      <option value="{{ $c->id }}">{{ $c->LibProcessus }}</option>
                  @endforeach
              </select>             
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Sous processus</label>
            <div class="col-md-6">           
              <select name="IdSousProcessus" id="IdSousProcessus" class="form-control">
                  <option disabled selected> </option>
                  @foreach($sousprocessus as $c)
                      <option value="{{ $c->IdSousProcessus }}">{{ $c->LibSousProcessus }}</option>
                  @endforeach
              </select>             
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Indicateur</label>
            <div class="col-md-6"><input type="text" name="LibIndicateur" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Périodicité</label>
            <div class="col-md-6">
               <select name="Periodicite" id="Periodicite" class="form-control">
                  <option disabled selected> </option>
                  <option value="M">Mensuelle</option>
                  <option value="T">Trimestrielle</option>
                  <option value="S">Semestrielle</option>
              </select>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right" >Date début période</label>
            <div class="col-md-6"><input type="date" name="DateDebutPeriode" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Période début</label>
            <div class="col-md-6"><input type="text" name="DebutPeriode" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Période fin</label>
            <div class="col-md-6"><input type="text" name="FinPeriode" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Objectif</label>
            <div class="col-md-6"><input type="text" name="Objectif" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form--group">
            <input type="submit" class="btn btn-info" value="Valider">
        </div>
      </form>
    </div>
  </section>
@endsection