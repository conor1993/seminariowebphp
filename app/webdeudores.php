<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class webdeudores extends Model
{
    protected $primaryKey = 'Id';
	protected $table ='Webdeudores';
	protected $fillable = ['Idsolicitud','MontoAcordado','MontoPagado','FechaIngreso','FechaPago','Estatus','BoletosDevueltos','BoletosLiquidados'];
    public $timestamps = false;
}
