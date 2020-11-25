@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Texte (lois, convention, norme)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Textes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('lois.create')}}" class="btn btn-primary">Nouveau texte</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Catégories</td>
					<td>Texte (lois, convention, norme)</td>
					<td>Date de promulgation</td>
					<td>Actions</td>
				</tr>
				<!--var_dump($Categorieslois)-->
				
				@foreach($Lois as $C)
					<tr>
						<td>{{ $C->id }}</td>
						<td>{{ $C->categorieslois }}</td>
						<td>{{ $C->LibLois }}</td>
						<td>{{ $C->DatePromulgation }}</td>
						<td>
							<a href="{{ route('lois.edit', $C->id)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 
							<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
							<form action="{{ route('lois.destroy', $C->id) }}" method ="post">
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