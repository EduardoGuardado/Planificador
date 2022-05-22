<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecursosControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct()
	{
        parent::__construct();
        $this->load->model('RecursosModel');
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index($idPlanDetalle = 0)
	{
		/** NO SE UTILIZA */
	}

	public function Insertar($idPlanDetalle = 0)
	{
		if($this->input->post())
		{
			if($_FILES){
				$id = $this->input->post('idPlanDetalle');
				$tipo = $this->input->post('tipo');

				$directorio = 'uploads/';
				$subir_archivo = $directorio.basename($_FILES['recurso']['name']);
				
				if (move_uploaded_file($_FILES['recurso']['tmp_name'], $subir_archivo)) {
					$dato = [
						'idPlandetalle' => $id,
						'recurso'		=> $subir_archivo,
						'tipo'			=> $tipo
					];

					if($this->RecursosModel->Insertar($dato)){
						echo 'ok';
						return redirect(base_url()."index.php/PlanDetallesControlador/VerRecursos/$id",'location',302);
					}else{
						echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
					}

					echo "El archivo es válido y se cargó correctamente.<br><br>";
				} else {
					echo "La subida ha fallado";
				}
			}else{
				$id = $this->input->post('idPlanDetalle');
				if($this->RecursosModel->Insertar($this->input->post())){
					echo 'ok';
					return redirect(base_url()."index.php/PlanDetallesControlador/VerRecursos/$id",'location',302);
				}else{
					echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
				}
			}
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$data["idPlanDetalle"] = $idPlanDetalle;
			
			$this->load->view('comun/header', $data);
			$this->load->view('recursos/insertar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function Descargar($nombreArchivo, $ruta){
		$fileName = basename($nombreArchivo);
		$filePath = $ruta;
		if(!empty($fileName) && file_exists($filePath)){
			// Define headers
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Disposition: attachment; filename=$fileName");
			header("Content-Type: application/zip");
			header("Content-Transfer-Encoding: binary");
			
			// Read the file
			readfile($filePath);
			exit;
		}else{
			echo 'The file does not exist.';
		}
	}

	public function eliminar()
	{
		if($this->input->post())
		{
			$this->RecursosModel->Eliminar($this->input->post('id'));
			If (unlink($this->input->post('URl'))) {
				// file was successfully deleted
			  } else {
				// there was a problem deleting the file
			  }
			echo 'ok';
		}else{
			echo 'error';
		}
	}
}
