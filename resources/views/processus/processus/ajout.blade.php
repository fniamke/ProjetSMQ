@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ajout d'un processus</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Ajout d'un processus</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">

    <div class="container-fluid">
      <form method="post" action="{{ route('processus.store')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="row">
            <label class="col-md-3 col-form-label text-md-right">Type processus</label>
            <div class="col-md-6">           
              <select name="Id" id="Id" class="form-control">
                  <option disabled selected> </option>
                  @foreach($Typesprocessus as $c)
                      <option value="{{ $c->id }}">{{ $c->LibTypesProcessus }}</option>
                  @endforeach
              </select>
              
            </div>
            <div class="clearfix"></div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Processus</label>
            <div class="col-md-6"><input type="text" name="LibProcessus" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
            <label class="col-md-3 col-form-label text-md-right">Finalité (champ d'application)</label>
            <div class="col-md-6"><input type="text" name="ChampApplication" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Pilote</label>
          <div class="col-md-6">
            <select name="IdPilote" id="IdPilote" class="form-control">
                <option disabled selected> </option>
                @foreach($Pilote as $c)
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.0/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </section>
@endsection