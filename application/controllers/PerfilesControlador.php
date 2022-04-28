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

	public function VerMisPlanificaciones(){}
}