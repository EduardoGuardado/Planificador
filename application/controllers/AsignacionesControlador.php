<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AsignacionesControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model("AsignacionesModel");
		$this->load->library('session');
    }

    public function index($id = 0)
	{
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['user'] = $user;
		$data['rol'] = $rol;

		$data['ListaAsignaciones']	= $this->AsignacionesModel->Listar();
		$this->load->view('comun/header', $data);
		$this->load->view('asignaciones/index', $data);
		$this->load->view('comun/footer');
	}

	public function insertar(){
		if($this->input->post()){
            if($this->AsignacionesModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data["profesores"] = $this->AsignacionesModel->ConsultaCombo("usuarios","idUsuario","nombre");
			$data["materias"] = $this->AsignacionesModel->ConsultaCombo("materias","idMateria","materia");
			$data["grados"] = $this->AsignacionesModel->ConsultaCombo("grados","idGrado","nivel");
			$this->load->view('comun/header');
			$this->load->view('asignaciones/insertar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function editar($id){
		if($this->input->post()){
            if($this->AsignacionesModel->actualizar($this->input->post(), $id)){
                //echo 'ok';
				$this->index();
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
            $data["asignaciones"] = $this->AsignacionesModel->Consultar($id);
            $data["id"] = $id;
			
			$data["profesores"] = $this->AsignacionesModel->ConsultaCombo("usuarios","idUsuario","nombre");
			$data["materias"] = $this->AsignacionesModel->ConsultaCombo("materias","idMateria","materia");
			$data["grados"] = $this->AsignacionesModel->ConsultaCombo("grados","idGrado","nivel");

			$this->load->view('comun/header');
			$this->load->view('asignaciones/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar(){
		if($this->input->post()){
			$this->AsignacionesModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar(){
		if($this->input->post()){
			if($this->input->post('criterio')== "all")
				$data['ListaAsignaciones'] 	=  $this->AsignacionesModel->Listar();
			else
				$data['ListaAsignaciones'] 	= $this->AsignacionesModel->Buscar($this->input->post('criterio'));

			$this->load->view('asignaciones/tabla_asignaciones', $data);
		}
	}
}
