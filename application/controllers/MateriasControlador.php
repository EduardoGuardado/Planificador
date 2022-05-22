<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MateriasControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct(){
        parent::__construct();
        $this->load->model("MateriasModel");
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index()
	{
		/** NO SE UTILIZA */
	}

	public function insertar(){
		if($this->input->post()){
            if($this->MateriasModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$this->load->view('comun/header', $data);
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
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;
			
            $data["materia"] = $this->MateriasModel->Consultar($id);
            $data["id"] = $id;

			$data["elegir"] = $this->MateriasModel->ConsultaCombo();

			$this->load->view('comun/header', $data);
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
