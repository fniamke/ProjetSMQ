@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Liste des tâches</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">tâches</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('taches.create')}}" class="btn btn-primary">Nouvelles tâches</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Processus</td>
                    <td>Plan d'actions</td>
                    <td>Type moyen</td>
                    <td>Demandeur</td>
					<td>Intervenant</td>
					<td>Tâches</td>
					<td>Date début</td>
					<td>Date fin</td>
                    <td>Etat</td>
					<td>Actions</td>
				</tr>
				
				@foreach($Taches as $C)
					<tr>
						<td>{{ $C->IdTaches }}</td>
                        <td>{{ $C->LibProcessus }}</td>
						<td>{{ $C->LibPlanaction }}</td>
						<td>{{ $C->LibTypeMoyen }}</td>
						<td>{{ $C->Demandeur }}</td>
						<td>{{ $C->Intervenant }}</td>
						<td>{{ $C->LibTaches }}</td>
						<td>{{ $C->DateDebut }}</td>
						<td>{{ $C->DateFin }}</td>
                        <td>@if($C->Etat==0) En cours @elseif ($C->Etat==1) Fait @endif</td>
						@if($C->Etat==0)
							<td>
								<a href="{{ route('taches.edit', $C->IdTaches . '¤' . 1)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 

								<a href="{{ route('taches.edit', $C->IdTaches . '¤' . 2)}}" class="btn btn-info" style="height:30px; width:90px">Traiter</a>

								<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
								<form action="{{ route('taches.destroy', $C->IdTaches) }}" method ="post">
									@method('DELETE')
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
							</td>
						@endif
					</tr>
				@endforeach
			
			</table>
		</div>
	</section>
@endsection