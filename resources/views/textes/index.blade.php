@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Catégories de textes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Catégories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('categorieslois.create')}}" class="btn btn-primary">Nouvelle catégorie</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Catégories</td>
					<td>Actions</td>
				</tr>
				<!--var_dump($Categorieslois)-->
				
				@foreach($Categorieslois as $C)
					<tr>
						<td>{{ $C->id }}</td>
						<td>{{ $C->categorieslois }}</td>
						<td>
							<a href="{{ route('categorieslois.edit', $C->id)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 
							<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
							<form action="{{ route('categorieslois.destroy', $C->id) }}" method ="post">
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