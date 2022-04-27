<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnidadesControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model("UnidadesModel");
    }

    public function index($idAsignacion)
	{
		$data['ListaUnidades']= $this->UnidadesModel->Listar($idAsignacion);
		$data['idAsignacion']= $idAsignacion;
		$data["materias"] = $this->UnidadesModel->ConsultaCombo("materiasniveles, materias where materiasniveles.idMateria = materias.idMateria and materiasniveles.idAsignacion = $idAsignacion",
		"materiasniveles.idAsignacion","concat(materias.materia,' ', materiasniveles.idGrado,'°')");
		$this->load->view('comun/header');
		$this->load->view('unidades/index', $data);
		$this->load->view('comun/footer');
	}

	public function insertar($idAsignacion){
		if($this->input->post()){
            if($this->UnidadesModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{

			$data["idAsignacion"] = $idAsignacion;
			$this->load->view('comun/header');
			$this->load->view('unidades/insetar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function editar($id, $idAsignacion){
		if($this->input->post()){
            if($this->UnidadesModel->actualizar($this->input->post(), $id)){
                //echo 'ok';
				$this->index($idAsignacion);
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
            $data["unidades"] = $this->UnidadesModel->Consultar($id);
            $data["id"] = $id;
			$data["idAsignacion"] = $idAsignacion;
			$this->load->view('comun/header');
			$this->load->view('unidades/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar(){
		if($this->input->post()){
			$this->UnidadesModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar(){
		if($this->input->post()){
			$data['ListaUnidades'] 	= $this->UnidadesModel->Buscar($this->input->post('nivel'),$this->input->post('materia'),$this->input->post('unidad'));
			$this->load->view('unidades/tabla_unidades', $data);
		}
	}
}