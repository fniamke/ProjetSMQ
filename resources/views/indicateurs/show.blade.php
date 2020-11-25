@extends('layouts.default')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    Processus : {{ $processus->LibProcessus }} - {{ $processus->ChampApplication }}
                </div>
            </div>
            <div class="row mb-2">  

                <div class="col-sm-6">
                    Pilote         : {{ $pilote->name }}
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2 class="m-0 text-dark">Liste des indicateurs</h2>
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
			<table class="table table-striped table-sm">
				<tr>
					<td>Indicateur</td>
					<td>Pér.</td>
					<td>Debut période</td>
					<td>Fin période</td>
					<td>Objectif</td>
					<td>Résultat</td>
					<td>Etat</td>
					<td>Observation</td>
				</tr>
				
				@foreach($ListeIndicateursProcessus as $C)
					<tr>
						<td>{{ $C->LibIndicateur }}</td>
						<td>{{ $C->Periodicite }}</td>
						<td>{{ $C->DebutPeriode }}</td>
						<td>{{ $C->FinPeriode }}</td>
						<td>{{ $C->Objectif }} %</td>

						<td>{{ $C->Resultat }} %</td>
						<td>@if($C->Etat==0) Non fait @elseif ($C->Etat==1) Fait @endif</td>
						<td>{{ $C->Observation }}</td>
					</tr>
				@endforeach
			
			</table>
		</div>
	</section>
@endsection