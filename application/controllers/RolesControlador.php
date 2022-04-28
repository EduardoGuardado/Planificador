<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RolesControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model("RolesModel");
    }

    public function index()
	{
		$data['ListaRoles']	= $this->RolesModel->Listar();
		$this->load->view('comun/header');
		$this->load->view('roles/index', $data);
		$this->load->view('comun/footer');
	}

	public function insertar(){
		if($this->input->post()){
            if($this->RolesModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$this->load->view('comun/header');
			$this->load->view('roles/insertar');
			$this->load->view('comun/footer');
		}
	}

	public function editar($id){
		if($this->input->post()){
            if($this->RolesModel->actualizar($this->input->post(), $id)){
                //echo 'ok';
				$this->index();
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
            $data["ListaRoles"] = $this->RolesModel->Consultar($id);
            $data["id"] = $id;

			$this->load->view('comun/header');
			$this->load->view('roles/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar(){
		if($this->input->post()){
			$this->RolesModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar(){
		if($this->input->post()){
			if($this->input->post('criterio')== "all")
				$data['ListaRoles'] 	=  $this->RolesModel->Listar();
			else
				$data['ListaRoles'] 	= $this->RolesModel->Buscar($this->input->post('criterio'));

			$this->load->view('roles/tabla_roles', $data);
		}
	}
}
