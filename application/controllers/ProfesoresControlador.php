<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfesoresControlador extends CI_Controller {
	private $Unombre;
	private $user;
	private $rol;

	function __construct(){
        parent::__construct();
        $this->load->model('ProfesoresModel');
		$this->load->library('session');
		
		$this->Unombre = $this->session->userdata('nombre');
		$this->user = $this->session->userdata('usuario');
		$this->rol = $this->session->userdata('rol');
    }

    public function index()
	{
		/* NO USADO */
	}

	public function Insertar(){
		if($this->input->post()){
			$nombre      = $this->input->post('nombre');
			$apellido    = $this->input->post('apellido');
			$correo      = $this->input->post('correo');
			$telefono    = $this->input->post('telefono');
			$usuario     = $this->input->post('usuario');
			$clave       = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);
			$idRol 		 = $this->input->post('idRol');

			$datos = [
				'nombre'      => $nombre,
				'apellido'    => $apellido,
				'correo'      => $correo,
				'telefono'    => $telefono,
				'usuario'     => $usuario,
				'clave'       => $clave,
				'idRol' 	  => $idRol
			];

            if($this->ProfesoresModel->Insertar($datos)){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al guardar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$data["verRol"] = $this->ProfesoresModel->VerRol();

			$this->load->view('comun/header', $data);
			$this->load->view('profesores/insertar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function Editar($id){
		if($this->input->post()){
			$idUsuario   = $this->input->post('idUsuario');
			$nombre      = $this->input->post('nombre');
			$apellido    = $this->input->post('apellido');
			$correo      = $this->input->post('correo');
			$telefono    = $this->input->post('telefono');
			$usuario     = $this->input->post('usuario');
			$clave       = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);
			$idRol 		 = $this->input->post('idRol');

			$datos = [
				'idUsuario'	=> $idUsuario,
				'nombre'	=> $nombre,
				'apellido'	=> $apellido,
				'correo'	=> $correo,
				'telefono'	=> $telefono,
				'usuario'	=> $usuario,
				'clave'		=> $clave,
				'idRol'		=> $idRol
			];
            if($this->ProfesoresModel->Actualizar($datos, $id)){
                echo 'ok';
            }else{
                echo '¡Ocurrió un error al actualizar sus datos, por favor intente de nuevo!';
            }
		}else{
			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

            $data["profesor"] = $this->ProfesoresModel->Buscar($id);
			$data["verRol"] = $this->ProfesoresModel->VerRol();
            $data["id"] = $id;

			$this->load->view('comun/header', $data);
			$this->load->view('profesores/editar', $data);
			$this->load->view('comun/footer');
		}
	}

	public function Eliminar(){
		if($this->input->post()){
			$this->ProfesoresModel->Eliminar($this->input->post('id'));
			echo 'ok';
		}else{
			echo 'error';
		}
	}

	public function Buscar(){
		if($this->input->post()){
			$data['ListaProfesores'] = $this->ProfesoresModel->Buscar($this->input->post('profesor'));

			$data['Unombre'] = $this->Unombre;
			$data['user'] = $this->user;
			$data['rol'] = $this->rol;

			$this->load->view('profesores/profesoresListado', $data);
		}
	}

	public function VerPlanificaciones($idProfesor){
		$data['Unombre'] = $this->Unombre;
		$data['user'] = $this->user;
		$data['rol'] = $this->rol;

		$data['ListaPlanificaciones'] = $this->ProfesoresModel->ListarPlanificaciones($idProfesor);
		$data['NombreProfesor'] = $this->ProfesoresModel->NombreProfesor($idProfesor);
		$data['Materias'] = $this->ProfesoresModel->ConsultarMaterias();
		$data['Secciones'] = $this->ProfesoresModel->ConsultarSecciones();
		$data['idProfesor'] = $idProfesor;

		$this->load->view('comun/header', $data);
		$this->load->view('planificaciones/index', $data);
		$this->load->view('comun/footer');
	}

	public function VerAsignaciones($idProfesor){
		$data['Unombre'] = $this->Unombre;
		$data['user'] = $this->user;
		$data['rol'] = $this->rol;
		
		$data['idProfesor'] = $idProfesor;

		$data['ListaAsignaciones']	= $this->ProfesoresModel->ListarAsignaciones($idProfesor);
		
		$this->load->view('comun/header', $data);
		$this->load->view('asignaciones/index', $data);
		$this->load->view('comun/footer');
	}
}
