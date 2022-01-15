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
						Crear nuevo
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
							<th data-priority="7">Acciones</th>
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
								<td>
								
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
