@extends('layouts.default')
@section('content')
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Création d'un utilidsateur</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Création d'un utilidsateur</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <section class="content">
    <div class="container-fluid">
      <form method="post" action="{{ route('Auth.store') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
       
        <div class="form-group">
            <div class="row">
                <label class="col-md-4 col-form-label text-md-right">Société</label>
                <div class="col-md-6">           
                    <select name="IdSociete" id="IdSociete" class="form-control" required autocomplete="IdSociete" autofocus>
                        <option disabled selected> </option>
                        @foreach($societe as $c)
                            <option value="{{ $c->IdSociete }}">{{ $c->NomSociete }}</option>
                        @endforeach
                    </select>             
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        
        <div class="form-group">
          <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

              <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Addresse mail') }}</label>

              <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

              <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
          </div>

        </div>

        <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right">Fonctions</label>
            <div class="col-md-6">
              <select name="Id" id="Id" class="form-control">
                  <option disabled selected> </option>
                  @foreach($fonctions as $c)
                      <option value="{{ $c->id }}">{{ $c->LibFonction }}</option>
                  @endforeach
              </select>
            </div>
          </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pilote" id="pilote" value="1" >
                    <label for="pilote" class="form-check-label">{{ __('Pilote ') }}</label>
                    @error('pilote')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="SousPilote" id="SousPilote" value="1">
                    <label for="SousPilote" class="form-check-label">{{ __('Sous pilote ') }}</label>
                    @error('Sous pilote')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                  
                </div>
            </div>

            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="Auditeur" id="Auditeur" value="1">
                    <label for="Auditeur" class="form-check-label">{{ __('Auditeur ') }}</label>
                    @error('auditeur')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                  
                </div>
            </div>
            
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Enregistrer') }}
                </button>
            </div>
        </div>
      </form>
    </div>
  </section>
@endsection