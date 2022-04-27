<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class GradoModel extends CI_Model{
    private $nombreTabla = "grados";
    private $idTabla = "idGrado";

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
		$this->db->from('grados');
		return $this->db->get()->result();
	}

	public function Eliminar($id){
		$this->db->delete($this->nombreTabla, array($this->idTabla => $id)); 
	}

	public function Consultar($id){
		return $this->db->get_where($this->nombreTabla, array($this->idTabla => $id))->row();
	}

	public function Buscar($criterio){
		$this->db->from($this->nombreTabla);
        $this->db->like("nivel", $criterio);
        $this->db->or_like("tipo", $criterio);
		$this->db->or_like("seccion", $criterio);
		return $this->db->get()->result();
	}
}