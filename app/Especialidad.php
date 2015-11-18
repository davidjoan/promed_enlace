<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model {

    protected $table = 'especialidad';

    protected $fillable = ['code', 'name', 'description'];

}
