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
                    <h2 class="m-0 text-dark">Liste des plans d'action</h2>
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
			<table class="table table-striped table-sm">
				<tr>
                    <td>Code PA</td>
					<td>Plan d'action</td>
					<td>Pilote</td>
				</tr>
				
				@foreach($Listeplanactions as $C)
					<tr>
						<td>{{ $C->CodePlanaction }}</td>
						<td>{{ $C->LibPlanaction }}</td>
						<td>{{ $C->name }}</td>
					</tr>
				@endforeach
			
			</table>
		</div>
	</section>
@endsection