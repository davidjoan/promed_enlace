<?php 

namespace Enlace\Http\Controllers;

use Enlace\Http\Requests;
use Enlace\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class UbigeoController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        // Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields


			$this->filter = \DataFilter::source(new \Enlace\Ubigeo);
			$this->filter->add('name', 'Distrito', 'text');
		$this->filter->add('province', 'Provincia', 'text');
		$this->filter->add('department', 'Departamento', 'text');
			$this->filter->submit('Buscar');
			$this->filter->reset('resetear');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
		$this->grid->add('code', 'Código');
		$this->grid->add('name', 'Distrito');
			$this->grid->add('province', 'Provincia');
		$this->grid->add('department', 'Departamento');

			$this->addStylesToGrid();

                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	
			$this->edit = \DataEdit::source(new \App\Category());

			$this->edit->label('Edit Category');

			$this->edit->add('name', 'Name', 'text');
		
			$this->edit->add('code', 'Code', 'text')->rule('required');


        */
       
        return $this->returnEditView();
    }    
}
