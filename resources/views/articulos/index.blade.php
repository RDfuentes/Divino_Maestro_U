@extends ('layouts.admin')
@section ('contenido')
<div class="row"> 
	<div class="col-xs-12">
	<a href="articulos/create"><button class="btn btn-success">Nuevo articulo</button></a>
	<h3 class="text-center"><strong>Listado de articulos</strong> </h3><br>
		@include('articulos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="" class="table table-striped table-bordered table-condensed table-hover" rules="groups" frame="hsides">
			<caption class="text-center">ARTICULOS</caption>

				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Fabrica</th>
					<th>Existencia</th>
					<th>Descripcion</th>
					<th>Opciones</th>
				</thead>
               @foreach ($articulos as $art)
				<tr>
					<td>{{ $art->id_articulo}}</td>
					<td>{{ $art->articulo}}</td>
					<td>{{ $art->fabricas}}</td>
					<td>{{ $art->existencia}}</td>
					<td>{{ $art->descripcion}}</td>

					<td>
						<a href="{{URL::action('ArticulosController@edit',$art->id_articulo)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$art->id_articulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('articulos.modal')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>
</div>

@endsection