<?php 

namespace Enlace\Http\Controllers;

use Enlace\Http\Requests;
use Enlace\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class ProductoController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        //Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields

		$producto = new \Enlace\Producto;
		$this->filter = \DataFilter::source($producto->newQuery()->with('familia','linea'));
		$this->filter->add('code', 'Código', 'text');
		$this->filter->add('name', 'Nombre', 'text');

		$this->filter->submit('Buscar');
		$this->filter->reset('resetear');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);

	    $this->grid->add('linea.name', 'Linea', false);
	    $this->grid->add('familia.name', 'Familia', false);
	    $this->grid->add('code', 'Código');
		$this->grid->add('name', 'Nombre');
		$this->grid->add('cantidad', 'Cant.');
		$this->grid->add('bonificacion', 'Bonificación');

		$this->addStylesToGrid();

                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        // Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	
		$this->edit = \DataEdit::source(new \Enlace\Producto());
		$this->edit->label('Editar Producto');

		$this->edit->add('linea_id','Linea','select')->options(\Enlace\Linea::lists("name", "id")->all());

		$this->edit->add('familia_id','Familia','select')->options(\Enlace\Familia::lists("name", "id")->all());


	    $this->edit->add('code', 'Código', 'text')->rule('required');

		$this->edit->add('name', 'Nombre', 'text')->rule('required');

	    $this->edit->add('description', 'Descripción', 'textarea');

		$this->edit->text('cantidad', 'Cantidad');

		$this->edit->text('bonificacion', 'Bonificación');


       
        return $this->returnEditView();
    }    
}
