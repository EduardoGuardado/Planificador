<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlanificacionesControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('PlanificacionesModel');
		$this->load->library('session');
    }

    public function index($idProfesor = 0)
	{
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['user'] = $user;
		$data['rol'] = $rol;

		$data['ListaPlanificaciones'] = $this->ProfesoresModel->ListarPlanificaciones($idProfesor);
		$data["idProfesor"] = $idProfesor;

		$this->load->view('comun/header', $data);
		$this->load->view('planificaciones/index', $data);
		$this->load->view('comun/footer');
	}

	public function Insertar($idProfesor = 0){
		if($this->input->post()){
            if($this->PlanificacionesModel->Insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$user = $this->session->userdata('usuario');
			$rol = $this->session->userdata('rol');
			$data['user'] = $user;
			$data['rol'] = $rol;

			$data["asignados"] = $this->PlanificacionesModel->Asignados($idProfesor);
			$data["idProfesor"] = $idProfesor;
			
			$this->load->view('comun/header', $data);
			$this->load->view('planificaciones/insertar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function Editar($idPlanificacion, $idAsignacion, $anio, $idProfesor){
		if($this->input->post()){
            if($this->PlanificacionesModel->Actualizar($this->input->post(), $idPlanificacion)){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
			$user = $this->session->userdata('usuario');
			$rol = $this->session->userdata('rol');
			$data['user'] = $user;
			$data['rol'] = $rol;

			$data["asignados"] = $this->PlanificacionesModel->Asignados($idProfesor);
            $data["idPlanificacion"] = $idPlanificacion;
			$data["idAsignacion"] = $idAsignacion;
			$data["anio"] = $anio;
			$data["idProfesor"] = $idProfesor;

			$this->load->view('comun/header');
			$this->load->view('planificaciones/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function Eliminar(){
		if($this->input->post()){
			$this->PlanificacionesModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function Buscar($idProfesor){
		if($this->input->post()){
			$data['ListaPlanificaciones'] 	= $this->PlanificacionesModel->Buscar($this->input->post('profesor'), $this->input->post('materia'), $this->input->post('seccion'), $this->input->post('anio'));

			$user = $this->session->userdata('usuario');
			$rol = $this->session->userdata('rol');
			$data['user'] = $user;
			$data['rol'] = $rol;

			$data["idProfesor"] = $idProfesor;
			
			$this->load->view('planificaciones/panelPlanificaciones', $data);
		}
	}

	public function VerDetalles($idPlanificacion, $idAsignacion, $anio, $materia)
	{
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['user'] = $user;
		$data['rol'] = $rol;

		$data["idPlanificacion"] = $idPlanificacion;
		$data["idAsignacion"] = $idAsignacion;
		$data["anio"] = $anio;
		$data["ListaPlanDetalles"] = $this->PlanificacionesModel->Detalles($idPlanificacion, $idAsignacion, $anio);

		$data["materia"] = $materia;
	
		$this->load->view('comun/header', $data);
		$this->load->view('plandetalles/index', $data);
		$this->load->view('comun/footer');

	}
}
