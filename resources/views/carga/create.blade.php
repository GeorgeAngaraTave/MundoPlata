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
								<label class="control-label">Selecione Archivo</label>
								<input id="fileuser" type="file" class="file-loading">
					        </div>
					        <div role="tabpanel" class="tab-pane dos" id="profile">
					        	<label class="control-label">Selecione Archivo</label>
								<input id="filevar" type="file" class="file-loading">
					        </div>
					        <div role="tabpanel" class="tab-pane tres" id="messages">Tres</div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection