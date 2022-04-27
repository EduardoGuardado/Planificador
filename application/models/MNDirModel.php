<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MNDirModel extends CI_Model{
    private $nombreTabla = "materiasniveles";
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
		$this->db->from('materiasniveles');
		return $this->db->query("SELECT materiasniveles.idAsignacion, materiasniveles.idMateria, materias.materia, materiasniveles.idGrado
		FROM materiasniveles, materias WHERE materiasniveles.idMateria = materias.idMateria order by materiasniveles.idGrado");
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

	public function Buscar($nivel,$materia){
		if($nivel==0){
			if($materia==0){
				return $this->db->query("SELECT materiasniveles.idAsignacion, materias.materia, materiasniveles.idGrado FROM materiasniveles, materias WHERE materiasniveles.idMateria = materias.idMateria");
			}else{
				return $this->db->query("SELECT materiasniveles.idAsignacion, materias.materia, materiasniveles.idGrado FROM materiasniveles, materias WHERE materiasniveles.idMateria = materias.idMateria and materiasniveles.idMateria=$materia");
			}
		}else{
			if($materia==0){
				return $this->db->query("SELECT materiasniveles.idAsignacion, materias.materia, materiasniveles.idGrado FROM materiasniveles, materias WHERE materiasniveles.idMateria = materias.idMateria and materiasniveles.idGrado = $nivel");
			}else{
				return $this->db->query("SELECT materiasniveles.idAsignacion, materias.materia, materiasniveles.idGrado FROM materiasniveles, materias WHERE materiasniveles.idMateria = materias.idMateria and materiasniveles.idMateria=$materia and materiasniveles.idGrado = $nivel");				
			}
		}
	}
}