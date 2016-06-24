@extends('principal')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Mundo de Plata</div>
 
				<div class="panel-body">
					<div role="tabpanel">
					    <ul class="nav nav-tabs" id="menu">
					        <li role="presentation" class="active uno" >
					            <a href="#home" id="uno" aria-controls="home" role="tab" data-toggle="tab">Participantes</a>
					        </li>
					        <li role="presentation" class="dos">
					            <a href="#profile" id="dos" aria-controls="profile" role="tab" data-toggle="tab">Variables</a>
					        </li>
					        <li role="presentation" class="tres" >
					            <a href="#messages" id="tres" aria-controls="messages" role="tab" data-toggle="tab">Descargue Liequidación</a>
					        </li>
					    </ul>

					    <!-- Tab panes -->
					    <div class="tab-content"> 
					        <div role="tabpanel" class="tab-pane active uno" id="home">
								
					        	{!! Form::open(array('url' => 'info', 'method' => 'POST', 'files' => true, 'accept-charset'=>'UTF-8', 'enctype' => 'multipart/form-data')) !!}
					        	{!! Form::label('email', 'Selecione Archivo', ['class' => 'control-label']) !!}
					            <input type="hidden" name="tipo" value="1">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input id="fileuser" type="file" class="file-loading" name="file">
								{!! Form::submit('Cargar') !!}
								{!! Form::close() !!}
								
					        </div>
					        <div role="tabpanel" class="tab-pane dos" id="profile">
					        	{!! Form::open(array('url' => 'info', 'method' => 'POST', 'files' => true, 'accept-charset'=>'UTF-8', 'enctype' => 'multipart/form-data')) !!}
					        	{!! Form::label('email', 'Selecione Archivo', ['class' => 'control-label']) !!}
					            <input type="hidden" name="tipo" value="2">
					            <input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input id="fileuser" type="file" class="file-loading" name="file">
								{!! Form::submit('Cargar') !!}
								{!! Form::close() !!}
					        </div>
					        <div role="tabpanel" class="tab-pane tres" id="messages">
					        	<br />
					        	{!! Form::open(array('url' => 'info/create', 'method' => 'GET')) !!}
								{!! Form::submit('Descargar') !!}
								{!! Form::close() !!}
					        	
					        
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Import - Export in Excel and CSV Laravel 5</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<a href="{{ URL::to('info/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
		<a href="{{ URL::to('info/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
		<a href="{{ URL::to('info/csv') }}"><button class="btn btn-success">Download CSV</button></a>
		<form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
			<input type="file" name="import_file" />
			<button class="btn btn-primary">Import File</button>
		</form>
	</div>
@endsection