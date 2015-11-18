<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model {

    protected $table = 'venta';

    protected $fillable = ['user_id','medico_id','paciente_id','periodo_id','producto_id','fecha','codigo','cantidad','bonificacion','fraccion','description','receta'];


    public function user()
    {
        return $this->belongsTo('Enlace\User');
    }

    public function medico()
    {
        return $this->belongsTo('Enlace\Medico');
    }

    public function paciente()
    {
        return $this->belongsTo('Enlace\Paciente');
    }

    public function periodo()
    {
        return $this->belongsTo('Enlace\Periodo');
    }

    public function producto()
    {
        return $this->belongsTo('Enlace\Producto');
    }

}
