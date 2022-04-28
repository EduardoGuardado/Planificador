<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PlanDetallesControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('PlanDetallesModel');
		$this->load->library('session');
    }

    public function index($idPlanificacion = 0)
	{
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['user'] = $user;
		$data['rol'] = $rol;

		$data["ListaPlanDetalles"] = $this->PlanificacionesModel->Detalles($idPlanificacion);
		$data["idPlanificacion"] = $idPlanificacion;

		$this->load->view('comun/header', $data);
		$this->load->view('plandetalles/index', $data);
		$this->load->view('comun/footer');
	}

	public function Insertar($idPlanificacion = 0, $idAsignacion = 0, $anio = 0, $materia = ""){
		if($this->input->post()){
            if($this->PlanDetallesModel->Insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$user = $this->session->userdata('usuario');
			$rol = $this->session->userdata('rol');
			$data['user'] = $user;
			$data['rol'] = $rol;

			$data["contenido"] = $this->PlanDetallesModel->Contenidos();
			$data["idPlanificacion"] = $idPlanificacion;
			$data["idAsignacion"] = $idAsignacion;
			$data["anio"] = $anio;

			$data["materia"] = $materia;
			
			$this->load->view('comun/header', $data);
			$this->load->view('plandetalles/insertar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function Editar($idPlanDetalle = 0, $idPlanificacion = 0, $idAsignacion = 0, $anio = 0, $materia = ""){
		if($this->input->post()){
            if($this->PlanDetallesModel->actualizar($this->input->post(), $idPlanDetalle)){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
			$user = $this->session->userdata('usuario');
			$rol = $this->session->userdata('rol');
			$data['user'] = $user;
			$data['rol'] = $rol;

            $data["plandetalles"] = $this->PlanDetallesModel->Consultar($idPlanDetalle);
			$data["contenido"] = $this->PlanDetallesModel->Contenidos();
            $data["idPlanDetalle"] = $idPlanDetalle;
			
			$data["idPlanificacion"] = $idPlanificacion;
			$data["idAsignacion"] = $idAsignacion;
			$data["anio"] = $anio;
			$data["materia"] = $materia;

			$this->load->view('comun/header', $data);
			$this->load->view('plandetalles/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function Eliminar(){
		if($this->input->post()){
			$this->PlanDetallesModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function Buscar($idPlanificacion = 0, $idAsignacion = 0, $anio = 0, $materia = ""){
		if($this->input->post()){
			$data['ListaPlanDetalles'] 	= $this->PlanDetallesModel->Buscar($this->input->post('idPlanificacion'), $this->input->post('idAsignacion'), $this->input->post('anio'), $this->input->post('tema'), $this->input->post('fecha'));

			$user = $this->session->userdata('usuario');
			$rol = $this->session->userdata('rol');
			$data['user'] = $user;
			$data['rol'] = $rol;

			$data["idPlanificacion"] = $idPlanificacion;
			$data["idAsignacion"] = $idAsignacion;
			$data["anio"] = $anio;

			$data["materia"] = $materia;

			$this->load->view('plandetalles/panelPlandetalles', $data);
		}
	}

	/*public function recursos_asociados($id){
		$data["ListaRecursos"] = $this->PlanDetallesModel->Recursos($id);
		$data["id"] = $id;

		$this->load->view('comun/header');
		$this->load->view('recursos/index', $data);
		$this->load->view('comun/footer');
	}*/
}
