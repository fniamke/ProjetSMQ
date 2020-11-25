@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Liste des indicateurs</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Indicateurs</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">

			<p>
				<a href="{{ route('indicateurs.create')}}" class="btn btn-primary">Nouveau indicateur</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Processus / Sous processus</td>
					<td>Indicateur</td>
					<td>Pér.</td>
					<td>Debut période</td>
					<td>Fin période</td>
					<td>Objectif</td>
					<td>Résultat</td>
					<td>Etat</td>
					<td>Observation</td>
					<td>N° lig</td>
					<td>Actions</td>
				</tr>
				
				@foreach($Indicateurs as $C)
					<tr>
						
						<td>{{ $C->IdIndicateur }}</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp {{ $C->LibProcessus }}</td>
						<td>{{ $C->LibIndicateur }}</td>
						<td>{{ $C->Periodicite }}</td>
						<td>{{ $C->DebutPeriode }}</td>
						<td>{{ $C->FinPeriode }}</td>
						<td>{{ $C->Objectif }} %</td>

						<td>{{ $C->Resultat }} %</td>
						<td>@if($C->Etat==0) Non fait @elseif ($C->Etat==1) Fait @endif</td>
						<td>{{ $C->Observation }}</td>
						<td>{{ $C->NumLigne }}</td>
						@if($C->Etat==0)
							<td>
								<a href="{{ route('indicateurs.edit', $C->id . '¤' . 1)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 
								
								<a href="{{ route('indicateurs.edit', $C->id . '¤' . 2)}}" class="btn btn-info" style="height:30px; width:90px">Traiter</a> 

								<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
								<form action="{{ route('indicateurs.destroy', $C->id) }}" method ="post">
									@method('DELETE')
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
							</td>
						@else
							<td>
								<a href="{{ route('indicateurs.edit', $C->id . '¤' . 3)}}" class="btn btn-info" style="height:30px; width:90px">Historique</a> 
							</td>
						@endif
					</tr>
				@endforeach
			
			</table>
		</div>
	</section>
@endsection