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
	
	public function actualizar($datos,$id){
		$this->db->where($this->idTabla, $id);
		if($this->db->update($this->nombreTabla, $datos))
		    return true;
		else
		    return $this->db->error;
	}

	public function Listar(){
		$this->db->from("recursos");
		return $this->db->query('SELECT r.idRecurso, u.nombre, u.apellido, m.materia, uni.unidad, uni.nombreUnidad, c.correlativo, c.tema, r.recurso, r.tipo
		FROM recursos as r, plandetalles as pd, planificaciones as p, asignaciones as a, usuarios as u, contenidos as c, unidades as uni, materias as m
		WHERE r.idPlanDetalle = pd.idPlanDetalle AND pd.idPlanificacion = p.idPlanificacion AND p.idAsignacion = a.idAsignacion AND a.idUsuario = u.idUsuario AND pd.idContenido = c.idContenido AND c.idUnidad = uni.idUnidad AND uni.idMateria = m.idMateria');
	}

	public function Eliminar($id){
		$this->db->delete($this->nombreTabla, array($this->idTabla => $id));
	}

	public function Consultar($id){
		return $this->db->get_where($this->nombreTabla, array($this->idTabla => $id))->row();
	}

	public function Personalizado(){
		return $this->db->query('SELECT plandetalles.idPlanDetalle, planificaciones.idAsignacion, asignaciones.idUsuario, usuarios.nombre, materias.materia, unidades.unidad, unidades.nombreUnidad, contenidos.tema, DATE_FORMAT(plandetalles.ejecutado,"%d-%m-%Y") as "Ejecutado" FROM plandetalles, planificaciones, asignaciones, usuarios, contenidos, unidades, materias WHERE plandetalles.idContenido = contenidos.idContenido AND contenidos.idUnidad = unidades.idUnidad AND unidades.idMateria = materias.idMateria AND plandetalles.idPlanificacion = planificaciones.idPlanificacion AND planificaciones.idAsignacion = asignaciones.idAsignacion AND asignaciones.idUsuario = usuarios.idUsuario');
	}

	public function Contenidos(){
		return $this->db->query("SELECT * FROM recursos");
	}

	public function Buscar($criterio){
		$this->db->from($this->nombreTabla);
        $this->db->like("idRecurso", $criterio);
        $this->db->or_like("recurso", $criterio);
		return $this->db->get()->result();
	}
}