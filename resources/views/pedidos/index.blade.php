@extends ('layouts.admin')
@section ('contenido')
<div class="row"> 
	<div class="col-xs-12">
	<a href="pedidos/create"><button class="btn btn-success">Nuevo Pedido</button></a>
	<h3 class="text-center"><strong>Pedidos</strong> </h3><br>
		@include('pedidos.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="" class="table table-striped table-bordered table-condensed table-hover" rules="groups" frame="hsides">
			<caption class="text-center">PEDIDOS REALIZADOS</caption>

				<thead>
					<th>Id</th>
					<th>Cliente</th>
					<th>Direccion de Envio</th>
					<th>Fecha</th>
					<th>Articulo</th>
					<th>Descripcion</th>
					<th>Cantidad</th>
					<th>Opciones</th>
				</thead>
               @foreach ($pedidos as $ped)
				<tr>
					<td>{{ $ped->id_pedido}}</td>
					<td>{{ $ped->clientes." ".$ped->clientess}}</td>
					<td>{{ $ped->envios}}</td>
					<td>{{ $ped->fecha}}</td>
					<td>{{ $ped->articulos}}</td>
					<td>{{ $ped->descripcion}}</td>
					<td>{{ $ped->cantidad}}</td>

					<td>
						<a href="{{URL::action('PedidosController@edit',$ped->id_pedido)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$ped->id_pedido}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('pedidos.modal')
				@endforeach
			</table>
		</div>
		{{$pedidos->render()}}
	</div>
</div>

@endsection