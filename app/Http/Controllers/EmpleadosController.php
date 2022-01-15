<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ICAP\VWEmpleado;
use App\Models\ICAP\Empleado;
use DB;
class EmpleadosController extends Controller
{
    public function index()
    {
        $empleados = VWEmpleado::all();

		return view('icap.empleados.index',compact('empleados'));
	}

    public function crear()
    {
		return view('icap.empleados.crear');
	}


    public function save(Request $request)
    {
        $request->validate([
            'cui'               => 'required|numeric|digits_between:13,13',
            'nombres'           => 'required',
            'apellidos'         => 'required',
            'email'             => 'nullable|email',
            'telefono'          => 'required|integer|digits_between:8,8',
            'fh_nacimiento'     => 'required|date',
            'direccion'         => 'nullable',
        ],[
            'cui.required'              => 'Ingrese CUI',
            'cui.numeric'               => 'El CUI permite únicamente números',
            'cui.digits_between'        => 'El CUI debe tener 13 dígitos',
            'nit.required'              => 'Ingrese su NIT',
            'nombres.required'          => 'Ingrese sus nombres',
            'apellidos.required'        => 'Ingrese sus apellidos',
            'email.required'            => 'Ingrese su correo electrónico',
            'email.email'               => 'Ingrese un correo electrónico válido',
            'celular.required'          => 'Ingrese su número de celular',
            'celular.integer'           => 'El número de celular debe tener únicamente números',
            'celular.digits_between'    => 'El número de celular deber tener ocho dígitos',
            'telefono.required'         => 'Ingrese su número de teléfono',
            'telefono.integer'          => 'El número de teléfono de residencia debe tener únicamente números',
            'telefono.digits_between'   => 'El número de teléfono de su residencia debe tener ocho dígitos',
            'fh_nacimiento.required'    => 'Ingrese su fecha de nacimiento',
            'fh_nacimiento.date_format' => 'La fecha de nacimiento debe tener el formato dd/mm/aaaa',
            'direccion.required'        => 'Ingrese su dirección de residencia',
        ]);
        
        
        DB::beginTransaction();
        try {
            
            Empleado::create($request->all());
            DB::commit();
            session()->put('message-info', 'Menú creado exitosamente');
            return redirect()->route('empleados.index');

        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[0];
            session()->put('message-error', 'Hubo un error en la base de datos');
            if($errorCode == config('constantes.dupliqueConstraint')){
                session()->put('message-error', 'El número de CUI ya esta registrado');
            }
            return redirect()->route('empleados.crear')->withInput();
        }
        
	}
}
