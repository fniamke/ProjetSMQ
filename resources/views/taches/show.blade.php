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
                    <h2 class="m-0 text-dark">Liste des tâches</h2>
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
			<table class="table table-striped table-sm">
				<tr>
                    <td>Id</td>
					<td>Plan d'actions</td>
                    <td>Type moyen</td>
					<td>Intervenant</td>
					<td>Tâches</td>
					<td>Date début</td>
					<td>Date fin</td>
                    <td>Etat</td>
				</tr>
				
				@foreach($Listetaches as $C)
					<tr>
						<td>{{ $C->IdTaches }}</td>
                        <td>{{ $C->LibPlanaction }}</td>
						<td>{{ $C->LibTypeMoyen }}</td>
						<td>{{ $C->name }}</td>
                        <td>{{ $C->LibTaches }}</td>
						<td>{{ $C->DateDebut }}</td>
						<td>{{ $C->DateFin }}</td>
                        <td>@if($C->Etat==0) En cours @elseif ($C->Etat==1) Fait @endif</td>
					</tr>
				@endforeach
			
			</table>
		</div>
	</section>
@endsection