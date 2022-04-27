<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MNControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model("MNModel");
    }


    public function index()
	{
		$data['ListaAsignaciones']	= $this->MNModel->Listar();
		$data["materias"] = $this->MNModel->ConsultaCombo("materias","idMateria","materia");
		$this->load->view('comun/header');
		$this->load->view('materianivel/index', $data);
		$this->load->view('comun/footer');
	}

	public function insertar(){
		if($this->input->post()){
            if($this->MNModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data["materias"] = $this->MNModel->ConsultaCombo("materias","idMateria","materia");
			$data["grados"] = $this->MNModel->ConsultaCombo("materiasniveles","idAsignacion","idGrado");
			$this->load->view('comun/header');
			$this->load->view('materianivel/insetar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function editar($id){
		if($this->input->post()){
            if($this->MNModel->actualizar($this->input->post(), $id)){
                //echo 'ok';
				$this->index();
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
            $data["asignaciones"] = $this->MNModel->Consultar($id);
            $data["id"] = $id;
			
			$data["materias"] = $this->MNModel->ConsultaCombo("materias","idMateria","materia");
			$data["grados"] = $this->input->post();

			$this->load->view('comun/header');
			$this->load->view('materianivel/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar(){
		if($this->input->post()){
			$this->MNModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar(){
		if($this->input->post()){
			$data['ListaAsignaciones'] 	= $this->MNModel->Buscar($this->input->post('nivel'),$this->input->post('materia'));
			/*if($this->input->post('criterio')== "all")
				$data['ListaAsignaciones'] 	=  $this->MNModel->Listar();
			else
				$data['ListaAsignaciones'] 	= $this->MNModel->Buscar($this->input->post('nivel'),$this->input->post('materia'));*/

			$this->load->view('materianivel/tabla_mn', $data);
		}
	}
}