@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sociétés</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Sociétés</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('societe.create')}}" class="btn btn-primary">Nouvelle société</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Société</td>
                    <td>Nom du contact</td>
                    <td>email</td>
                    <td>Téléphone</td>
                    <td>Fax</td>
                    <td>Statut</td>
					<td>Actions</td>
				</tr>
				
				@foreach($societe as $C)
					<tr>
						<td>{{ $C->IdSociete }}</td>
						<td>{{ $C->NomSociete }}</td>
                        <td>{{ $C->NomContact }}</td>
                        <td>{{ $C->email }}</td>
                        <td>{{ $C->Telephone }}</td>
                        <td>{{ $C->Fax }}</td>
                        <td>{{ $C->Statut }}</td>
                        
						<td>
							<a href="{{ route('societe.edit', $C->IdSociete)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 
							<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
							<form action="{{ route('societe.destroy', $C->IdSociete) }}" method ="post">
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