@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ajout d'une tâche</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Ajout d'une tâche</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('taches.store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Demandeur</label>
            <div class="col-md-6">           
              <select name="IdDemandeur" id="IdDemandeur" class="form-control">
                  <option disabled selected> </option>
                  @foreach($Intervenant as $c)
                      <option value="{{ $c->id }}">{{ $c->name }}</option>
                  @endforeach
              </select>
              
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Intervenant</label>
            <div class="col-md-6">           
              <select name="IdIntervenant" id="IdIntervenant" class="form-control">
                  <option disabled selected> </option>
                  @foreach($Intervenant as $c)
                      <option value="{{ $c->id }}">{{ $c->name }}</option>
                  @endforeach
              </select>
              
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Plan d'action</label>
            <div class="col-md-6">           
              <select name="IdPlanaction" id="IdIdPlanaction" class="form-control">
                  <option disabled selected> </option>
                  @foreach($PlanActions as $c)
                      <option value="{{ $c->IdPlanaction }}">{{ $c->LibPlanaction }}</option>
                  @endforeach
              </select>
              
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Type moyen</label>
            <div class="col-md-6">           
              <select name="IdTypeMoyen" id="IdTypeMoyen" class="form-control">
                  <option disabled selected> </option>
                  @foreach($TypeMoyen as $c)
                      <option value="{{ $c->IdTypeMoyen }}">{{ $c->LibTypeMoyen }}</option>
                  @endforeach
              </select>
              
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Tâches</label>
            <div class="col-md-6"><input type="text" name="LibTaches" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right" >Date début</label>
            <div class="col-md-6"><input type="date" name="DateDebut" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right" >Date fin</label>
            <div class="col-md-6"><input type="date" name="DateFin" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form--group">
            <input type="submit" class="btn btn-info" value="Valider">
        </div>
      </form>
    </div>
  </section>
@endsection