<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilesControlador extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->model('PerfilesModel');
		$this->load->library('session');
    }
	
	public function index()
	{
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['profesor'] = $this->InicioModel->LlamarProfesor($user);
		$data['user'] = $user;
		$data['rol'] = $rol;
		
		$this->load->view('comun/header', $data);
		$this->load->view('perfiles/index', $data);
		$this->load->view('comun/footer');
	}

	public function VerProfesores(){
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['ListaProfesores'] = $this->PerfilesModel->ListarProfesores();
		$data['user'] = $user;
		$data['rol'] = $rol;

		$this->load->view('comun/header', $data);
		$this->load->view('profesores/index', $data);
		$this->load->view('comun/footer');
	}

	public function VerMaterias(){
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['ListaMaterias'] = $this->PerfilesModel->ConsultarMaterias();
		$data['user'] = $user;
		$data['rol'] = $rol;

		$this->load->view('comun/header', $data);
		$this->load->view('materias/index', $data);
		$this->load->view('comun/footer');
	}

	public function VerGrados(){
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['ListaGrados'] = $this->PerfilesModel->ConsultarGrados();
		$data['user'] = $user;
		$data['rol'] = $rol;

		$this->load->view('comun/header', $data);
		$this->load->view('grados/index', $data);
		$this->load->view('comun/footer');
	}

	public function VerMisPlanificaciones($idProfesor){
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['idProfesor'] = $idProfesor;
		$data['user'] = $user;
		$data['rol'] = $rol;

		$data['ListaPlanificaciones'] = $this->PerfilesModel->ListarPlanificaciones($idProfesor);
		$data['NombreProfesor'] = $this->PerfilesModel->NombreProfesor($idProfesor);
		$data['Materias'] = $this->PerfilesModel->ConsultarMaterias();
		$data['Secciones'] = $this->PerfilesModel->ConsultarSecciones();
		
		$this->load->view('comun/header', $data);
		$this->load->view('planificaciones/index', $data);
		$this->load->view('comun/footer');
	}

	public function VerMisAsignaciones($idProfesor){
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['idProfesor'] = $idProfesor;
		$data['user'] = $user;
		$data['rol'] = $rol;

		$data['ListaAsignaciones']	= $this->PerfilesModel->ListarAsignaciones($idProfesor);

		$this->load->view('comun/header', $data);
		$this->load->view('asignaciones/index', $data);
		$this->load->view('comun/footer');
	}

	public function VerMiCalendario(){}
}