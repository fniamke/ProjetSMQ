@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Saisir les résultats d'un indicateur</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Résultats d'un indicateur</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('indicateurs.update', $indicateurs->id . '¤' . $TypeAction) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Processus</label>
            <div class="col-md-6">
              <select name="IdProcessus" id="IdProcessus" class="form-control">
                  <option disabled selected> </option>
                  @foreach($processus as $c)
                      <option value="{{ $c->id }}" @if($indicateurs->IdProcessus==$c->id) selected="selected" @endif>{{ $c->LibProcessus }}</option>
                  @endforeach
              </select>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>       
        
        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Sous processus</label>
            <div class="col-md-6">           
              <select name="IdSousProcessus" id="IdSousProcessus" class="form-control">
                  <option disabled selected> </option>
                  @foreach($sousprocessus as $c)
                      <option value="{{ $c->IdSousProcessus }}" @if($indicateurs->IdSousProcessus==$c->IdSousProcessus) selected="selected" @endif>{{ $c->LibSousProcessus }}</option>
                  @endforeach
              </select>             
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Indicateur</label>
            <div class="col-md-6"><input type="text" name="LibIndicateur" class="form-control" value="{{ $indicateurs->LibIndicateur }}">
            </div>
            <div class="clearfix"></div>
        </div>
 
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Périodicité</label>
          <div class="col-md-6">
             <select name="Periodicite" id="Periodicite" class="form-control">
                <option value="{{ $indicateurs->Periodicite }}" > </option>
                <option value="M" @if($indicateurs->Periodicite=="M") selected="selected" @endif>Mensuelle</option>
                <option value="T" @if($indicateurs->Periodicite=="T") selected="selected" @endif>Trimestrielle</option>
                <option value="S" @if($indicateurs->Periodicite=="S") selected="selected" @endif>Semestrielle</option>
            </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Date début période</label>
          <div class="col-md-6">
            <input type="date" name="DateDebutPeriode" class="form-control" value="{{ date('Y-m-d',  strtotime( $indicateurs->DateDebutPeriode )) }}">
          </div>
          <div class="clearfix"></div>
        </div>
        
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Date fin période</label>
          <div class="col-md-6"><input type="text" name="DebutPeriode0" class="form-control" value=" {{ date('Y-m-d', strtotime('+1 month', strtotime( $indicateurs->DateDebutPeriode ))) }}"></div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Période début</label>
          <div class="col-md-6"><input type="text" name="DebutPeriode" class="form-control" value="{{ $indicateurs->DebutPeriode }}"></div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Période fin</label>
          <div class="col-md-6"><input type="text" name="FinPeriode" class="form-control" value="{{ $indicateurs->FinPeriode }}"></div>
          
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Objectif</label>
          <div class="col-md-6"><input type="text" name="Objectif" class="form-control" value="{{ $indicateurs->Objectif }}">
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Résultat</label>
          <div class="col-md-6"><input type="text" name="Resultat" class="form-control" value="{{ $indicateurs->Resultat }}">
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Observation</label>
          <div class="col-md-6"><input type="textarea" name="Observation" class="form-control" value="{{ $indicateurs->Observation }}">
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