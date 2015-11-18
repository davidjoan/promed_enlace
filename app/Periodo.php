<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model {

    protected $table = 'periodo';

    protected $fillable = ['code', 'name', 'description'];


}
