<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MNDirControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model("MNDirModel");
    }


    public function index()
	{
		$data['ListaAsignaciones']	= $this->MNDirModel->Listar();
		$data["materias"] = $this->MNDirModel->ConsultaCombo("materias","idMateria","materia");
		$this->load->view('comun/header');
		$this->load->view('materianiveldir/index', $data);
		$this->load->view('comun/footer');
	}

	public function insertar(){
		if($this->input->post()){
            if($this->MNDirModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data["materias"] = $this->MNDirModel->ConsultaCombo("materias","idMateria","materia");
			$data["grados"] = $this->MNDirModel->ConsultaCombo("materiasniveles","idAsignacion","idGrado");
			$this->load->view('comun/header');
			$this->load->view('materianiveldir/insetar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function editar($id){
		if($this->input->post()){
            if($this->MNDirModel->actualizar($this->input->post(), $id)){
                //echo 'ok';
				$this->index();
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
            $data["asignaciones"] = $this->MNDirModel->Consultar($id);
            $data["id"] = $id;
			
			$data["materias"] = $this->MNDirModel->ConsultaCombo("materias","idMateria","materia");
			$data["grados"] = $this->input->post();

			$this->load->view('comun/header');
			$this->load->view('materianiveldir/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar(){
		if($this->input->post()){
			$this->MNDirModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar(){
		if($this->input->post()){
			$data['ListaAsignaciones'] 	= $this->MNDirModel->Buscar($this->input->post('nivel'),$this->input->post('materia'));
			/*if($this->input->post('criterio')== "all")
				$data['ListaAsignaciones'] 	=  $this->MNDirModel->Listar();
			else
				$data['ListaAsignaciones'] 	= $this->MNDirModel->Buscar($this->input->post('nivel'),$this->input->post('materia'));*/

			$this->load->view('materianiveldir/tabla_mn', $data);
		}
	}
}