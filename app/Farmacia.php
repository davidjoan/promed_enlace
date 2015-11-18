<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Farmacia extends Model {

    protected $table = 'farmacia';

    protected $fillable = ['tipo_farmacia_id','code','ruc' ,'name', 'description'];

    public function tipo_farmacia()
    {
        return $this->belongsTo('Enlace\TipoFarmacia');
    }

}
