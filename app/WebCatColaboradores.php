<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebCatColaboradores extends Model
{
		protected $primaryKey = 'Id';
		protected $table ='WebCatColaboradores';
		protected $fillable = ['Nombre','ApellidoP','ApellidoM','IdGestor','IdCanaldis','Correspondecia','Commission','Domicilio' ,'Cp','Telefono','IdEstado','Numeroint','NumeroExt','IdMunicipio','IdLocalidad','Empresa','PuestoEmpresa','DomiclioEmpresa','Cpempresa','NumerointEmpresa','NumeroextEmpresa','IdEstadoEmpresa','TelefonoEmpresa','IdmunicipioEmpresa','IdLocalidadEmpresa'];
		public $timestamps = false;

}
