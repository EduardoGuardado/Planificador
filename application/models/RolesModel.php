<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RolesModel extends CI_Model{
    private $nombreTabla = "roles";
    private $idTabla = "idRol";

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
		$this->db->from('roles');
		return $this->db->query("SELECT idRol, rol FROM roles");
	}

	public function Consultar($id){
		return $this->db->get_where($this->nombreTabla, array($this->idTabla => $id))->row();
	}

	public function Eliminar($id){
		$this->db->delete($this->nombreTabla, array($this->idTabla => $id)); 
	}

	public function Buscar($criterio){
		$this->db->from($this->nombreTabla);
        $this->db->like("idAsignacion", $criterio);
        $this->db->or_like("nombre", $criterio);
		return $this->db->get()->result();
	}
}