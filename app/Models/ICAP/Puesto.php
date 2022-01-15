<?php

namespace App\Models\ICAP;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AuditFieldsTrait;

class Puesto extends Model
{
    use AuditFieldsTrait;

    protected $table = 'icap.puesto';
    protected $primaryKey = 'id_puesto';
    protected $fillable = ['puesto', 'descripcion','esta_activo'];
    protected $hidden = ['usuario_ingreso', 'fh_ingreso', 'ip_ingreso'];
    public $timestamps = false;


    protected $casts = [
        'fh_ingreso' => 'datetime',
        'fh_ultima_mod' => 'datetime',
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
