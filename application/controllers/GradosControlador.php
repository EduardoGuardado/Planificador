<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GradosControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model("GradosModel");
		$this->load->library('session');
    }

    public function index()
	{
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['user'] = $user;
		$data['rol'] = $rol;

		$this->load->view('comun/header', $data);
		$this->load->view('grados/index', $data);
		$this->load->view('comun/footer');
	}

	public function insertar(){
		if($this->input->post()){
            if($this->GradosModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$this->load->view('comun/header');
			$this->load->view('grados/insertar');
			$this->load->view('comun/footer');
		}
	}

	public function editar($id){
		if($this->input->post()){
            if($this->GradosModel->actualizar($this->input->post(), $id)){
                $this->index();
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
            $data["grados"] = $this->GradosModel->Consultar($id);
            $data["id"] = $id;

			$this->load->view('comun/header');
			$this->load->view('grados/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar(){
		if($this->input->post()){
			$this->GradosModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar(){
		if($this->input->post()){
			if($this->input->post('criterio')== "all")
				$data['ListaGrados'] 	=  $this->GradosModel->Listar();
			else
				$data['ListaGrados'] 	= $this->GradosModel->Buscar($this->input->post('criterio'));

			$this->load->view('grados/tabla_grados', $data);
		}
	}

	public function VerMateriasAsignadas($idGrado, $nivel){
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['idGrado'] = $idGrado;
		$data['nivel'] = $nivel;
		$data['user'] = $user;
		$data['rol'] = $rol;

		$data['ListaAsignaciones']	= $this->GradosModel->ListarMateriaNivel($idGrado, $nivel);
		$data["materias"] = $this->GradosModel->Consulta("materias","idMateria","materia");
		$this->load->view('comun/header');
		$this->load->view('materianivel/index', $data);
		$this->load->view('comun/footer');
	}
}
