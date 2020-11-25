@extends('layouts.default')
@section('content')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Liste des messages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home')}}">Menu</a></li>
              <li class="breadcrumb-item active">Messages</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<section class="content">
		<div class="container-fluid">
			<table class="table table-striped table-sm">
				<tr>
					<td>Id</td>
					<td>Expéditeur</td>
                    <td>Email</td>
                    <td>Destinataire</td>
                    <td>Email</td>
                    <td>Message</td>
					<td>Actions</td>
				</tr>
				
				@foreach($messages as $C)
					<tr>
						<td>{{ $C->id }}</td>
						<td>{{ $C->Expediteur }}</td>
                        <td>{{ $C->emailExpediteur }}</td>
                        <td>{{ $C->Destinataire }}</td>
                        <td>{{ $C->emailDestinataire }}</td>
                        <td>{{ $C->message }}</td>
						<td>
							<a href="{{ route('messages.create', $C->id)}}" class="btn btn-info" style="height:30px; width:90px">Envoyer</a> 
						</td>
					</tr>
				@endforeach
			
			</table>
		</div>
	</section>
@endsection