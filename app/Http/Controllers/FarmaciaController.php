<?php 

namespace Enlace\Http\Controllers;

use Enlace\Http\Requests;
use Enlace\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class FarmaciaController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        //Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields

		$farmacia = new \Enlace\Farmacia();
		$this->filter = \DataFilter::source($farmacia->newQuery()->with('tipo_farmacia'));
		$this->filter->add('name', 'Nombre', 'text');
		$this->filter->add('ruc', 'Ruc', 'text');
		$this->filter->submit('Buscar');
		$this->filter->reset('resetear');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);

		$this->grid->add('tipo_farmacia.name', 'Tipo Farmacia', false);
		$this->grid->add('code', 'Código');
		$this->grid->add('ruc', 'Ruc');
		$this->grid->add('name', 'Nombre');
		$this->addStylesToGrid();

        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        // Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	
		$this->edit = \DataEdit::source(new \Enlace\Farmacia());

		$this->edit->label('Editar Farmacia');

		$this->edit->add('tipo_farmacia_id','Tipo Farmacia','select')->options(\Enlace\TipoFarmacia::lists("name", "id")->all());

		$this->edit->add('code', 'Código', 'text')->rule('required');
		$this->edit->add('ruc', 'Ruc', 'text')->rule('required');
		$this->edit->add('name', 'Nombre', 'text')->rule('required');
		$this->edit->add('description', 'Descripción', 'textarea');


       
        return $this->returnEditView();
    }    
}
