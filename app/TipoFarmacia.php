<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class TipoFarmacia extends Model {

    protected $table = 'tipo_farmacia';

    protected $fillable = ['code', 'name', 'description'];

}
