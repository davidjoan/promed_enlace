<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model {

    protected $table = 'paciente';

    protected $fillable = ['farmacia_id','ubigeo_id','dni','name','sexo','edad','direccion','telefono','correo','nuevo','receta','description'];

    public function farmacia()
    {
        return $this->belongsTo('Enlace\Farmacia');
    }

    public function ubigeo()
    {
        return $this->belongsTo('Enlace\Ubigeo');
    }

}
