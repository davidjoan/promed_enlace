<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Division extends Model {

    protected $table = 'division';

    protected $fillable = ['code', 'name', 'description'];

}
