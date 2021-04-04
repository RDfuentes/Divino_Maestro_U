@extends ('layouts.admin')
@section ('contenido')
<div class="row"> 
	<div class="col-xs-12">
	<h3 class="text-center"><strong>Biracora Articulos</strong> </h3><br>
		@include('bitacoras.search')
	</div>
</div>

<center>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="" class="table table-striped table-bordered table-condensed table-hover" rules="groups" frame="hsides">
			<caption class="text-center">BITACORA ARTICULOS</caption>

				<thead>
					<th>ID</th>
					<th>Identificador articulo</th>
					<th>Fecha</th>
					<th>Ejecutor</th>
					<th>Actividad realizada</th>
					<th>Informacion actual</th>
					<th>Informacion anterior</th>
					<th>Opciones</th>
				</thead>
               @foreach ($bitacoras as $bit)
				<tr>
					<td>{{ $bit->id_bitacora}}</td>
					<td>{{ $bit->id_articulo}}</td>
					<td>{{ $bit->fecha}}</td>
					<td>{{ $bit->ejecutor}}</td>
					<td>{{ $bit->actividad_realizada}}</td>
					<td>{{ $bit->informacion_actual}}</td>
					<td>{{ $bit->informacion_anterior}}</td>

					<td>
						<a href="{{URL::action('BitacoraController@edit',$bit->id_bitacora)}}"><button class="btn btn-info">VER</button></a>
					</td>
				</tr>
				@endforeach
			</table>
			<!-- ESTE BOTON TIENE QUE LLAMAR A LA FUNCION cargarPdf -->
			<a href="{{URL::action('BitacoraController@ListarPDF')}}"><button class="btn btn-info">IMPRIMIR</button></a>
		</div>
		{{$bitacoras->render()}}
	</div>
</div>

<script>

	function cargarPdf()
	{
		window.open('http://127.0.0.1:8000/bitacoras/ListarPdf','_blank');
	}
}
</script>
</center>

@endsection