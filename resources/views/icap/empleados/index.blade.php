<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Empleados
        </h2>
    </x-slot>
    
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-10 lg:px-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" style="padding: 10px;">
				<div class="py-1">
					<a href="{{route('empleados.crear')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
						<i class="fas fa-plus-circle"></i> &nbsp;&nbsp; Crear nuevo
					</a>
				</div>
				<br>
				<table id="listado" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
					<thead>
						<tr>
							<th data-priority="1">#</th>
							<th data-priority="2">CUI</th>
							<th data-priority="3">Nombre Completo</th>
							<th data-priority="4">Celular</th>
							<th data-priority="5">Fecha Nacimiento</th>
							<th data-priority="6">Edad</th>
							<th data-priority="7">Estado</th>
							<th data-priority="8">Acciones</th>
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
								<td>
									<a 
										href="{{route('empleados.editar',$item->id_empleado)}}" 
										class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
										<i class="fas fa-edit"></i>
									</a>
									
									@if($item->esta_activo)
										<a 
											style="background-color: #6d28d9"
											href="{{route('asignacion.asignar',$item->id_empleado)}}" 
											class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:outline-none  focus:ring disabled:opacity-25 transition">
											<i class="fas fa-money-bill-alt"></i>
										</a>
										<a  
											href="{{route('empleados.estado',$item->id_empleado)}}"
											class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
											<i class="fas fa-trash"></i>
										</a>
									@else
										<a  
											href="{{route('empleados.estado',$item->id_empleado)}}"
											class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
											<i class="fas fa-trash-restore-alt"></i>
										</a>
									@endif
								</td>
							</tr>
						@endforeach
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
		});
	</script>

@endsection

</x-app-layout>
