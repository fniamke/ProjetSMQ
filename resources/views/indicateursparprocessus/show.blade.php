@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>
              Cartographie du processus {{ $processus->LibProcessus }}
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

        <nav class="nav nav-tabs">
          <a class="nav-item nav-link active" href="#p1" data-toggle="tab">Indicateurs</a>
          <a class="nav-item nav-link" href="#p2" data-toggle="tab">Plans d'actions</a>
          <a class="nav-item nav-link" href="#p3" data-toggle="tab">Tâches</a>
          <a class="nav-item nav-link" href="#p4" data-toggle="tab">Parties intéressées</a>
          <a class="nav-item nav-link" href="#p5" data-toggle="tab">Grille d'analyse des risques</a>
        </nav>

        <div class="tab-content">
          <div class="tab-pane" id="p1">
            Panneau 2
            
            <table class="table table-striped table-sm">
              <tr>
                <td>Id</td>
                <td>Processus / Sous processus</td>
                <td>Indicateur</td>
                <td>Pér.</td>
                <td>Debut période</td>
                <td>Fin période</td>
                <td>Objectif</td>
                <td>Observation</td>
                <td>Actions</td>
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

                  <td>{{ $C->Observation }}</td>

                  <td>
                    <a href="{{ route('indicateursparprocessus.show', $processus->id . '¤' . 2)}}" class="btn btn-info" style="height:30px; width:90px">Histotique</a> 
                  </td>
                </tr>
              @endforeach
            
            </table>
          </div>

          <div class="tab-pane" id="p2">
            Panneau 2
            <table class="table table-striped table-sm">
              <tr>
                <td>Processus / Sous procesus</td>
                <td>Code PA</td>
                <td>Plan d'action</td>
                <td>Pilote / Sous pilote</td>
              </tr>
              
              @foreach($planactions as $C)
                <tr>
                  <td>{{ $C->LibProcessus }}</td>
                  <td>{{ $C->CodePlanaction }}</td>
                  <td>{{ $C->LibPlanaction }}</td>
                  <td>{{ $C->name }}</td>              
                </tr>
              @endforeach
            
            </table>
          </div>

          <div class="tab-pane" id="p3">
            Panneau 3

            <table class="table table-striped table-sm">
              <tr>
                <td>Id</td>
                <td>Processus / Sous procesus</td>
                <td>Plan d'actions</td>
                <td>Type moyen</td>
                <td>Intervenant</td>
                <td>Tâches</td>
                <td>Date début</td>
                <td>Date fin</td>
                <td>Etat</td>
              </tr>
              
              @foreach($Taches as $C)
                <tr>
                  <td>{{ $C->IdTaches }}</td>
                  <td>{{ $C->LibProcessus }}</td>
                  <td>{{ $C->LibPlanaction }}</td>
                  <td>{{ $C->LibTypeMoyen }}</td>
                  <td>{{ $C->name }}</td>
                  <td>{{ $C->LibTaches }}</td>
                  <td>{{ $C->DateDebut }}</td>
                  <td>{{ $C->DateFin }}</td>
                  <td>@if($C->Etat==0) En cours @elseif ($C->Etat==1) Fait @endif</td>          
                </tr>
              @endforeach
            
            </table>
          </div>

          <div class="tab-pane" id="p4">
            Panneau 4

            <table class="table table-striped table-sm">
              <tr>
                <td>Parties intéressées</td>
                <td>Contexte</td>
                <td>Niveau d'importance</td>
                <td>Attentes</td>
                <td>Niveau de relation</td>
                <td>Risques</td>
                <td>Opportunités</td>
                <td>Pertinence</td>
                <td>Date révision</td>
                <td>Actions</td>
              </tr>
              
              @foreach($partiesinteressees as $C)
                <tr>
                  <td>{{ $C->IdPartiesInt }}</td>
                  <td>{{ $C->LibPartiesInt }}</td>
                  <td>{{ $C->Contexte }}</td>
                  <td>{{ $C->ValeurNivImportance }}</td>
                  <td>{{ $C->Attentes }}</td>
                  <td>{{ $C->ValeurNivRelation }}</td>
                  <td>{{ $C->Risques }}</td>
                  <td>{{ $C->Opportunites }}</td>
                  <td>{{ $C->ValeurNivImportance * $C->ValeurNivRelation }}</td>
                  <td>{{ $C->DateRevision }}</td>
                </tr>
              @endforeach
            </table>
          </div>


          <div class="tab-pane" id="p5">
            Panneau 5
            <table class="table table-striped table-sm">
        <tr>
          <td>Id</td>
          <td>Risque / Opportunités</td>
          <td>Nature</td>
          <td>Effets</td>
          <td>Causes</td>
          <td>Gravité</td>
          <td>Probabilité</td>
          <td>Détection</td>
          <td>Criticité</td>
          <td>Description de la maîtrise actuelle (MA)</td>
          <td>Evaluation MA</td>
          <td>Evaluation Risque Résiduel</td>

          <td>Date révision</td>
          <td>Actions</td>
        </tr>
        
        @foreach($analyserisques as $C)
          <tr>
            <td>{{ $C->IdAnalyserisques }}</td>
            <td>{{ $C->LibRisqueOpportunite }}</td>
            <td>{{ $C->Nature }}</td>
            <td>{{ $C->Effets }}</td>
            <td>{{ $C->Causes }}</td>
            <td>{{ $C->NoteGravite }}</td>
            <td>{{ $C->NoteProbabilite }}</td>
            <td>{{ $C->NoteDetection }}</td>
            <td>{{ $C->NoteCriticite }}</td>
            <td>{{ $C->DescriptionMA }}</td>
            <td>{{ $C->EvaluationMA }}</td>
            <td>{{ $C->EvaluationRR }}</td>

            <td>{{ $C->DateRevision }}</td>

          </tr>
        @endforeach
      
      </table>
            
          </div>

        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.0/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </section>
@endsection