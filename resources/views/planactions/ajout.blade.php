@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ajout d'un plan d'action</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Ajout d'un plan d'action</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('planactions.store')}}">
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
          <label class="col-md-3 col-form-label text-md-right">Code PA</label>
            <div class="col-md-6"><input type="text" name="CodePlanaction" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form-group row">
          <label class="col-md-3 col-form-label text-md-right">Plan d'action</label>
            <div class="col-md-6"><input type="text" name="LibPlanaction" class="form-control"></div>
            <div class="clearfix"></div>
        </div>

        <div class="form--group">
            <input type="submit" class="btn btn-info" value="Valider">
        </div>
      </form>
    </div>
  </section>
@endsection