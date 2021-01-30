@extends ('layouts.admin')
@section ('contenido')
<div class="row"> 
	<div class="col-xs-12">
	<a href="envios/create"><button class="btn btn-success">Nuevo lugar de envio</button></a>
	<h3 class="text-center"><strong>Lugares de envios</strong> </h3><br>
		@include('envios.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table id="" class="table table-striped table-bordered table-condensed table-hover" rules="groups" frame="hsides">
			<caption class="text-center">LUGARES DE ENVIOS</caption>

				<thead>
					<th>Id</th>
					<th>Lugar</th>
					<th>Calle</th>
					<th>Comuna</th>
					<th>Ciudad</th>
					<th>Opciones</th>
				</thead>
               @foreach ($envios as $env)
				<tr>
					<td>{{ $env->id_envio}}</td>
					<td>{{ $env->lugar_envio}}</td>
					<td>{{ $env->calle}}</td>
					<td>{{ $env->comuna}}</td>
					<td>{{ $env->ciudad}}</td>

					<td>
						<a href="{{URL::action('EnviosController@edit',$env->id_envio)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$env->id_envio}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('envios.modal')
				@endforeach
			</table>
		</div>
		{{$envios->render()}}
	</div>
</div>

@endsection