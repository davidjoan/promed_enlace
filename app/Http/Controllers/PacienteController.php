<?php 

namespace Enlace\Http\Controllers;

use Enlace\Http\Requests;
use Enlace\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class PacienteController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        // Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields

		$paciente = new \Enlace\Paciente;

		$this->filter = \DataFilter::source($paciente->newQuery()->with('ubigeo','farmacia'));
		$this->filter->add('name', 'Nombre', 'text');
		$this->filter->submit('Buscar');
		$this->filter->reset('resetear');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);

		$this->grid->add('farmacia.name', 'Registrado por');
		$this->grid->add('dni', 'DNI');
		$this->grid->add('name', 'Nombres');
		$this->grid->add('sexo', 'Sexo');
		$this->grid->add('direccion', 'Dirección');
		$this->grid->add('ubigeo.name', 'Distrito');
		$this->addStylesToGrid();

        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        //Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	
		$this->edit = \DataEdit::source(new \Enlace\Paciente());

		$this->edit->label('Editar Paciente');

		$this->edit->add('farmacia_id','Farmacia','select')->options(\Enlace\Farmacia::lists("name", "id")->all());

		$this->edit->add('dni', 'DNI', 'text')->rule('required');

		$this->edit->add('name', 'Nombres', 'text')->rule('required');

		$this->edit->add('edad', 'Edad', 'text');

		$this->edit->add('telefono', 'Teléfono', 'text');

		$this->edit->add('correo', 'Correo', 'text');

		$this->edit->add('sexo', 'Sexo', 'radiogroup')->option('F', 'Femenino')->option('M', 'Masculino');

		$this->edit->add('direccion', 'Dirección', 'textarea');

		$this->edit->add('ubigeo.name','Ubigeo','autocomplete')->search('name');

		$this->edit->add('nuevo', 'Nuevo', 'radiogroup')->option(true, 'Si')->option(false, 'No');

		$this->edit->add('receta', 'Receta', 'radiogroup')->option(true, 'Si')->option(false, 'No');

		//'farmacia_id','ubigeo_id','dni','name','sexo','edad','direccion','telefono','correo','nuevo','receta','description'
		

        return $this->returnEditView();
    }    
}
