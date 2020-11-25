@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modification d'une société</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Modification d'une société</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('societe.update', $societe->IdSociete) }}">
        @method('PUT')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
          <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Societe') }}</label>

              <div class="col-md-6">
                  <input id="NomSociete" type="text" class="form-control @error('NomSociete') is-invalid @enderror" name="NomSociete" value="{{ $societe->NomSociete }}" required autocomplete="NomSociete" autofocus>

                  @error('NomSociete')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>
        </div>

        <div class="form-group">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom du contact') }}</label>
                <div class="col-md-6">
                    <input id="NomContact" type="text" class="form-control @error('NomContact') is-invalid @enderror" name="NomContact" value="{{ $societe->NomContact }}" required autocomplete="NomContact">
                    @error('NomContact')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
          
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Addresse mail') }}</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $societe->email }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
      
        <div class="form-group">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Telephone') }}</label>
                <div class="col-md-6">
                    <input id="Telephone" type="text" class="form-control @error('Telephone') is-invalid @enderror" name="Telephone" value="{{ $societe->Telephone }}" required autocomplete="Telephone">
                    @error('Telephone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Fax') }}</label>
                <div class="col-md-6">
                    <input id="Fax" type="text" class="form-control @error('Fax') is-invalid @enderror" name="Fax" value="{{ $societe->Fax }}" required autocomplete="Fax">
                    @error('Fax')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="form--group">
            <input type="submit" class="btn btn-info" value="Valider">
        </div>
        
      </form>
    </div>
  </section>
@endsection