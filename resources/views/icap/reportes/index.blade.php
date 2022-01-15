<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reportes
        </h2>
    </x-slot>
    
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-10 lg:px-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 10px;">
				<div class="py-1">
					<a href="{{route('empleados.index')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
						<i class="fas fa-user-check"></i> &nbsp;&nbsp; Listado de Empleados
					</a>
				</div>
				<br>
				<table id="listado" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead>
						<tr>
							<th data-priority="1">#</th>
							<th data-priority="2">Reporte</th>
							<th data-priority="8">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>a. Empleado con mayor salario</td>
							<td>
								<a 

									style="background-color: #6d28d9"
									href="#reporte-1"
									class="rpt inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition">
									<i class="far fa-file-alt"></i>
								</a>
							</td>
						</tr>

						<tr>
							<td>2</td>
							<td>b. Número de empleados con un mismo salario</td>
							<td>
								<a 
									style="background-color: #6d28d9"
									href="#reporte-2"
									class="rpt inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition">
									<i class="far fa-file-alt"></i>
								</a>
							</td>
						</tr>

						<tr>
							<td>3</td>
							<td>c. Edad de los empleados según su fecha de nacimiento</td>
							<td>
								<a 
									style="background-color: #6d28d9"
									href="#reporte-3"
									class="rpt inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition">
									<i class="far fa-file-alt"></i>
								</a>
							</td>
						</tr>

						<tr>
							<td>4</td>
							<td>d. Cargo del empleado con menor salario</td>
							<td>
								<a 
									style="background-color: #6d28d9"
									href="#reporte-4"
									class="rpt inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition">
									<i class="far fa-file-alt"></i>
								</a>
							</td>
						</tr>

					</tbody>
	
				</table>
            </div>
        </div>
    </div>


	<div class="py-6" id="reporte-1" style="display: none;">
        <div class="max-w-7xl mx-auto sm:px-10 lg:px-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 10px;">
				
				<br>
				<table id="listado" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead>
						<tr style="text-align: left;">
							<th data-priority="1">#</th>
							<th data-priority="2">CUI</th>
							<th data-priority="3">Nombre Completo</th>
							<th data-priority="4">Puesto</th>
							<th data-priority="4">Salario</th>
						</tr>
					</thead>
					<tbody>
						@php
							$dato = $empleados->where('esta_activo',true)->sortByDesc('salario')->first();
						@endphp
						<tr>
							<td>1</td>
							<td>{{$dato->cui_format}}</td>
							<td>{{$dato->nombre_completo}}</td>
							<td>{{$dato->puesto}}</td>
							<td>{{$dato->salario}}</td>
						</tr>
					</tbody>
				</table>
            </div>
        </div>
    </div>


	<div class="py-6" id="reporte-2" style="display:none;">
        <div class="max-w-7xl mx-auto sm:px-10 lg:px-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 10px;">
				
				<br>
				<table id="listado" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead>
						<tr style="text-align: left;">
							<th data-priority="1">#</th>
							<th data-priority="2">Salario</th>
							<th data-priority="3">Cantidad de empleados</th>
						</tr>
					</thead>
					<tbody>
						@php
							$index = 0;
							$datos = $empleados->whereStrict('esta_activo',true)
								->groupBy('salario')
								->sortByDesc('salario');
						@endphp

						@foreach($datos as $item)
						<tr>
							<td>{{($index + 1)}}</td>
							<td>{{$item->first()->salario}}</td>
							<td>{{$item->count()}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
            </div>
        </div>
    </div>


	<div class="py-6" id="reporte-3" style="display:none;">
        <div class="max-w-7xl mx-auto sm:px-10 lg:px-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 10px;">
				
				<br>
				<table id="listado" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead>
						<tr style="text-align: left;">
							<th data-priority="1">#</th>
							<th data-priority="2">CUI</th>
							<th data-priority="3">Nombre Completo</th>
							<th data-priority="4">Celular</th>
							<th data-priority="5">Fecha Nacimiento</th>
							<th data-priority="6">Edad</th>
							<th data-priority="7">Estado</th>
						</tr>
					</thead>
					<tbody>
						@foreach($empleados as $item)
							<tr>
								<td>{{$loop->iteration}}</td>
								<td>{{$item->cui_format}}</td>
								<td>{{$item->nombre_completo}}</td>
								<td>{{$item->telefono}}</td>
								<td>{{$item->fh_nacimiento_format}}</td>
								<td>{{$item->edad}}</td>
								<td>{{$item->esta_activo ? 'Activo' : 'Inactivo'}}</td>
								
							</tr>
						@endforeach
					</tbody>
	
				</table>
            </div>
        </div>
    </div>


	
	<div class="py-6" id="reporte-4" style="display: none;">
        <div class="max-w-7xl mx-auto sm:px-10 lg:px-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 10px;">
				
				<br>
				<table id="listado" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead>
						<tr style="text-align: left;">
							<th data-priority="1">#</th>
							<th data-priority="2">CUI</th>
							<th data-priority="3">Nombre Completo</th>
							<th data-priority="4">Puesto</th>
							<th data-priority="4">Salario</th>
						</tr>
					</thead>
					<tbody>
						@php
							$dato = $empleados->where('esta_activo',true)->sortBy('salario')->first();
						@endphp
						<tr>
							<td>1</td>
							<td>{{$dato->cui_format}}</td>
							<td>{{$dato->nombre_completo}}</td>
							<td>{{$dato->puesto}}</td>
							<td>{{$dato->salario}}</td>
						</tr>
					</tbody>
				</table>
            </div>
        </div>
    </div>


@section('styles')
    <!--Regular Datatables CSS-->
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
	<!--Responsive Extension Datatables CSS-->
	<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
	<link href="{{asset('css/styles.css')}}" rel="stylesheet">

@endsection

@section('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

	<!--Datatables -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	
	<script>
		$(document).ready(function() {

			var table = $('#listado').DataTable({
					responsive: true
				})
				.columns.adjust()
				.responsive.recalc();

			$('.rpt').click(function(){

				$('#reporte-1').hide();
				$('#reporte-2').hide();
				$('#reporte-3').hide();
				$('#reporte-4').hide();

				let rerporte = $(this).attr('href')

				$(rerporte).show();


			})
		});
	</script>

@endsection

</x-app-layout>
