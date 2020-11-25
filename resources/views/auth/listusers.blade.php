@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Liste des utilisateurs de la société {{ $societe->NomSociete }} </h1>
			
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Utilisateurs</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('Auth.create')}}" class="btn btn-primary">Nouveau utilisateur</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Nom utilisateur</td>
					<td>E-mail</td>
					<td>Rôle</td>
					<td>Fonction</td>
					<td>Pilote</td>
					<td>Sous pilote</td>
					<td>Auditeur</td>
					<td>Actions</td>
				</tr>
				
				@foreach($ListUsers as $C)
					<tr>
						<td>{{ $C->id }}</td>
						<td>{{ $C->name }}</td>
						<td>{{ $C->email }}</td>
						<td></td>
						<td>{{ $C->LibFonction }}</td>
						<td>{{ ($C->pilote==1 ? 'Oui' : '') }}</td>
						<td>{{ ($C->SousPilote==1 ? 'Oui' : '') }}</td>
						<td>{{ ($C->Auditeur==1 ? 'Oui' : '') }}</td>
						
						<td>

							<a href="{{ route('Auth.edit', $C->id)}}" class="btn btn-info" style="height:30px">Modifier</a> 
							<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px">Supprimer</a>
							<form action="{{ route('Auth.destroy', $C->id) }}" method ="post">
								@method('DELETE')
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</form>

						</td>
					</tr>
				@endforeach
			
			</table>
		</div>
	</section>
@endsection