<?php

namespace App\Models\ICAP;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AuditFieldsTrait;
use Carbon;

class VWEmpleado extends Model
{
    use AuditFieldsTrait;

    protected $table = 'icap.vw_empleados';
    protected $primaryKey = 'id_empleado';

    public $timestamps = false;

    public function scopeActivo($query)
    {
        return $query->where('esta_activo', TRUE);
    }

    public function scopeInactivo($query)
    {
        return $query->where('esta_activo', FALSE);
    }
    
}
