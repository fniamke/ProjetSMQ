@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Liste des parties intéressées de la société</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Parties intéressées</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('partiesinteressees.create')}}" class="btn btn-primary">Nouvelle partie intéressée</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Parties intéressées</td>
					<td>Contexte</td>
					<td>Niveau d'importance</td>
					<td>Attentes</td>
					<td>Niveau de relation</td>
					<td>Risques</td>
					<td>Opportunités</td>
					<td>Pertinence</td>
					<td>Date révision</td>
					<td>Actions</td>
				</tr>
				
				@foreach($partiesinteressees as $C)
					<tr>
						<td>{{ $C->IdPartiesInt }}</td>
						<td>{{ $C->LibPartiesInt }}</td>
						<td>{{ $C->Contexte }}</td>
						<td>{{ $C->ValeurNivImportance }}</td>
						<td>{{ $C->Attentes }}</td>
						<td>{{ $C->ValeurNivRelation }}</td>
						<td>{{ $C->Risques }}</td>
						<td>{{ $C->Opportunites }}</td>
						<td>{{ $C->ValeurNivImportance * $C->ValeurNivRelation }}</td>
						<td>{{ $C->DateRevision }}</td>

						<td>
							<a href="{{ route('partiesinteressees.edit', $C->IdPartiesInt)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 
							<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
							<form action="{{ route('partiesinteressees.destroy', $C->IdPartiesInt) }}" method ="post">
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