@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ajout d'un sous processus</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Ajout d'un sous processus</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('sousprocessus.store')}}">
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

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Code sous processus</label>
            <div class="col-md-6"><input type="text" name="CodeSousProcessus" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Désignation du sous processus</label>
            <div class="col-md-6"><input type="text" name="LibSousProcessus" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Sous pilote</label>
            <div class="col-md-6">
              <select name="IdSousPilote" id="IdSousPilote" class="form-control">
                  <option disabled selected> </option>
                  @foreach($SousPilote as $c)
                      <option value="{{ $c->id }}">{{ $c->name }}</option>
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