<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PlanificacionesModel extends CI_Model{
    private $nombreTabla = "planificaciones";
    private $idTabla = "idPlanificacion";

	public function Insertar($datos)
	{
		if($this->db->insert($this->nombreTabla, $datos)){
            return $this->db->insert_id();
        }
		return false;
	}
	
	public function Actualizar($datos,$idPlanificacion){
		$this->db->where($this->idTabla, $idPlanificacion);
		if($this->db->update($this->nombreTabla, $datos))
		    return true;
		else
		    return $this->db->error;
	}

	public function Eliminar($id){
		$this->db->delete($this->nombreTabla, array($this->idTabla => $id));
	}

	// Busqueda específica
	public function Buscar($usuario, $materia, $seccion, $anio){
		// VARIABLES DE CONTROL 
		$selector = 'planificaciones.idPlanificacion, asignaciones.idAsignacion, materias.materia, grados.nivel, grados.tipo, grados.seccion, planificaciones.anio';
		$tablas = 'planificaciones, asignaciones, usuarios, materiasniveles, materias, grados';
		$donde = 'planificaciones.idAsignacion = asignaciones.idAsignacion AND asignaciones.idUsuario = usuarios.idUsuario AND asignaciones.idMateriaNivel = materiasniveles.idMateriaNivel AND materiasniveles.idMateria = materias.idMateria AND materiasniveles.idGrado = grados.idGrado AND usuarios.idUsuario = '.$usuario;
		$filtroMateria = ' AND materiasniveles.idMateria = '.$materia;
		$filtroSeccion = ' AND grados.seccion = "'.$seccion.'"';
		$filtroAnio = ' AND planificaciones.anio = '.$anio;

		// FILTRO PARA MATERIA
		if($materia > 0){
			$this->db->select($selector)->from($tablas)->where($donde.$filtroMateria);
			return $this->db->get()->result();

			// FILTRO PARA SECCIÓN
		}else if($seccion != "s"){
			$this->db->select($selector)->from($tablas)->where($donde.$filtroSeccion);
			return $this->db->get()->result();

			// FILTRO PARA AÑO
		}else if($anio > 0){
			$this->db->select($selector)->from($tablas)->where($donde.$filtroAnio);
			return $this->db->get()->result();

			// MOSTRAR TODO
		}else{
			$this->db->select($selector)->from($tablas)->where($donde);
			return $this->db->get()->result();
		}
		
	}

	public function Asignados($idProfesor){
		$this->db->select("asignaciones.idAsignacion, usuarios.idUsuario, usuarios.nombre, materias.materia, grados.nivel, grados.tipo")
				->from("asignaciones, usuarios, materiasniveles, materias, grados")
				->where("asignaciones.idUsuario = usuarios.idUsuario AND asignaciones.idMateriaNivel = materiasniveles.idMateriaNivel AND materiasniveles.idMateria = materias.idMateria AND materiasniveles.idGrado = grados.idGrado AND usuarios.idUsuario = $idProfesor");
		return $this->db->get()->result();
	}

	// ACCEDER AL LOS DATOS PEDIDOS EN LA PLANIFICACIÓN PARA MOSTRAR SU DETALLE
	public function Detalles($idPlanificacion, $idAsignacion, $anio){
		$this->db->select("pd.`idPlanDetalle`, u.idUsuario, u.nombre, u.apellido, p.anio, DATE_FORMAT(pd.`desde`,'%d-%m-%Y') as desde, DATE_FORMAT(pd.`hasta`,'%d-%m-%Y') as hasta, m.idMateria, m.materia, uni.unidad, uni.nombreUnidad, c.correlativo, c.tema, DATE_FORMAT(pd.`ejecutado`,'%d-%m-%Y') as ejecutado")
				->from("`plandetalles` as pd, `planificaciones` as p, `asignaciones` as a, `usuarios` as u, `contenidos` as c, `unidades` as uni, `materias` as m")
				->where("pd.idPlanificacion = $idPlanificacion AND a.idAsignacion = $idAsignacion AND p.anio = $anio AND a.idUsuario = u.idUsuario AND p.idAsignacion = a.idAsignacion AND pd.idContenido = c.idContenido AND c.idUnidad = uni.idUnidad AND m.idMateria = uni.idMateria");
		return $this->db->get()->result();
	}
}