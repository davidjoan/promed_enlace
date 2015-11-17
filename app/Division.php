<?php 

namespace Enlace;

use Illuminate\Database\Eloquent\Model;

class Division extends Model {

    protected $table = 'divisions';

    protected $title = 'División';

    protected $fillable = ['code', 'name', 'description'];

}
