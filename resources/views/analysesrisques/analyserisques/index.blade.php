@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Liste des risques de la société</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Risques</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('analyserisques.create')}}" class="btn btn-primary">Nouveau risque</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Risque / Opportunités</td>
					<td>Nature</td>
					<td>Effets</td>
					<td>Causes</td>
					<td>Gravité</td>
					<td>Probabilité</td>
					<td>Détection</td>
					<td>Criticité</td>
					<td>Description de la maîtrise actuelle (MA)</td>
					<td>Evaluation MA</td>
					<td>Evaluation Risque Résiduel</td>

					<td>Date révision</td>
					<td>Actions</td>
				</tr>
				
				@foreach($analyserisques as $C)
					<tr>
						<td>{{ $C->IdAnalyserisques }}</td>
						<td>{{ $C->LibRisqueOpportunite }}</td>
						<td>{{ $C->Nature }}</td>
						<td>{{ $C->Effets }}</td>
						<td>{{ $C->Causes }}</td>
						<td>{{ $C->NoteGravite }}</td>
						<td>{{ $C->NoteProbabilite }}</td>
						<td>{{ $C->NoteDetection }}</td>
						<td>{{ $C->NoteCriticite }}</td>
						<td>{{ $C->DescriptionMA }}</td>
						<td>{{ $C->EvaluationMA }}</td>
						<td>{{ $C->EvaluationRR }}</td>

						<td>{{ $C->DateRevision }}</td>

						<td>
							<a href="{{ route('analyserisques.edit', $C->IdAnalyserisques)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 
							<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
							<form action="{{ route('analyserisques.destroy', $C->IdAnalyserisques) }}" method ="post">
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