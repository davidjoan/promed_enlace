<?php 

namespace Enlace\Http\Controllers;

use Enlace\Http\Requests;
use Enlace\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class VentaController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        // Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields

		$venta = new \Enlace\Venta;

        $this->filter = \DataFilter::source($venta->newQuery()->with('medico','paciente','periodo','producto'));
		$this->filter->add('fecha','Fecha Venta','daterange')->format('m/d/Y', 'es');
        $this->filter->add('periodo_id','Periodo','select')->options(\Enlace\Periodo::lists("name", "id")->all());
		$this->filter->submit('Buscar');
		$this->filter->reset('resetear');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);

        $this->grid->add('medico.name', 'Médico');
        $this->grid->add('paciente.name', 'Paciente');
        $this->grid->add('periodo.name', 'Periodo');
        $this->grid->add('producto.name', 'Producto');
		$this->grid->add('fecha', 'Fecha');
		$this->grid->add('codigo', 'Código');
        $this->grid->add('cantidad', 'Cantidad');
        $this->grid->add('bonificacion', 'Bon.');
        $this->grid->add('fraccion', 'Fracción');
        $this->grid->add('receta', 'Receta');

		$this->addStylesToGrid();

                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        // Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields

        //['user_id','medico_id','paciente_id','periodo_id','producto_id',
        //'fecha','codigo','cantidad','bonificacion','fraccion','description','receta'];


        $this->edit = \DataEdit::source(new \Enlace\Venta());

		$this->edit->label('Editar Venta');

        $this->edit->add('user_id','Usuario','select')->options(\Enlace\User::lists("name", "id")->all());
        $this->edit->add('medico.name','Médico','autocomplete')->search('name');
        $this->edit->add('paciente.name','Paciente','autocomplete')->search('name');
        $this->edit->add('periodo_id','Periodo','select')->options(\Enlace\Periodo::lists("name", "id")->all());
        $this->edit->add('producto.name','Producto','autocomplete')->search('name');

        $this->edit->add('fecha', 'Fecha', 'date')->format('d/m/Y', 'es');
		$this->edit->add('codigo', 'Código Factura/Boleta', 'text')->rule('required');
        $this->edit->add('cantidad', 'Cantidad', 'text')->rule('required');
        $this->edit->add('bonificacion', 'Bonificación', 'text')->rule('required');
        $this->edit->add('fraccion', 'Fracción', 'text')->rule('required');
        $this->edit->add('description', 'Detalle', 'textarea');
        $this->edit->add('receta', 'Receta', 'radiogroup')->option(true, 'Si')->option(false, 'No');


       
        return $this->returnEditView();
    }    
}
