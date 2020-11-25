@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Liste des probabilités</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Probabilité</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('probabilite.create')}}" class="btn btn-primary">Nouvelle probabilité</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Définition</td>
					<td>Probabilité</td>
                    <td>Note</td>
					<td>Actions</td>
				</tr>
				
				@foreach($probabilite as $C)
					<tr>
						<td>{{ $C->IdProbabilite }}</td>
						<td>{{ $C->DefinitionProbabilite }}</td>
						<td>{{ $C->Probabilite }}</td>
                        <td>{{ $C->NoteProbabilite }}</td>
						<td>
							<a href="{{ route('probabilite.edit', $C->IdProbabilite)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 
							<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
							<form action="{{ route('probabilite.destroy', $C->IdProbabilite) }}" method ="post">
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