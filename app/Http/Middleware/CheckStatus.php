<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\ICAP\TipoCambio;
use Artisan;
use Session;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        if(Auth::check()){
            self::setTipoCambio();
        }
        return $response;
    }

    private static function setTipoCambio(): void
    {
        $hoy = now();
        $tipoCambio = TipoCambio::where('fecha', $hoy->toDateString())->first();

        if($tipoCambio) {
            Artisan::call('icap:consultar-tipocambio');

            $tipoCambio = $tipoCambio->refresh();
			Session::put('tipoCambio', (object) $tipoCambio->toArray());
        }
        
    }
}