<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContenidosControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model("ContenidosModel");
    }

    public function index($idDetalleUnidad)
	{
		$data['ListaContenido']	= $this->ContenidosModel->Listar($idDetalleUnidad);
		$data['idDetalleUnidad']=$idDetalleUnidad;
		$data["materias"] = $this->ContenidosModel->ConsultaCombo("unidades, materiasniveles WHERE materiasniveles.idAsignacion = unidades.idAsignacion and unidades.idDetalleUnidad = $idDetalleUnidad",
		"unidades.idAsignacion",
		"concat('Unidad #',unidades.unidad,' ',unidades.nombreUnidad)");
		$this->load->view('comun/header');
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