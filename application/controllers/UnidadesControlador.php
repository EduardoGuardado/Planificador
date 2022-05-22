<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UnidadesControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct(){
        parent::__construct();
        $this->load->model("UnidadesModel");
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index($id = 0)
	{
		/** NO SE UTILIZA */
	}

	public function insertar($idAsignacion)
	{
		if($this->input->post())
		{
            if($this->UnidadesModel->insertar($this->input->post()))
			{
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$data["idAsignacion"] = $idAsignacion;
			$this->load->view('comun/header', $data);
			$this->load->view('unidades/insetar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function editar($id, $idAsignacion)
	{
		if($this->input->post())
		{
            if($this->UnidadesModel->actualizar($this->input->post(), $id))
			{
                //echo 'ok';
				$this->index($idAsignacion);
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

            $data["unidades"] = $this->UnidadesModel->Consultar($id);
            $data["id"] = $id;
			$data["idAsignacion"] = $idAsignacion;

			$this->load->view('comun/header', $data);
			$this->load->view('unidades/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function eliminar()
	{
		if($this->input->post())
		{
			$this->UnidadesModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar()
	{
		if($this->input->post())
		{
			$data['ListaUnidades'] 	= $this->UnidadesModel->Buscar($this->input->post('nivel'),$this->input->post('materia'),$this->input->post('unidad'));
			$this->load->view('unidades/tabla_unidades', $data);
		}
	}

	public function VerContenidos($idUnidad)
	{
		$data['Unombre'] = $this->Unombre;
		$data['user'] = $this->user;
		$data['rol'] = $this->rol;

		$data['idUnidad'] = $idUnidad;

		$data['ListaContenido']	= $this->UnidadesModel->ListarContenidos($idUnidad);
		$data["materias"] = $this->UnidadesModel->ConsultaCombo("unidades, materiasniveles WHERE materiasniveles.idMateriaNivel = unidades.idMateriaNivel and unidades.idUnidad = $idUnidad",
		"unidades.idMateriaNivel",
		"concat('Unidad #',unidades.unidad,' ',unidades.nombreUnidad)");
		
		$this->load->view('comun/header', $data);
		$this->load->view('contenido/index', $data);
		$this->load->view('comun/footer');
	}
}