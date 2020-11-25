@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modification d'un risque</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Modification d'un risque</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('analyserisques.update', $analyserisques->IdAnalyserisques)}}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right" >Date de révision</label>
            <div class="col-md-6"><input type="date" name="DateRevision" class="form-control" value="{{ date('Y-m-d',  strtotime( $analyserisques->DateRevision )) }}"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Processus</label>
            <div class="col-md-6">           
              <select name="IdProcessus" id="IdProcessus" class="form-control">
                  <option disabled selected> </option>
                  @foreach($Processus as $c)
                      <option value="{{ $c->id }}" @if($analyserisques->IdProcessus==$c->id) selected="selected" @endif>{{ $c->LibProcessus }}</option>
                  @endforeach
              </select>
              
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Risque / Opportunités</label>
            <div class="col-md-6"><input type="text" name="LibRisqueOpportunite" class="form-control" value="{{ $analyserisques->LibRisqueOpportunite }}"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Nature</label>
            <div class="col-md-6"><input type="text" name="Nature" class="form-control" value="{{ $analyserisques->Nature }}"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Effet</label>
            <div class="col-md-6"><input type="text" name="Effets" class="form-control" value="{{ $analyserisques->Effets }}"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Cause</label>
            <div class="col-md-6"><input type="text" name="Causes" class="form-control" value="{{ $analyserisques->Causes }}"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Gravité</label>
          <div class="col-md-6">
            <select name="IdGravite" id="IdGravite" class="form-control">
                <option disabled selected> </option>
                @foreach($gravite as $c)
                    <option value="{{ $c->IdGravite }}" @if($analyserisques->IdGravite==$c->IdGravite) selected="selected" @endif>{{ $c->Gravite }}</option>
                @endforeach
            </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Probabilité</label>
          <div class="col-md-6">
            <select name="IdProbabilite" id="IdProbabilite" class="form-control">
                <option disabled selected> </option>
                @foreach($probabilite as $c)
                    <option value="{{ $c->IdProbabilite }}" @if($analyserisques->IdProbabilite==$c->IdProbabilite) selected="selected" @endif>{{ $c->Probabilite }}</option>
                @endforeach
            </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Détection</label>
          <div class="col-md-6">
            <select name="IdDetection" id="IdDetection" class="form-control">
                <option disabled selected> </option>
                @foreach($detection as $c)
                    <option value="{{ $c->IdDetection }}" @if($analyserisques->IdDetection==$c->IdDetection) selected="selected" @endif>{{ $c->Detection }}</option>
                @endforeach
            </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Criticité</label>
          <div class="col-md-6">
            <select name="IdCriticite" id="IdCriticite" class="form-control">
                <option disabled selected> </option>
                @foreach($criticite as $c)
                    <option value="{{ $c->IdCriticite }}" @if($analyserisques->IdCriticite==$c->IdCriticite) selected="selected" @endif>{{ $c->Criticite }}</option>
                @endforeach
            </select>
          </div>
          <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Description MA</label>
            <div class="col-md-6"><input type="text" name="DescriptionMA" class="form-control" value="{{ $analyserisques->DescriptionMA }}"></div>
            <div class="clearfix"></div>
        </div>


        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Evaluation MA</label>
            <div class="col-md-6"><input type="text" name="EvaluationMA" class="form-control" value="{{ $analyserisques->EvaluationMA }}"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Evaluation RR</label>
            <div class="col-md-6"><input type="text" name="EvaluationRR" class="form-control" value="{{ $analyserisques->EvaluationRR }}"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form--group">
            <input type="submit" class="btn btn-info" value="Valider">
        </div>
      </form>
    </div>

  </section>
@endsection