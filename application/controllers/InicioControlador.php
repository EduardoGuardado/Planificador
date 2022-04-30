<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InicioControlador extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('InicioModel');
		$this->load->library('session');
    }
	
	public function index()
	{
		$this->load->view('inicio/index');
	}

	public function InicioSesion()
	{
		$usuario = $this->input->post('usuario');
		$clave = $this->input->post('clave');
		$datosProfesor = $this->InicioModel->LlamarProfesor($usuario);

		foreach ($datosProfesor as $p) {
			$prNombre	= $p->nombre;
			$prApellido	= $p->apellido;
			$prUsuario	= $p->usuario;
			$prRol		= $p->rol;
		}

		if (count($datosProfesor) > 0 && password_verify($clave, $datosProfesor[0]->clave)) {
			$datos = [
				"nombre" 		=> $prNombre,
				"apellido" 		=> $prApellido,
				"usuario" 		=> $prUsuario,
				"rol" 			=> $prRol,
				"logged_in" 	=> TRUE
			];

			$this->session->set_userdata($datos);

			return redirect(base_url()."index.php/InicioControlador/PerfilUsuario",'location',302);
		}else{
			return redirect(base_url(),'location',302);
		}
	}

	public function PerfilUsuario()
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

	public function CerrarSesion()
	{
		$this->session->sess_destroy();
		return redirect(base_url(),'location',302);
	}
}