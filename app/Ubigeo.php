<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model {

    protected $table = 'ubigeo';

    protected $fillable = ['code','name','department','province','district','description'];



}
