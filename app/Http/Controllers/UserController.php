<?php 

namespace Enlace\Http\Controllers;

use Enlace\Http\Requests;
use Enlace\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class UserController extends CrudController{

    public function all($entity){
        parent::all($entity);

		$usuario = new \Enlace\User();

        //Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields


		$this->filter = \DataFilter::source($usuario->newQuery()->with('farmacia'));
		$this->filter->add('name', 'Nombres', 'text');
		$this->filter->submit('Buscar');
		$this->filter->reset('resetear');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);
		$this->grid->add('farmacia.name', 'Farmacia');
		$this->grid->add('dni', 'DNI');
		$this->grid->add('name', 'Nombre');
		$this->grid->add('email', 'Correo');

		$this->addStylesToGrid();

        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        //Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	
		$this->edit = \DataEdit::source(new \Enlace\User());

		$password = $this->edit->model->password;

		$this->edit->label('Editar Usuario');

		$this->edit->add('farmacia_id','Farmacia','select')->options(\Enlace\Farmacia::lists("name", "id")->all());

		$this->edit->add('dni', 'DNI', 'text')->rule('required');
		$this->edit->add('name', 'Nombres', 'text')->rule('required');
		$this->edit->add('email', 'Correo', 'text')->rule('required');
		$this->edit->add('password', 'Contraseña', 'password');
		$edit = $this->edit;

		$this->edit->saved(function () use ($edit,$password) {
			if(Input::get('password') != '')
			{
				$edit->model->password = Hash::make(Input::get('password'));
				$edit->model->save();
			}else{
				$edit->model->password = $password;
				$edit->model->save();
			}
		});
       
        return $this->returnEditView();
    }    
}
