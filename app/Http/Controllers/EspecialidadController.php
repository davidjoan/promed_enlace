<?php 

namespace Enlace\Http\Controllers;

use Enlace\Http\Requests;
use Enlace\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class EspecialidadController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        // Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields


		$this->filter = \DataFilter::source(new \Enlace\Especialidad());
		$this->filter->add('name', 'Nombre', 'text');
		$this->filter->submit('Buscar');
		$this->filter->reset('resetear');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);
		$this->grid->add('code', 'Código');
		$this->grid->add('name', 'Nombre');
	//	$this->grid->add('description', 'Detalle');

		$this->addStylesToGrid();

                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        // Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	
		$this->edit = \DataEdit::source(new \Enlace\Especialidad());

		$this->edit->label('Editar Especialidad');

		$this->edit->add('code', 'Código', 'text')->rule('required');
		$this->edit->add('name', 'Nombre', 'text')->rule('required');
       
        return $this->returnEditView();
    }    
}
