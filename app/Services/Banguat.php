<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use SoapClient;
use Carbon;

class Banguat extends Model
{

    public static function tipoCambioDia()
    {
        $url = config('constantes.URLBanguat');
        $response['resultado'] = null;
        $response['error'] = 0;
            
        try {            
            $ws = new SoapClient($url);
            $resultado = $ws->TipoCambioDia()->TipoCambioDiaResult->CambioDolar->VarDolar;
            $response['resultado'] = $resultado;
            $response['fecha'] = Carbon::createFromFormat('d/m/Y',$resultado->fecha);
            $response['error'] = 0;
            $response['descripcion'] = 'La consulta fue realizada con éxito';

        } catch (\Throwable $e) {
			$response['error'] = 1;
			$response['message'] = $e->getMessage();
			
			$response['descripcion'] = $e->getMessage();
            if(strpos(strtolower($e->getMessage()),'failed to load external entity') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banguat.gob.gt';
            }elseif(strpos(strtolower($e->getMessage()),'resolve host name') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banguat.gob.gt';
			}
        }   
           
        return (object) $response;
    }

    public static function tipoCambioRango($fhInicial, $fhFinal)
    {
        $url = config('constantes.URLBanguat');
        $rango = array('fechainit' => $fhInicial, 'fechafin' => $fhFinal);

        try {            
            $ws = new SoapClient($url);
            $response['resultado'] = $ws->TipoCambioRango($rango)->TipoCambioRangoResult->Vars->Var;
            $response['descripcion'] = 'La consulta fue realizada con éxito';
            $response['error'] = 0;

        } catch (\Throwable $e) {
			$response['error'] = 1;
			$response['message'] = $e->getMessage();
			
			$response['descripcion'] = $e->getMessage();
            if(strpos(strtolower($e->getMessage()),'failed to load external entity') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banguat.gob.gt';
            }elseif(strpos(strtolower($e->getMessage()),'resolve host name') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banguat.gob.gt';
			}
        }

        return (object) $response;
    }

    public static function tipoCambioRangoMoneda($fhInicial, $fhFinal, $moneda = 2)
    {
        #Moneda 1: Quetzales, 2: Dollar USA... etc

        $url = config('constantes.URLBanguat');
        $rangoMoneda = array('fechainit' => $fhInicial, 'fechafin' => $fhFinal,'moneda' =>$moneda);
        $response['resultado'] = null;
        $response['error'] = 0;
        
        try {            
            $ws = new SoapClient($url);
            $response['resultado'] = $ws->TipoCambioRangoMoneda($rangoMoneda)->TipoCambioRangoMonedaResult->Vars->Var;
            $response['descripcion'] = 'La consulta fue realizada con éxito';
            $response['error'] = 0;

        } catch (\Throwable $e) {
			$response['error'] = 1;
			$response['message'] = $e->getMessage();
			
			$response['descripcion'] = $e->getMessage();
            if(strpos(strtolower($e->getMessage()),'failed to load external entity') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banguat.gob.gt';
            }elseif(strpos(strtolower($e->getMessage()),'resolve host name') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banguat.gob.gt';
			}
        }

        return (object) $response;
    }

    public static function tipoCambioFechaInicial($fhInicial)
    {
        $url = config('constantes.URLBanguat');
        $desdeNow = array('fechainit' => $fhInicial);
        $response['resultado'] = null;
        $response['error'] = 0;
        
        try {            
            $ws = new SoapClient($url);
            $response['resultado'] = $ws->TipoCambioFechaInicial($desdeNow)->TipoCambioFechaInicialResult->Vars->Var;
            $response['descripcion'] = 'La consulta fue realizada con éxito';
            $response['error'] = 0;

        }catch (\Throwable $e) {
			$response['error'] = 1;
			$response['message'] = $e->getMessage();
			
			$response['descripcion'] = $e->getMessage();
            if(strpos(strtolower($e->getMessage()),'failed to load external entity') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banguat.gob.gt';
            }elseif(strpos(strtolower($e->getMessage()),'resolve host name') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banguat.gob.gt';
			}
        }

        return (object) $response;
    }
    
    public static function moneda($moneda = 2)
    {
        $url = config('constantes.URLBanguat');
        $moneda = array('variable' => $moneda);
        $response['resultado'] = null;
		$response['error'] = 0;

        try {            
            $ws = new SoapClient($url);
            $response['resultado'] = $ws->Variables($moneda)->VariablesResult;
            $response['descripcion'] = 'La consulta fue realizada con éxito';
            $response['error'] = 0;

        } catch (\Throwable $e) {
			$response['error'] = 1;
			$response['message'] = $e->getMessage();
			
			$response['descripcion'] = $e->getMessage();
            if(strpos(strtolower($e->getMessage()),'failed to load external entity') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banguat.gob.gt';
            }elseif(strpos(strtolower($e->getMessage()),'resolve host name') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banguat.gob.gt';
			}
        }

        return (object) $response;
    }

}
