<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PerfilesControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct()
	{
        parent::__construct();
		$this->load->model('PerfilesModel');
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }
	
	public function index()
	{
		/* NO USAR */
	}

	public function VerProfesores(){
		
		if($this->rol == "Director"){
			$data['ListaProfesores'] = $this->PerfilesModel->ListarProfesores();
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$this->load->view('comun/header', $data);
			$this->load->view('profesores/index', $data);
			$this->load->view('comun/footer');
		}else{
			$this->load->view('noautorizado');
		}
		
	}

	public function VerMaterias()
	{
		if ($this->rol == "Director") {
			$data['ListaMaterias'] = $this->PerfilesModel->ConsultarMaterias();
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$this->load->view('comun/header', $data);
			$this->load->view('materias/index', $data);
			$this->load->view('comun/footer');
		}else{
			$this->load->view('noautorizado');
		}
	}

	public function VerGrados()
	{
		if ($this->rol == "Director") {
			$data['ListaGrados'] = $this->PerfilesModel->ConsultarGrados();
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$this->load->view('comun/header', $data);
			$this->load->view('grados/index', $data);
			$this->load->view('comun/footer');
		}else{
			$this->load->view('noautorizado');
		}
	}

	public function VerMateriasNivel()
	{
		if ($this->rol == "Director" || $this->rol == "Profesor") {
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;
	
			$data['ListaAsignaciones']	= $this->PerfilesModel->ListarMateriaNivel();
			$data["materias"] = $this->PerfilesModel->ConsultarMaterias();
			
			$this->load->view('comun/header', $data);
			$this->load->view('materianivel/index', $data);
			$this->load->view('comun/footer');
		}else{
			$this->load->view('noautorizado');
		}
	}

	public function VerMisPlanificaciones($idProfesor)
	{
		if ($this->rol == "Profesor" || $this->rol == "Director") {
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;
			
			$data['idProfesor'] = $idProfesor;
	
			$data['ListaPlanificaciones'] = $this->PerfilesModel->ListarPlanificaciones($idProfesor);
			$data['NombreProfesor'] = $this->PerfilesModel->NombreProfesor($idProfesor);
			$data['Materias'] = $this->PerfilesModel->ConsultarMaterias();
			$data['Secciones'] = $this->PerfilesModel->ConsultarSecciones();
			
			$this->load->view('comun/header', $data);
			$this->load->view('planificaciones/index', $data);
			$this->load->view('comun/footer');
		}else{
			$this->load->view('noautorizado');
		}
	}

	public function VerMisAsignaciones($idProfesor)
	{
		$data['Unombre'] = $this->Unombre;
		$data['user'] = $this->user;
		$data['rol'] = $this->rol;
		
		$data['idProfesor'] = $idProfesor;

		$data['ListaAsignaciones']	= $this->PerfilesModel->ListarAsignaciones($idProfesor);

		$this->load->view('comun/header', $data);
		$this->load->view('asignaciones/index', $data);
		$this->load->view('comun/footer');
	}

	public function VerMiCalendario($idProfesor){
		$data['Unombre'] = $this->Unombre;
		$data['user'] = $this->user;
		$data['rol'] = $this->rol;

		$data['planificadas'] = $this->PerfilesModel->BuscarPlanificacionFechada($idProfesor);

		$this->load->view('comun/header', $data);
		$this->load->view('calendario/index', $data);
		$this->load->view('comun/footer');
	}
}