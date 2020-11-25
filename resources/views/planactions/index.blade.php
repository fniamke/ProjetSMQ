@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Liste des plans d'actions</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">PA</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<p>
				<a href="{{ route('planactions.create')}}" class="btn btn-primary">Nouveau Plan d'action</a>
			</p>
			<table class="table table-striped table-sm">
				<tr>
					<td>Processus</td>
                    <td>Code PA</td>
					<td>Plan d'action</td>
					<td>Pilote</td>
                    <td>Actions</td>
				</tr>
				
				@foreach($planactions as $C)
					<tr>
						<td>{{ $C->LibProcessus }}</td>
						<td>{{ $C->CodePlanaction }}</td>
						<td>{{ $C->LibPlanaction }}</td>
						<td>{{ $C->name }}</td>
                        
						<td>
							<a href="{{ route('planactions.edit', $C->IdPlanaction)}}" class="btn btn-info" style="height:30px; width:90px">Modifier</a> 
							<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger" style="height:30px; width:90px">Supprimer</a>
							<form action="{{ route('planactions.destroy', $C->IdPlanaction) }}" method ="post">
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