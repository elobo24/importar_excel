<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="{{ asset('js/editablegrid/editablegrid.js') }}"></script>
	<script src="{{ asset('js/editablegrid/editablegrid_renderers.js') }}" ></script>
	<script src="{{ asset('js/editablegrid/editablegrid_editors.js') }}" ></script>
	<script src="{{ asset('js/editablegrid/editablegrid_validators.js') }}" ></script>
	<script src="{{ asset('js/editablegrid/editablegrid_utils.js') }}" ></script>
	<script src="{{ asset('js/editablegrid/editablegrid_charts.js') }}" ></script>
	<link rel="stylesheet" href="{{ asset('css/editablegrid/editablegrid.css') }}" type="text/css" media="screen">
</head>
<body>
	<div class="container-fluid">
		<section class="main row">
			<article class="col-sm-6 col-md-10">
				<div class="box box-info">
					{{ Form::open (['url' => 'import-excel', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) }}
						@include('registro.partials.form')
		     	{{ Form::close() }}
				</div>
				@include('registro.partials.info')
			</article>
		</section>
		<div class="row">
			<div class="container">
				<table class="table table-hover">
					<div id="tablecontent"></div>
				</table>
			</div>

			</div>
	</div>
	<script type="text/javascript" src="{{ asset('js/tableEdit.js') }}"></script>	<!-- tabla editable-->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/function.js') }}"></script> 	<!-- mi ajax -->

</body>
</html>
