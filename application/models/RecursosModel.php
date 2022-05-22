<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RecursosModel extends CI_Model{
    private $nombreTabla = "recursos";
    private $idTabla = "idRecurso";

	public function insertar($datos)
	{
		if($this->db->Insert($this->nombreTabla, $datos)){
            return $this->db->insert_id();
        }
		return false;
	}

	public function Eliminar($id){
		$this->db->delete($this->nombreTabla, array($this->idTabla => $id));
	}
}