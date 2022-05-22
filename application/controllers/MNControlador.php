<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MNControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct(){
        parent::__construct();
        $this->load->model("MNModel");
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }


    public function index()
	{
		/** NO SE UTILIZA */
	}

	public function insertar(){
		if($this->input->post()){
            if($this->MNModel->insertar($this->input->post())){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$data["materias"] = $this->MNModel->ConsultaCombo("materias","idMateria","materia");
			$data["grados"] = $this->MNModel->ConsultaCombo("materiasniveles","idMateriaNivel","idGrado");
			$this->load->view('comun/header', $data);
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
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

            $data["asignaciones"] = $this->MNModel->Consultar($id);
            $data["id"] = $id;
			
			$data["materias"] = $this->MNModel->ConsultaCombo("materias","idMateria","materia");
			$data["grados"] = $this->input->post();

			$this->load->view('comun/header', $data);
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

	public function VerUnidades($idMateriaNivel)
	{
		$data['Unombre'] = $this->Unombre;
		$data['user'] = $this->user;
		$data['rol'] = $this->rol;

		$data['idMateriaNivel'] = $idMateriaNivel;

		$data['ListaUnidades']= $this->MNModel->ListarUnidades($idMateriaNivel);
		$data["materias"] = $this->MNModel->Consultas("materiasniveles, materias where materiasniveles.idMateria = materias.idMateria and materiasniveles.idMateriaNivel = $idMateriaNivel",
		"materiasniveles.idMateriaNivel","concat(materias.materia,' ', materiasniveles.idGrado,'°')");

		$this->load->view('comun/header', $data);
		$this->load->view('unidades/index', $data);
		$this->load->view('comun/footer');
	}
}