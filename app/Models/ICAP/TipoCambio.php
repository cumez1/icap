<?php

namespace App\Models\ICAP;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AuditFieldsTrait;

class TipoCambio extends Model
{
    use AuditFieldsTrait;
    
    protected $table = 'icap.tipo_cambio';
    protected $primaryKey = 'id_tipo_cambio';
    public $timestamps = false;

    protected $fillable = [ 
        'fecha','banguat_referencia','banrural_compra', 'banrural_venta', 'esta_activo',
        'id_usuario', 'fh_ingreso','ip_ingreso'
    ];

    public function scopeActivo($query)
    {
        return $query->where('esta_activo', TRUE);
    }

    public function scopeInactivo($query)
    {
        return $query->where('esta_activo', FALSE);
    }

}
