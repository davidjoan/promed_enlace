<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model {

    protected $table = 'medico';

    protected $fillable = ['farmacia_id','especialidad_id','cmp','name','nuevo','description'];

    public function farmacia()
    {
        return $this->belongsTo('Enlace\Farmacia');
    }

    public function especialidad()
    {
        return $this->belongsTo('Enlace\Especialidad');
    }

}
