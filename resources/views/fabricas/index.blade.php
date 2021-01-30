@extends ('layouts.admin')
@section ('contenido')
<div class="row"> 
	<div class="col-xs-12">
	<a href="fabricas/create"><button class="btn btn-success">Nuevo fabrica</button></a>
	<h3 class="text-center"><strong>Fabricas</strong> </h3><br>
		@include('fabricas.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="" class="table table-striped table-bordered table-condensed table-hover" rules="groups" frame="hsides">
			<caption class="text-center">LISTADO DE FABRICAS</caption>

				<thead>
					<th>Id</th>
					<th>Nombre de la fabrica</th>
					<th>Telefono</th>
					<th>Opciones</th>
				</thead>
               @foreach ($fabricas as $fab)
				<tr>
					<td>{{ $fab->id_fabrica}}</td>
					<td>{{ $fab->nombre}}</td>
					<td>{{ $fab->telefono}}</td>

					<td>
						<a href="{{URL::action('FabricasController@edit',$fab->id_fabrica)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$fab->id_fabrica}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('fabricas.modal')
				@endforeach
			</table>
		</div>
		{{$fabricas->render()}}
	</div>
</div>

@endsection