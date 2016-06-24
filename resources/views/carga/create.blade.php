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
					        	
					        	<a href="{{ URL::to('info/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
								<a href="{{ URL::to('info/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
								<a href="{{ URL::to('info/csv') }}"><button class="btn btn-success">Download CSV</button></a>
					        	
								
					        	
					        
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection