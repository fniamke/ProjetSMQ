@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tableau de bord des indicateurs par processus</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Indicateurs/Processus</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<table class="table table-striped table-sm">
				<tr>
					<td>Code processus</td>
					<td>Pilote</td>
                    <td>Libellé</td>
					<td>Nbre d'indicateurs</td>
					
					<td>Nbre de plans d'action</td>
					<td>Nbre de tâches</td>
					<td>Actions</td>
				</tr>
				<!--var_dump($Categorieslois)-->
				
				@foreach($listeprocessus as $C)
					<tr>
						<td>{{ $C->LibProcessus }}</td>
						<td>{{ $C->name }}</td>
						<td>{{ $C->ChampApplication }}</td>
						<td><a href="{{ route('indicateurs.show', $C->id) }}"> @if($C->NbreIndicateurs>0) {{ $C->NbreIndicateurs}} @endif </td>
						<td><a href="{{ route('planactions.show', $C->id) }}"> @if($C->NbrePA>0) {{ $C->NbrePA }} @endif </td>
						<td><a href="{{ route('taches.show', $C->id) }}"> @if($C->NbreTaches>0) {{ $C->NbreTaches }} @endif </td>
						<td>
							<a href="{{ route('indicateursparprocessus.show', $C->id . '¤' . 1)}}" class="btn btn-info" style="height:30px; width:90px">Cartographie</a> 
						</td>
					</tr>
				@endforeach
				
			</table>
		</div>
	</section>
@endsection