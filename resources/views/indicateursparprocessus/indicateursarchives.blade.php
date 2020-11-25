@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              Historique des indicateurs du processus {{ $processus->LibProcessus }}
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Cartographie du processus</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    

    <div class="container-fluid">
      <form method="post" action="{{ route('processus.update', $processus->id) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Type de processus</label>
          <div class="col-md-6">
            <select name="Id" id="Id" class="form-control">
                <option disabled selected> </option>
                @foreach($Typesprocessus as $c)
                    <option value="{{ $c->id }}" @if($processus->IdTypeProcessus==$c->id) selected="selected" @endif>{{ $c->LibTypesProcessus }}</option>
                @endforeach
            </select>
          </div>
          <div class="clearfix"></div>
        </div>
        
        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Processus</label>
            <div class="col-md-6"><input type="text" name="LibProcessus" class="form-control" value="{{ $processus->LibProcessus }}"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Finalité (champ d'application)</label>
          <div class="col-md-6"><input type="text" name="ChampApplication" class="form-control" value="{{ $processus->ChampApplication }}"></div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Pilote</label>
          <div class="col-md-6">
            <select name="IdPilote" id="IdPilote" class="form-control">
                <option disabled selected> </option>
                @foreach($Pilote as $c)
                    <option value="{{ $c->id }}" @if($processus->IdPilote==$c->id) selected="selected" @endif>{{ $c->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <table class="table table-striped table-sm">
          <tr>
            <td>Id</td>
            <td>Processus / Sous processus</td>
            <td>Indicateur</td>
            <td>Pér.</td>
            <td>Debut période</td>
            <td>Fin période</td>
            <td>Objectif</td>            
            <td>Résultat</td>
            <td>Etat</td>
            <td>Observation</td>
          </tr>
          
          @foreach($Indicateurs as $C)
            <tr>              
              <td>{{ $C->IdIndicateur }}</td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp {{ $C->LibProcessus }}</td>
              <td>{{ $C->LibIndicateur }}</td>
              <td>{{ $C->Periodicite }}</td>
              <td>{{ $C->DebutPeriode }}</td>
              <td>{{ $C->FinPeriode }}</td>
              <td>{{ $C->Objectif }} %</td>
              td>{{ $C->Resultat }}</td>
              <td>{{ $C->Etat }} %</td>
              <td>{{ $C->Observation }}</td>
            </tr>
          @endforeach
        
        </table>
  </section>
@endsection