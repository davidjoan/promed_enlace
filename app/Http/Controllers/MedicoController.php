<?php 

namespace Enlace\Http\Controllers;

use Enlace\Http\Requests;
use Enlace\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class MedicoController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        // Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields

        $medico = new \Enlace\Medico;
        $this->filter = \DataFilter::source($medico->newQuery()->with('especialidad','farmacia'));

		$this->filter->add('cmp', 'CMP', 'text');
		$this->filter->add('name', 'Nombre', 'text');
		$this->filter->submit('Buscar');
		$this->filter->reset('resetear');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);
        $this->grid->add('farmacia.name', 'Registrado por');
        $this->grid->add('especialidad.name', 'Especialidad');

        $this->grid->add('cmp', 'CMP');
        $this->grid->add('name', 'Nombre');
        $this->grid->add('nuevo', 'Nuevo?');
		$this->addStylesToGrid();

        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        // Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	
		$this->edit = \DataEdit::source(new \Enlace\Medico());

        $this->edit->label('Editar Médico');

        $this->edit->add('farmacia_id','Farmacia','select')->options(\Enlace\Farmacia::lists("name", "id")->all());

        $this->edit->add('especialidad_id','Especialidad','select')->options(\Enlace\Especialidad::lists("name", "id")->all());

        $this->edit->add('cmp', 'CMP', 'text')->rule('required');

		$this->edit->add('name', 'Nombre', 'text')->rule('required');

        $this->edit->add('nuevo', 'Nuevo', 'radiogroup')->option(true, 'Si')->option(false, 'No');

        $this->edit->add('description', 'Descripción', 'textarea');

        return $this->returnEditView();
    }    
}
