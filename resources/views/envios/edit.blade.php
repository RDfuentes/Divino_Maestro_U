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
			<h3 class="text-center"><strong>Editar lugar:</strong> {{ $envios->lugar_envio}}</h3><br>
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

			{!!Form::model($envios,['method'=>'PATCH','route'=>['envios.update',$envios->id_envio]])!!}
            {{Form::token()}}
			<div class="row">

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="lugar_envio">Lugar de envio</label>
						<input type="text" name="lugar_envio" value="{{$envios->lugar_envio}}" onkeypress="return soloLetras(event)"  class="form-control" placeholder="Lugar de envio">
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="calle">Calle</label>
						<input type="text" name="calle" value="{{$envios->calle}}" class="form-control" placeholder="Nombre de la calle">
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="comuna">Comuna</label>
						<input type="text" name="comuna" value="{{$envios->comuna}}" onkeypress="return soloLetras(event)"  class="form-control" placeholder="Nombre de la comuna">
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for=ciudad>Ciudad</label>
						<input type="text" name="ciudad" value="{{$envios->ciudad}}" onkeypress="return soloLetras(event)"  class="form-control" placeholder="Nombre de la ciudad">
					</div>
				</div>

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<button class="btn btn-primary" type="submit">Guardar</button>
						<a class="btn btn-danger" href="{{ url('/envios') }}" >Cancelar</a>
					</div>
				</div>

			</div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection