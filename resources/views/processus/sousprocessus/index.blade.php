@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Liste des sous processus de la société</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Sous processus</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('sousprocessus.create')}}" class="btn btn-primary">Nouveau processus</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Processus</td>
					<td>Code Sous processus</td>
					<td>Désignation du sous processus</td>
					<td>Sous pilote</td>
					<td>Actions</td>
				</tr>
				
				@foreach($SousProcessus as $C)
					<tr>
						<td>{{ $C->IdSousProcessus }}</td>
						<td>{{ $C->LibProcessus }}</td>
						<td>{{ $C->CodeSousProcessus }}</td>
						<td>{{ $C->LibSousProcessus }}</td>
						<td>{{ $C->name }}</td>
						<td>
							<a href="{{ route('sousprocessus.edit', $C->IdSousProcessus)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 
							<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
							<form action="{{ route('sousprocessus.destroy', $C->IdSousProcessus) }}" method ="post">
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