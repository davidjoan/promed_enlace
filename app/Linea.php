<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Linea extends Model {

    protected $table = 'linea';

    protected $fillable = ['division_id','code', 'name', 'description'];

}
