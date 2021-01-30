@extends ('layouts.admin')
@section ('contenido')

    <!-- ----------------------------------------------  CONTENIDO DE CADA MODULO ---------------------------------------->

    <script>
      function soloLetras(e)
        {
           key = e.keyCode || e.which;
           tecla = String.fromCharCode(key).toLowerCase();
           letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
           especiales = "8-37-39-46";

           tecla_especial = false
           for(var i in especiales){
                if(key == especiales[i]){
                    tecla_especial = true;
                    break;
                }
            }

            if(letras.indexOf(tecla)==-1 && !tecla_especial){
                return false;
            }
        }
    </script>

    <!-- ----------------------------------------------  FIN DE LA VALIDACION  ---------------------------------------- -->
	
	<div class="row">
		<div class="col-xs-12">
			<h3 class="text-center"><strong>Editar pedido:</strong> {{ $pedidos->id_pedido}}</h3><br>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

			{!!Form::model($pedidos,['method'=>'PATCH','route'=>['pedidos.update',$pedidos->id_pedido]])!!}
            {{Form::token()}}
			<div class="row">

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
					<label for="">Cliente</label>
						<select name="id_cliente" id="" class="form-control">
							@foreach ($clientes as $cli)
								@if($cli->id_cliente==$pedidos->id_cliente)
								<option value="{{$cli->id_cliente}}" selected>{{$cli->nombre." ".$cli->apellido}}</option>
								@else
								<option value="{{$cli->id_cliente}}">{{$cli->nombre." ".$cli->apellido}}</option>
								@endif 	
							@endforeach
						</select>
					</div>
				</div>

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
					<label for="">Direccion de envio</label>
						<select name="id_envio" id="" class="form-control">
							@foreach ($envios as $env)
								@if($env->id_envio==$pedidos->id_envio)
								<option value="{{$env->id_envio}}" selected>{{$env->lugar_envio}}</option>
								@else
								<option value="{{$env->id_envio}}">{{$env->lugar_envio}}</option>
								@endif 	
							@endforeach
						</select>
					</div>
				</div>

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="fecha">Fecha</label>
						<input type="datetime-local" name="fecha" value="{{$pedidos->fecha}}" class="form-control" placeholder="Fecha">
					</div>
				</div>

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
					<label for="">Articulo</label>
						<select name="id_articulo" id="" class="form-control">
							@foreach ($articulos as $art)
								@if($art->id_articulo==$pedidos->id_articulo)
								<option value="{{$art->id_articulo}}" selected>{{$art->articulo}}</option>
								@else
								<option value="{{$art->id_articulo}}">{{$art->articulo}}</option>
								@endif 	
							@endforeach
						</select>
					</div>
				</div>

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="descripcion">Descripcion</label>
						<input type="text" name="descripcion" value="{{$pedidos->descripcion}}"onkeypress="return soloLetras(event)"  class="form-control" placeholder="Descripcion del pedido">
					</div>
				</div>

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="cantidad">Cantidad</label>
						<input type="number" name="cantidad" value="{{$pedidos->cantidad}}" class="form-control" placeholder="Cantidad del pedido">
					</div>
				</div>

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Guardar</button>
						<a class="btn btn-danger" href="{{ url('/pedidos') }}" >Cancelar</a>
					</div>
				</div>

			</div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection