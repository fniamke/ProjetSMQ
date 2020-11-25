@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Liste des processus de la société {{ $societe->NomSociete }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Processus</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('processus.create')}}" class="btn btn-primary">Nouveau processus</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Type processus</td>
					<td>Processus</td>
					<td>Finalité (champ d'application)</td>
					<td>Pilote</td>
					<td>Fonction</td>
					<td>Actions</td>
				</tr>
				<!--var_dump($Categorieslois)
					
				-->
				
						
			
				@foreach($Processus as $C)
					<tr>
						<td>{{ $C->id }}</td>
						<td>{{ $C->LibTypesProcessus }}</td>
						<td>{{ $C->LibProcessus }}</td>
						<td>{{ $C->ChampApplication }}</td>
						<td>{{ $C->name }}</td>
						<td>{{ $C->LibFonction }}</td>
						
						<td>
							<a href="{{ route('processus.edit', $C->id)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 
							<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
							<form action="{{ route('processus.destroy', $C->id) }}" method ="post">
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