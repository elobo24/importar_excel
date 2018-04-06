<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

	<link rel="stylesheet" href="{{ asset('css/editablegrid/editablegrid.css') }}" type="text/css" media="screen">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/micss.css') }}">
</head>
<body>

	<section class="main row">

		<div class="container">
		<div>
		{{ Form::open (['url' => 'export', 'method' => 'POST', 'class' => 'form-horizontal']) }}

		{!! csrf_field() !!}
		<br><a href="{{ route('home') }}" class="btn btn-lg btn-primary btn-danger">Regresar</a>
		{{ Form::submit('Procesar', ['class' => 'btn btn-lg btn-primary pull-right', 'id' => 'request'])}}
		</div>

  <div class="row">
		<div class="col-md-12">
  		<div class="box box-primary">
    		<div class="box-body">
      		<div class="table-responsive">
        		<table id="Conciliadas-table" class="table table-striped">
          		<thead class="thead-default">
            	<tr>
									<th>#</th>
									<th>Albaran</th>
									<th>Destinatario</th>
									<th>Direccion</th>
									<th>Poblacion</th>
									<th>cp</th>
									<th>Provincias</th>
									<th>Tlf</th>
									<th>Observaciones</th>
									<th>Fecha</th>
            	</tr>
          	</thead>
          	@foreach($data as $datos)
            <tr>
							<td>{!! $i = $datos['id'] + 1 !!}</td>
							<td>
								<input type="text" size="10" id="{{ $datos['id'] }}" name="albaran[]" value="{{ $datos['albaran'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$datos['id']]['albaran'])) ? $errors[$datos['id']]['albaran'] : '' }}" class="{{ (isset($errors[$datos['id']]['albaran'])) ? 'form-control has-error' : '' }}">
							</td>

							<td>
								<input type="text" size="10"  name="destinatario[]" value="{!! $datos['destinatario'] !!}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$datos['id']]['destinatario'])) ? $errors[$datos['id']]['destinatario'] : '' }}" class="{{ (isset($errors[$datos['id']]['destinatario'])) ? 'form-control has-error' : '' }}">
							</td>

							<td>
								<input type="text" size="10"  name="direccion[]" value="{!! $datos['direccion'] !!}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$datos['id']]['direccion'])) ? $errors[$datos['id']]['direccion'] : '' }}" class="{{ (isset($errors[$datos['id']]['direccion'])) ? 'form-control has-error' : '' }}">
							</td>

							<td>
								<input type="text" size="10"  name="poblacion[]" value="{!! $datos['poblacion'] !!}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$datos['id']]['poblacion'])) ? $errors[$datos['id']]['poblacion'] : '' }}" class="{{ (isset($errors[$datos['id']]['poblacion'])) ? 'form-control has-error' : '' }}">
							</td>

							<td>
								<input type="text"  size="40" maxlength="40" name="cp[]" value="{!! $datos['cp'] !!}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$datos['id']]['cp'])) ? $errors[$datos['id']]['cp'] : '' }}" class="{{ (isset($errors[$datos['id']]['cp'])) ? 'form-control has-error' : '' }}">
							</td>

							<td>
								<input type="text" size="10" name="provincia[]" value="{!! $datos['provincia'] !!}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$datos['id']]['provincia'])) ? $errors[$datos['id']]['provincia'] : '' }}" class="{{ (isset($errors[$datos['id']]['provincia'])) ? 'form-control has-error' : '' }}">
							</td>

							<td>
								<input type="text" size="10" name="telefono[]" value="{!! $datos['telefono'] !!}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$datos['id']]['telefono'])) ? $errors[$datos['id']]['telefono'] : '' }}" class="{{ (isset($errors[$datos['id']]['telefono'])) ? 'form-control has-error' : '' }}">
							</td>

							<td>
								<input type="text" size="10" name="observaciones[]" value="{!! $datos['observaciones'] !!}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$datos['id']]['observaciones'])) ? $errors[$datos['id']]['observaciones'] : '' }}" class="{{ (isset($errors[$datos['id']]['observaciones'])) ? 'form-control has-error' : '' }}">
							</td>

							<td>
								<input type="text" size="10" name="fecha[]" value="{{ Date::parse($datos['fecha'])->format('d-m-Y h:m:s') }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$datos['id']]['fecha'])) ? $errors[$datos['id']]['fecha'] : '' }}" class="{{ (isset($errors[$datos['id']]['fecha'])) ? 'form-control has-error' : '' }}">
							</td>
						</tr>

						@endforeach
  				</table>
				</div><!--table-responsive-->
			</div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mijs.js') }} "></script>

</body>
@section('after-scripts-end')
@include('partials.dashboard.personas.scripts_personas')
@stop
</html>
