<!-- ENTER EL CODIGO -->

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
			<h3 class="text-center"><strong>Editar Cliente:</strong> {{ $clientes->nombre}}</h3><br>
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

			{!!Form::model($clientes,['method'=>'PATCH','route'=>['clientes.update',$clientes->id_cliente]])!!}
            {{Form::token()}}
			<div class="row">

			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
            	<label for="codigo_unico">Codigo</label>
            	<input type="text" name="codigo_unico"  required value="{{$clientes->codigo_unico}}"class="form-control" placeholder="Codigo del Cliente">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" value="{{$clientes->nombre}}" onkeypress="return soloLetras(event)" class="form-control" placeholder="Nombre del Cliente">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
            	<label for="apellido">Apellido</label>
            	<input type="text" name="apellido" value="{{$clientes->apellido}}" onkeypress="return soloLetras(event)"  class="form-control" placeholder="Apellido del Cliente">
            </div>
		</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
					<label for="">Direccion de envio</label>
						<select name="id_envio" id="" class="form-control">
							@foreach ($envios as $env)
								@if($env->id_envio==$clientes->id_envio)
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
            	<label for=saldo>Saldo</label>
            	<input type="number" name="saldo" value="{{$clientes->saldo}}" class="form-control" placeholder="Saldo">
            </div>
		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
            	<label for=credito>Credito</label>
            	<input type="number" name="credito" value="{{$clientes->credito}}" class="form-control" placeholder="Credito">
            </div>
		</div>
		<div class="col-lg-12 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
            	<label for=descuento>Descuento</label>
            	<input type="number" name="descuento" value="{{$clientes->descuento}}"class="form-control" placeholder="Descuento">
            </div>
		</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
            	<a class="btn btn-danger" href="{{ url('/clientes') }}" >Cancelar</a>
            </div>
		</div>

	</div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection