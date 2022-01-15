<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpClient\HttpClient;
use Goutte\Client;
use Carbon;

class Banrural extends Model
{
    public static function tipoCambioDia()
    {
		$url = config('constantes.URLBanrural'); 
		$response['resultado'] = null;
		$response['error'] = 0;

	    try {

			$clientNative = HttpClient::create(['verify_peer' => false, 'verify_host' => false]);
	        $client = new Client($clientNative);
	        $crawler = $client->request('GET', $url);
			
	       	$table = $crawler->filter('#ContenedorCambioDia > table');
			   
	       	if($table->count() == 0){
	       		$response['descripcion'] = 'No se encontró la tabla de tipo de cambio';
	       		return (object) $response;
	       	}

	       	$index = 0;
	       	$resultado = array();
	       	$rows = $table->first()->filter('tr');
	       	
	       	$rows->each(function($node) use (&$resultado,&$index) {
	       		$START = 4;
	       		$STOP = 6;
	       		$columns = $node->filter('td');
	       		$transaccion = array(4 => 'efectivo', 5=> 'transfererncia', 6 => 'virtual_movil');

	       		if($index >= $START && $index <= $STOP)
	       		{
                    $item['descripcion'] = trim($columns->eq(0)->text());
                    $item['compra'] = floatval(trim(str_replace('Q.', '',$columns->eq(1)->text())));
                    $item['venta'] = floatval(trim(str_replace('Q.', '',$columns->eq(2)->text())));

                   	$resultado[$transaccion[$index]] = (object) $item;
                }
                $index++;

	       	});

	       	$fecha = self::parseDate($crawler->filter('.FechaDelDia')->text());
	       	
	       	$response['error'] = 0;
	       	$response['fecha'] = Carbon::createFromFormat('d m Y',$fecha);
	       	$response['descripcion'] = 'Consulta exitosa desde la página www.banrural.com.gt';
	       	$response['resultado'] = $resultado;

	    } catch (\Throwable $e) {
			$response['error'] = 1;
			$response['message'] = $e->getMessage();
			
			$response['descripcion'] = $e->getMessage();
            if(strpos(strtolower($e->getMessage()),'failed to load external entity') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banrural.com.gt';
			}elseif(strpos(strtolower($e->getMessage()),'resolve host name') !== false){
                $response['descripcion'] = 'No se pudo conectar a www.banrural.com.gt';
			}
		}
		
        return (object) $response;
	}

	public static function parseDate($value)
	{
        $find = array('enero','febrero','marzo','abril','mayo','junio',
        			  'julio','agosto','septiembre','octubre','noviembre','diciembre',
        			  'de ', ',');
        $repl = array(1,2,3,4,5,6,7,8,9,10,11,12,'','');
        $value = str_replace($find, $repl, $value);

        return $value;        

	}

}
