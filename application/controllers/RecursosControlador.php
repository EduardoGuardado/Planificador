<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecursosControlador extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('RecursosModel');
		$this->load->library('session');
    }

    public function index($idPlanDetalle)
	{
		$user = $this->session->userdata('usuario');
		$rol = $this->session->userdata('rol');
		$data['user'] = $user;
		$data['rol'] = $rol;

		$data["ListaRecursos"] = $this->PlanDetallesModel->Recursos($idPlanDetalle);
		$data["idPlanDetalle"] = $idPlanDetalle;

		$this->load->view('comun/header', $data);
		$this->load->view('recursos/index', $data);
		$this->load->view('comun/footer');
	}

	public function Insertar($idPlanDetalle = 0){
		if($this->input->post()){
			if($this->input->post() && $_FILES){
				$id = $this->input->post('idPlanDetalle');
				$tipo = $this->input->post('tipo');

				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = '*';

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if($this->upload->do_upload($this->input->post('recurso'))){
					$fileData = $this->upload->data();
					$uploadData['file_name'] = $fileData['file_name'];

					$dato = [
						'idPlandetalle' => $id,
						'recurso'		=> $uploadData,
						'tipo'			=> $tipo
					];

					if($this->RecursosModel->Insertar($dato)){
						echo 'ok';
					}else{
						echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
					}
				}
			}else{
				if($this->RecursosModel->Insertar($this->input->post())){
					echo 'ok';
				}else{
					echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
				}
			}
		}else{
			$user = $this->session->userdata('usuario');
			$rol = $this->session->userdata('rol');
			$data['user'] = $user;
			$data['rol'] = $rol;

			$data["idPlanDetalle"] = $idPlanDetalle;
			
			$this->load->view('comun/header', $data);
			$this->load->view('recursos/insertar', $data);
			$this->load->view('comun/footer');
		}
	}
	
	public function cargar_archivo() {
		//Ruta donde se guardan los ficheros
		$config['upload_path'] = './uploads/';
	
		//Tipos de ficheros permitidos
		$config['allowed_types'] = '*';
			
		//Se pueden configurar aun mas parámetros.
		//Cargamos la librería de subida y le pasamos la configuración
		$this->load->library('upload', $config);

		if(!$this->upload->do_upload()){
			/*Si al subirse hay algún error lo meto en un array para pasárselo a la vista*/
			$error=array('error' => base_url().'uploads/'.$this->upload->display_errors());
		}else{
			//Datos del fichero subido
			$datos["img"]=$this->upload->data();

			// Podemos acceder a todas las propiedades del fichero subido
			// $datos["img"]["file_name"]);

			//Cargamos la vista y le pasamos los datos
		// $this->load->view('subir_view', $datos);
		}
    }

	/*public function editar($id){
		if($this->input->post()){
            if($this->RecursosModel->actualizar($this->input->post(), $id)){
                //echo 'ok';
				$this->index();
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
            $data["recursos"] = $this->RecursosModel->Consultar($id);
            $data["id"] = $id;

			$data["especificar"] = $this->RecursosModel->Personalizado();

			$this->load->view('comun/header');
			$this->load->view('recursos/editar', $data);
			$this->load->view('comun/footer');
		}
	}*/

	public function eliminar(){
		if($this->input->post()){
			$this->RecursosModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function buscar(){
		if($this->input->post()){
			if($this->input->post('criterio')== "all")
				$data['ListaRecursos'] 	=  $this->RecursosModel->Listar();
			else
				$data['ListaRecursos'] 	= $this->RecursosModel->Buscar($this->input->post('criterio'));

			$this->load->view('recursos/tabla_recursos', $data);
		}
	}
}
