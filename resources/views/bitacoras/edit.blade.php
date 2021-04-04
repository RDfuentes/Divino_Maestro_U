@extends ('layouts.admin')
@section ('contenido')

	<div class="row">
		<div class="col-xs-12">
			<h3 class="text-center"><strong>Bitacora de fecha:</strong> {{ $bitacoras->fecha}}</h3><br>
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

			{!!Form::model($bitacoras,['method'=>'PATCH','route'=>['bitacoras.update',$bitacoras->id_bitacora]])!!}
            {{Form::token()}}
			<center>
			<div class="row">

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="nombre">Fecha actividad realizada</label>
						<input type="text" name="nombre" value="{{$bitacoras->fecha}}" onkeypress="return soloLetras(event)" class="form-control" placeholder="Nombre de la fabrica">
					</div>
				</div>

				<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
					<div class="form-group">
						<label for="nombre">Actividad realizada</label>
						<input type="text" name="nombre" value="{{$bitacoras->actividad_realizada}}" onkeypress="return soloLetras(event)" class="form-control" placeholder="Nombre de la fabrica">
					</div>
				</div>

				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<div class="form-group">
						<label for="nombre">Informacion actualizada</label>
						<input type="text" name="nombre" value="{{$bitacoras->informacion_actual}}" onkeypress="return soloLetras(event)" class="form-control" placeholder="Nombre de la fabrica">
					</div>
				</div>

				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<div class="form-group">
						<label for="nombre">Informacion anterior</label>
						<input type="text" name="nombre" value="{{$bitacoras->informacion_anterior}}" onkeypress="return soloLetras(event)" class="form-control" placeholder="Nombre de la fabrica">
					</div>
				</div>

				<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
					<div class="form-group">
						<a class="btn btn-danger" href="{{ url('/bitacoras') }}" >Regresar</a>
					</div>
				</div>
			</div>
			</center>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection