<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class webmovdeudores extends Model
{
    protected $primaryKey = 'Cve';
	protected $table ='webmovdeudores';
	protected $fillable = ['IdColaborador','NumeroBoleto','IdSorteo','IdTipoMovimiento','Fecha'];
    public $timestamps = false;
}
