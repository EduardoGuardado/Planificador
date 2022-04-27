<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GradoControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model("GradoModel");
    }

    public function index()
	{
		$data['ListaGrados']	= $this->GradoModel->Listar();
		$this->load->view('comun/header');
		$this->load->view('grado/index', $data);
		$this->load->view('comun/footer');
	}

	public function insertar(){
		if($this->input->post()){
            if($this->GradoModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$this->load->view('comun/header');
			$this->load->view('grado/insertar');
			$this->load->view('comun/footer');
		}
	}

	public function editar($id){
		if($this->input->post()){
            if($this->GradoModel->actualizar($this->input->post(), $id)){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
            $data["grado"] = $this->GradoModel->Consultar($id);
            $data["id"] = $id;

			$this->load->view('comun/header');
			$this->load->view('grado/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar(){
		if($this->input->post()){
			$this->GradoModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar(){
		if($this->input->post()){
			if($this->input->post('criterio')== "all")
				$data['Listagrados'] 	=  $this->GradoModel->Listar();
			else
				$data['Listagrados'] 	= $this->GradoModel->Buscar($this->input->post('criterio'));

			$this->load->view('grado/tabla_grados', $data);
		}
	}
}