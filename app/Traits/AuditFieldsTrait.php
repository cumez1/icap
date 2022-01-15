<?php
namespace App\Traits;

trait AuditFieldsTrait
{
    public static function bootAuditFieldsTrait()
    {
        static::creating(function ($model) 
        {
            $model->usuario_ingreso = $model::username();
            $model->fh_ingreso = $model::now();
            $model->ip_ingreso = $model::ip();

        });

        static::updating(function ($model) 
        {
            $model->usuario_ingreso = $model::username();
            $model->fh_ingreso = $model::now();
            $model->ip_ingreso = $model::ip();
        });

        static::deleting(function ($model) 
        {
            $model->usuario_ingreso = $model::username();
            $model->fh_ingreso = $model::now();
            $model->ip_ingreso = $model::ip();

        });

    }

    public static function username()
    {
        return auth()->user()->id ?? 'linux';
    }

    public static function ip()
    {
        $ip = request()->ip();
        return $ip == '::1' ? '127.0.0.1' : $ip;
    }

    public static function now()
    {
        return now()->toDateTimeString();
    }

}