<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Empleados
        </h2>
    </x-slot>
    
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-10 lg:px-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 10px;">

				<form class="w-full max-w-lg" autocomplete="off" method="POST" action="{{route('empleados.update')}}">
					@csrf
					<input type="hidden" name="id_empleado" value="{{$registro->id_empleado}}">

					@if ($errors->any())
						<div class="flex flex-wrap -mx-3 mb-2">
							<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
								<div class="py-1">
									<strong>Advertencia se encontraron estos errores:</strong><br>
									<ul class="pd-l-20">
										@foreach ($errors->all() as $error)
											<li class="text-dark"> * {{ $error }}</li>
										@endforeach
									</ul>
								</div>
							</div>
						</div>
					@endif
					
					<div class="flex flex-wrap -mx-3 mb-2">
						<div class="w-full md:w-1/2 px-3 md:mb-0">
							<div class="py-1">
								<a href="{{route('empleados.index')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
									<i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Regresar
								</a>
							</div>
						</div>

						<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
							<div class="py-1">
								<i class="fas fa-edit"></i> EDITAR REGISTRO
							</div>
						</div>
					</div>
					<div class="flex flex-wrap -mx-3 mb-2">
						
						<div class="md:w-1/2 px-3 mb-6 md:mb-0">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cui">
								CUI
							</label>
							<input 
								class="appearance-none block bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
								id="cui" 
								name="cui" 
								value="{{old('cui',$registro->cui)}}" 
								type="text">
						</div>
						<div class="md:w-1/2 px-3 mb-6 md:mb-0">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombres">
								Nombres
							</label>
							<input 
								class="appearance-none block bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
								id="nombres" 
								name="nombres" 
								value="{{old('nombres',$registro->nombres)}}" 
								type="text">
						</div>
				
						<div class="md:w-1/2 px-3 mb-6 md:mb-0">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="apellidos">
								Apellidos
							</label>
							<input 
								class="appearance-none block bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
								id="apellidos" 
								name="apellidos" 
								value="{{old('apellidos',$registro->apellidos)}}" 
								type="text">
						</div>
					</div>

					<div class="flex flex-wrap -mx-3 mb-2">
						
						<div class="md:w-1/2 px-3 mb-6 md:mb-0">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fh_nacimiento">
								Fecha de nacimiento
							</label>
							<input 
								class="appearance-none block bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
								id="fh_nacimiento" 
								name="fh_nacimiento" 
								value="{{old('fh_nacimiento',Carbon::parse($registro->fh_nacimiento)->format('Y-m-d'))}}" 
								type="date">
						</div>
				
						<div class="md:w-1/2 px-3 mb-6 md:mb-0">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
								Email
							</label>
							<input 
								class="appearance-none block bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
								id="email" 
								name="email" 
								value="{{old('email',$registro->email)}}" 
								type="email">
						</div>

						<div class="md:w-1/2 px-3 mb-6 md:mb-0">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="telefono">
								Télefono
							</label>
							<input 
								class="appearance-none block bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
								id="telefono" 
								name="telefono" 
								value="{{old('telefono',$registro->telefono)}}" 
								type="number">
						</div>
					</div>

					<div class="flex flex-wrap -mx-3 mb-2">
						
						<div class="w-3/4 px-3">
							<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" 
							for="direccion">
							  Direccion
							</label>
							<input 
							class="appearance-none block w-3/4 bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
							id="direccion" 
							name="direccion"
							value="{{old('direccion',$registro->direccion)}}"
							type="text">
						</div>
					</div>

					<div class="flex flex-wrap -mx-3 mt-4">
						<div class="w-3/4 px-3">
							<button
								type="submit" 
								class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
								<i class="fas fa-sync-alt"></i>&nbsp;&nbsp; Actualizar Registro
							</button>
						</div>
					</div>
				</form>

            </div>
        </div>
    </div>


@section('styles')
    <!--Regular Datatables CSS-->
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
	<!--Responsive Extension Datatables CSS-->
	<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link href="{{asset('css/styles.css')}}" rel="stylesheet">

@endsection

@section('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

	<!--Datatables -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script>
		$(document).ready(function() {

			var table = $('#listado').DataTable({
					responsive: true
				})
				.columns.adjust()
				.responsive.recalc();
		});
	</script>

@endsection

</x-app-layout>
