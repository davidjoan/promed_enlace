<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model {

    protected $table = 'producto';

    protected $fillable = ['linea_id','familia_id','code', 'name', 'description','cantidad','bonificacion'];

    public function linea()
    {
        return $this->belongsTo('Enlace\Linea');
    }

    public function familia()
    {
        return $this->belongsTo('Enlace\Familia');
    }

}
