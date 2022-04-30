<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AsignacionesModel extends CI_Model{
    private $nombreTabla = "asignaciones";
    private $idTabla = "idAsignacion";

	public function insertar($datos)
	{
		if($this->db->insert($this->nombreTabla, $datos)){
            return $this->db->insert_id();
        }
		return false;
	}
	
	public function actualizar($datos,$id){
		$this->db->where($this->idTabla, $id);
		if($this->db->update($this->nombreTabla, $datos))
		    return true;
		else
		    return $this->db->error;
	}

	public function Listar(){
		$this->db->from('asignaciones');
		return $this->db->query("SELECT asignaciones.idAsignacion, usuarios.nombre, materias.materia, grados.nivel FROM asignaciones, usuarios, materias, grados WHERE asignaciones.idUsuario = usuarios.idUsuario AND asignaciones.idMateria = materias.idMateria AND asignaciones.idGrado = grados.idGrado");
	}

	public function Eliminar($id){
		$this->db->delete($this->nombreTabla, array($this->idTabla => $id)); 
	}

	public function Consultar($id){
		return $this->db->get_where($this->nombreTabla, array($this->idTabla => $id))->row();
	}

	public function ConsultaCombo($tabla,$id,$nombre){
		return $this->db->query("SELECT $id as id, $nombre as nombre FROM $tabla");
	}

	public function Buscar($criterio){
		$this->db->from($this->nombreTabla);
        $this->db->like("idAsignacion", $criterio);
        $this->db->or_like("nombre", $criterio);
		return $this->db->get()->result();
	}
}