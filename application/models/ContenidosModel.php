<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ContenidosModel extends CI_Model{
    private $nombreTabla = "contenidos";
    private $idTabla = "idContenido";

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

	public function Listar($idDetalleUnidad){
		$this->db->from('contenidos');
		return $this->db->query("SELECT unidades.idDetalleUnidad, contenidos.idContenido, contenidos.correlativo, contenidos.tema 
		from unidades, contenidos
		WHERE unidades.idDetalleUnidad = contenidos.idDetalleUnidad and contenidos.idDetalleUnidad = $idDetalleUnidad order by contenidos.correlativo");
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

}