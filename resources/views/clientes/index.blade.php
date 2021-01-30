<!-- ENTER EL CODIGO -->

@extends ('layouts.admin')
@section ('contenido')
<div class="row"> 
	<div class="col-xs-12">
	<a href="clientes/create"><button class="btn btn-success">Nuevo Cliente</button></a>
	<h3 class="text-center"><strong>Listado de Clientes</strong> </h3><br>
		@include('clientes.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="" class="table table-striped table-bordered table-condensed table-hover" rules="groups" frame="hsides">
			<caption class="text-center">LISTADO DE CLIENTES</caption>

				<thead>
					<th>Id</th>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Direccion</th>
					<th>Saldo</th> 
					<th>Credito</th> 
					<th>Descuento</th> 
					<th>Opciones</th>
				</thead>
               @foreach ($clientes as $cli)
				<tr>
					<td>{{ $cli->id_cliente}}</td>
					<td>{{ $cli->codigo_unico}}</td>
					<td>{{ $cli->nombre}}</td>
					<td>{{ $cli->apellido}}</td>
					<td>{{ $cli->envios}}</td> <!-- aca se escribe o se llama a la variable creada en el iner joi "tabla heredada" -->
					<td>{{ $cli->saldo}}</td>
					<td>{{ $cli->credito}}</td>
					<td>{{ $cli->descuento}}</td>

					<td>
						<a href="{{URL::action('ClientesController@edit',$cli->id_cliente)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$cli->id_cliente}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('clientes.modal')
				@endforeach
			</table>
		</div>
		{{$clientes->render()}}
	</div>
</div>

@endsection