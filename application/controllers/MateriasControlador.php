<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MateriasControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model("MateriasModel");
		$this->load->library('session');
    }

    public function index()
	{
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['ListaMaterias'] = $this->PerfilesModel->ConsultarMaterias();
		$data['user'] = $user;
		$data['rol'] = $rol;
		
		$this->load->view('comun/header');
		$this->load->view('materias/index', $data);
		$this->load->view('comun/footer');
	}

	public function insertar(){
		if($this->input->post()){
            if($this->MateriasModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$this->load->view('comun/header');
			$this->load->view('materias/insertar');
			$this->load->view('comun/footer');
		}
	}

	public function editar($id){
		if($this->input->post()){
            if($this->MateriasModel->actualizar($this->input->post(), $id)){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
            $data["materia"] = $this->MateriasModel->Consultar($id);
            $data["id"] = $id;

			$data["elegir"] = $this->MateriasModel->ConsultaCombo();

			$this->load->view('comun/header');
			$this->load->view('materias/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar(){
		if($this->input->post()){
			$this->MateriasModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar(){
		if($this->input->post()){
			if($this->input->post('criterio')== "all")
				$data['ListaMaterias'] 	=  $this->MateriasModel->Listar();
			else
				$data['ListaMaterias'] 	= $this->MateriasModel->Buscar($this->input->post('criterio'));

			$this->load->view('materias/tabla_materias', $data);
		}
	}
}
