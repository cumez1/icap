<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ICAP\VWEmpleado;
use App\Models\ICAP\Empleado;
use App\Models\ICAP\EmpleadoAsignacion;
use App\Models\ICAP\Puesto;
use DB;

class ReportesController extends Controller
{

    public function index()
    {
        $empleados = VWEmpleado::all();
		return view('icap.reportes.index',compact('empleados'));
	}

}
