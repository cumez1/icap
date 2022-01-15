<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ICAP\TipoCambio;
use App\Services\Banguat;
use App\Services\Banrural;
use Log;
use DB;

class ConsultarTipoCambio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'icap:consultar-tipocambio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hoy = now();
        $tipoCambio = TipoCambio::where('fecha', $hoy->toDateString())->first();
        
        DB::beginTransaction();
        try {
			if (is_null($tipoCambio)) {
				$banguat = Banguat::tipoCambioDia();
				$banrural = Banrural::tipoCambioDia();
				
				$data['fecha']              = $hoy->toDateString();
				$data['banguat_referencia'] = $banguat->resultado->referencia ?? null;
				$data['banrural_compra'] 	= $banrural->resultado['efectivo']->compra ?? null;
				$data['banrural_venta'] 	= $banrural->resultado['efectivo']->venta ?? null;
				$data['esta_activo'] 	    = true;

                $tipo = TipoCambio::create($data);
                DB::commit();

                Log::info('Se registró correctamente el tipo de cambio del día: ');

			}

            $this->info('Se ha obtenido exitosamente los tipos de cambio de dolar a quetzales');
        } catch (\Exception $e) {
            DB::rollBack();
            $errorCode  = $e->errorInfo[0] ?? null;
            $error      = 'Hubo un error en la base de datos';

            if ($errorCode == config('constantes.dupliqueConstraint')){
                $error  = 'El tipo de cambio ya está registrada';
            }

            Log::error($error);
            $this->info('Error'.$error); 
        }
    }
}
