<?php

namespace App\Models\ICAP;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AuditFieldsTrait;
use Carbon;

class Empleado extends Model
{
    use AuditFieldsTrait;

    protected $table = 'icap.empleado';
    protected $primaryKey = 'id_empleado';
    protected $appends    = ['nombre_completo','fh_nacimiento_format','edad'];
    protected $fillable = [
        'id_puesto','cui','nombres', 'apellidos','fh_nacimiento',
        'email','telefono','direccion','esta_activo'
    ];
    protected $hidden = ['usuario_ingreso', 'fh_ingreso', 'ip_ingreso'];
    public $timestamps = false;


    protected $casts = [
        'fh_ingreso' => 'datetime',
        'fh_ultima_mod' => 'datetime',
    ];

    public function puesto(){
        return $this->hasOne(Puesto::class, 'id_puesto', 'id_puesto');
    }

    public function scopeActivo($query)
    {
        return $query->where('esta_activo', TRUE);
    }

    public function scopeInactivo($query)
    {
        return $query->where('esta_activo', FALSE);
    }

    public function getNombreCompletoAttribute()
    {
        return $this->nombres.' '.$this->apellidos;
    }

    public function getFhNacimientoFormatAttribute()
    {
        if($this->fh_nacimiento){
            return Carbon::parse($this->fh_nacimiento)->format('d/m/Y');
        }
        
        return null;
    }

    public function getEdadAttribute()
    {
        return Carbon::parse($this->fh_nacimiento)->age;
    }

    public function getInicialesAttribute(){
        $iniciales = null;
        $nameParts = explode(' ',$this->nombre_completo);

        foreach($nameParts as $part){
            $iniciales .= substr($part, 0, 1);
        }

        return mb_strtoupper($iniciales);
    }

}
