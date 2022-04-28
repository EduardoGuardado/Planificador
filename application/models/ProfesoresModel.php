<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProfesoresModel extends CI_Model{
	private $idProfesor		= ' idUsuario ';
	private $idRol			= ' idRol ';
	private $rol			= ' rol ';
	private $tablaUsuarios	= ' usuarios ';
	private $tablaRoles		= ' roles ';
    private $columnas		= ' usuarios.idUsuario, usuarios.nombre, usuarios.apellido, usuarios.correo, usuarios.telefono, usuarios.usuario, usuarios.clave, roles.rol ';
	private $filtrado		= ' usuarios.idRol = roles.idRol ';

	public function Insertar($datos)
	{
		if($this->db->insert($this->tablaUsuarios, $datos)){
            return $this->db->insert_id();
        }
		return false;
	}
	
	public function Actualizar($datos,$id){
		$this->db->where($this->idProfesor, $id);
		if($this->db->update($this->tablaUsuarios, $datos))
		    return true;
		else
		    return $this->db->error;
	}

	public function Buscar($profesor){
		if($profesor > 0){
			$this->db->select($this->columnas)->from($this->tablaUsuarios.','.$this->tablaRoles)->where($this->filtrado)->like($this->idProfesor, $profesor);
			return $this->db->get()->result();
		}else{
			return $this->ListarProfesores();
		}
	}

	public function VerRol(){
		$this->db->select($this->idRol.','.$this->rol)->from($this->tablaRoles);
		return $this->db->get()->result();
	}

	public function ListarProfesores(){
		$this->db->select($this->columnas)->from($this->tablaUsuarios.','.$this->tablaRoles)->where($this->filtrado);
		return $this->db->get()->result();
	}

	public function ListarPlanificaciones($idProfesor){
		$this->db->select("planificaciones.idPlanificacion, asignaciones.idAsignacion, materias.materia, grados.nivel, grados.tipo, grados.seccion, planificaciones.anio")
				 ->from("planificaciones, asignaciones, usuarios, materiasniveles, materias, grados")
				 ->where("planificaciones.idAsignacion = asignaciones.idAsignacion AND asignaciones.idUsuario = usuarios.idUsuario AND asignaciones.idMateriaNivel = materiasniveles.idMateriaNivel
				 AND materiasniveles.idMateria = materias.idMateria AND materiasniveles.idGrado = grados.idGrado
				 AND usuarios.idUsuario = $idProfesor");
		return $this->db->get()->result();
	}

	public function NombreProfesor($idProfesor){
		$this->db->select("nombre, apellido")->from("usuarios")->where("usuarios.idUsuario = $idProfesor");
		return $this->db->get()->result();
	}

	public function ConsultarMaterias(){
		$this->db->select("idMateria, materia")->from("materias");
		return $this->db->get()->result();
	}

	public function ConsultarSecciones(){
		$this->db->select("seccion")->from("grados");
		return $this->db->get()->result();
	}
}