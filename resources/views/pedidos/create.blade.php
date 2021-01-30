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
			<h3 class="text-center"><strong>FORMULARIO DE NUEVO PEDIDO</strong></h3><br>
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
			{!!Form::open(array('url'=>'pedidos','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

			<p class="text-center"><strong>Cabecera</strong></p>
			<div class="row" style="background-color:#5DADE2"><br>
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="">Cliente</label>
						<select name="id_cliente" id="" class="form-control">
						<option value="">-- SELECCIONE CLIENTE --</option>
						@foreach ($clientes as $cli)
						<option value="{{$cli->id_cliente}}">{{$cli->nombre." ".$cli->apellido}}</option>
						@endforeach
						</select>
					</div>	
				</div>
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="id_envio">Direccion de envio</label>
						<input type="number" name="id_envio" value="{{old('id_envio')}}" class="form-control" placeholder="Numero de direccion de Envio">
					</div>
				</div>
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="fecha">Fecha</label>
						<input type="datetime-local" name="fecha" value="{{old('fecha')}}" class="form-control" placeholder="Fecha">
					</div>
				</div>
			</div><br><br>

			<p class="text-center"><strong>Cuerpo del pedido</strong></p>
			<div class="row" style="background-color:#5DADE2"><br>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="">Articulo</label>
						<select name="id_articulo" id="" class="form-control">
						<option value="">-- SELECCIONES EL ARTICULO --</option>
						@foreach ($articulos as $art)
						<option value="{{$art->id_articulo}}">{{$art->articulo}}</option>
						@endforeach
						</select>
					</div>	
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="cantidad">Cantidad</label>
						<input type="number" name="cantidad" value="{{old('cantidad')}}"  class="form-control" placeholder="Cantidad del pedido">
					</div>
				</div>
				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<div class="form-group">
						<label for="descripcion">Descripcion</label>
						<input type="text" name="descripcion" value="{{old('descripcion')}}" onkeypress="return soloLetras(event)"  class="form-control" placeholder="Descripcion del pedido">
					</div>
				</div>
			</div><br>

			<div class="text-center">
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<a class="btn btn-danger" href="{{ url('/pedidos') }}" >Cancelar</a>
				</div>
			</div>
			
			{!!Form::close()!!}		
@endsection