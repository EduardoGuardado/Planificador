<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PlanDetallesModel extends CI_Model{
    private $nombreTabla = "plandetalles";
    private $idTabla = "idPlanDetalle";

	public function Insertar($datos)
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

	public function Eliminar($id){
		$this->db->delete($this->nombreTabla, array($this->idTabla => $id));
	}

	// FILTRADO DE DATOS PARA LA VISTA DE LA PLANIFICACIÓN
	public function Buscar($idPlanificacion, $idAsignacion, $anio, $tema, $fecha){
		$seleccion 	= " pd.idPlanDetalle, u.idUsuario, u.nombre, u.apellido, p.anio, DATE_FORMAT(pd.desde,'%d-%m-%Y') as desde, DATE_FORMAT(pd.hasta,'%d-%m-%Y') as hasta, m.idMateria, m.materia, uni.unidad, uni.nombreUnidad, c.correlativo, c.tema, DATE_FORMAT(pd.ejecutado,'%d-%m-%Y') as ejecutado ";
		$tablas 	= " plandetalles as pd, planificaciones as p, asignaciones as a, usuarios as u, contenidos as c, unidades as uni, materias as m ";
		$donde		= " pd.idPlanificacion = $idPlanificacion AND a.idAsignacion = $idAsignacion AND p.anio = $anio AND a.idUsuario = u.idUsuario AND p.idAsignacion = a.idAsignacion AND pd.idContenido = c.idContenido AND c.idUnidad = uni.idUnidad AND m.idMateria = uni.idMateria ";
		$bTema		= " AND c.tema = '$tema' ";
		$bFecha		= " AND pd.ejecutado = '$fecha' ";

		if($tema != ""){
			$this->db->select($seleccion)->from($tablas)->where($donde.$bTema);
			return $this->db->get()->result();

		}else if($fecha != ""){
			$this->db->select($seleccion)->from($tablas)->where($donde.$bFecha);
			return $this->db->get()->result();

		}else{
			$this->db->select($seleccion)->from($tablas)->where($donde);
			return $this->db->get()->result();
		}
	}
	
	public function Contenidos(){
		$this->db->select("contenidos.idContenido, materias.materia, unidades.unidad, unidades.nombreUnidad, contenidos.correlativo, contenidos.tema")
				->from("contenidos, unidades, materias")
				->where("contenidos.idUnidad = unidades.idUnidad AND unidades.idMateria = materias.idMateria");
		return $this->db->get()->result();
	}

	public function Consultar($idPlanDetalle){
		return $this->db->get_where($this->nombreTabla, array($this->idTabla => $idPlanDetalle))->row();
	}

	// ACCEDER AL LISTADO DE RECURSOS PEDIDOS EN EL DETALLE DE LA PLANIFICACIÓN
	/*public function Recursos($id){
		return $this->db->query("SELECT r.idRecurso, u.nombre, u.apellido, m.materia, uni.unidad, uni.nombreUnidad, c.correlativo, c.tema, r.recurso, r.tipo
		FROM recursos as r, plandetalles as pd, planificaciones as p, asignaciones as a, usuarios as u, contenidos as c, unidades as uni, materias as m
		WHERE r.idPlanDetalle = $id AND r.idPlanDetalle = pd.idPlanDetalle AND pd.idPlanificacion = p.idPlanificacion AND p.idAsignacion = a.idAsignacion AND a.idUsuario = u.idUsuario AND pd.idContenido = c.idContenido AND c.idUnidad = uni.idUnidad AND uni.idMateria = m.idMateria");
	}*/
}