<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PerfilesModel extends CI_Model{
    private $tablas 	= ' usuarios, roles ';
    private $columnas 	= ' usuarios.idUsuario, usuarios.nombre, usuarios.apellido, usuarios.correo, usuarios.telefono, usuarios.usuario, usuarios.clave, roles.rol ';
	private $filtrado 	= ' usuarios.idRol = roles.idRol ';

	public function ListarProfesores(){
		$this->db->select($this->columnas)->from($this->tablas)->where($this->filtrado);
		return $this->db->get()->result();
	}

	public function NombreProfesor($idProfesor){
		$this->db->select("nombre, apellido")->from("usuarios")->where("usuarios.idUsuario = $idProfesor");
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

	public function ConsultarMaterias(){
		$this->db->select("idMateria, materia")->from("materias");
		return $this->db->get()->result();
	}

	public function ConsultarSecciones(){
		$this->db->select("seccion")->from("grados");
		return $this->db->get()->result();
	}

	public function ConsultarGrados(){
		$this->db->select("idGrado, nivel, tipo, seccion")->from('grados');
		return $this->db->get()->result();
	}

	public function ListarAsignaciones($idProfesor){
		$this->db->from('asignaciones');
		return $this->db->query("SELECT asignaciones.idAsignacion, usuarios.nombre, materias.materia, grados.nivel 
		FROM asignaciones, usuarios, materiasniveles, materias, grados 
		WHERE asignaciones.idUsuario = usuarios.idUsuario AND asignaciones.idMateriaNivel = materiasniveles.idMateriaNivel AND materiasniveles.idMateria = materias.idMateria AND materiasniveles.idGrado = grados.idGrado AND usuarios.idUsuario = $idProfesor");
	}
}