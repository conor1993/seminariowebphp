<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebSolicitudBoletos extends Model
{   
	protected $primaryKey = 'Id';
    protected $table='WebSolicitudBoletos';
    protected $fillable=['Folio','IdColaborador','IdGestor' ,'IdCanalDistribucion','BoletosSolicitados','BoletosAutorizados','Estatus','IdSorteo'];
    public $timestamps = false;
}
