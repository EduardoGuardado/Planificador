<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ActividadesControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct(){
        parent::__construct();
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index($idProfesor = 0)
	{
		/** NO SE UTILIZA */
	}

	public function OtroMes()
	{
		if($this->input->post())
		{
            $siguiente = $this->input->post('siguiente');
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

            $data['siguiente'] = $siguiente;

			$this->load->view('calendario/actividades', $data);
		}
	}
}
