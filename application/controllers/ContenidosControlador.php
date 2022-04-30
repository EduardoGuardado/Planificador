<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContenidosControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model("ContenidosModel");
		$this->load->library('session');
    }

    public function index($id = 0)
	{
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['user'] = $user;
		$data['rol'] = $rol;
		
		$this->load->view('comun/header', $data);
		$this->load->view('contenido/index', $data);
		$this->load->view('comun/footer');
	}

	public function insertar($idDetalleUnidad){
		if($this->input->post()){
            if($this->ContenidosModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['idDetalleUnidad']=$idDetalleUnidad;
			$this->load->view('comun/header');
			$this->load->view('contenido/insetar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function editar($id, $idDetalleUnidad){
		if($this->input->post()){
            if($this->ContenidosModel->actualizar($this->input->post(), $id)){
                //echo 'ok';
				$this->index($idDetalleUnidad);
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
            $data["contenido"] = $this->ContenidosModel->Consultar($id);
            $data["id"] = $id;
			$data['idDetalleUnidad']=$idDetalleUnidad;
			$this->load->view('comun/header');
			$this->load->view('contenido/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar(){
		if($this->input->post()){
			$this->ContenidosModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}
}