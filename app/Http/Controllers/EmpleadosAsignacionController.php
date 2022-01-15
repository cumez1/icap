<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ICAP\VWEmpleado;
use App\Models\ICAP\Empleado;
use App\Models\ICAP\EmpleadoAsignacion;
use App\Models\ICAP\Puesto;
use DB;

class EmpleadosAsignacionController extends Controller
{

    public function asignar($id)
    {
        $registro = VWEmpleado::where('id_empleado',$id)->first();
        $puestos  = Puesto::all();

        $asignacion = EmpleadoAsignacion::where('id_empleado', $id)->first();
        if(is_null($asignacion)) {
            $asignacion = new EmpleadoAsignacion();
        }

        if(is_null($registro)) {
            session()->put('message-error', 'No se encontró el registro que esta buscando');
            return redirect()->route('empleados.index')->withInput();
        }

		return view('icap.empleados-asignacion.asignar',compact('registro','puestos','asignacion'));
	}

    
    public function save(Request $request)
    {
        $request->validate([
            'id_empleado'               => 'required|integer',
            'id_empleado_asignacion'    => 'nullable|integer',
            'puesto'                    => 'required|integer',
            'salario'                   => 'required',
            'observaciones'             => 'nullable',
        ],[
            'id_empleado.required'              => 'No se encontró el registro',
            'id_empleado.integer'               => 'No se encontró el registro',
            'id_empleado_asignacion.required'   => 'No se encontró el registro',
            'id_empleado_asignacion.integer'    => 'No se encontró el registro',
            'puesto.required'                   => 'Seleccione un puesto',
            'puesto.integer'                    => 'Seleccione un puesto',
            'salario.required'                  => 'Debe ingresar el sueldo',
            
        ]);

        $datos = [
            'id_empleado'   => $request->id_empleado,
            'id_puesto'     => $request->puesto,
            'salario'       => $request->salario,
            'observaciones' => $request->observaciones,
            'esta_activo'   => true,
        ];

        DB::beginTransaction();
        try {
            $id = $request->id_empleado_asignacion;

            if ($id) {
                $registro  = EmpleadoAsignacion::where('id_empleado_asignacion', $id)->first();
                $registro->update($datos);
            } else {
                $registro = EmpleadoAsignacion::create($datos);
            }

            DB::commit();
            session()->put('message-info', 'Se asignó el sueldo exitosamente');
            return redirect()->route('empleados.index');

        } catch (Exception $e) {

            DB::rollBack();
            session()->put('message-error', 'Hubo un error en la base de datos');
            
            return redirect()->route('asignacion.asignar')->withInput();
        }
        
	}

}
