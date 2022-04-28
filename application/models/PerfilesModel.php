<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PerfilesModel extends CI_Model{
    private $tablas 	= ' usuarios, roles ';
    private $columnas 	= ' usuarios.idUsuario, usuarios.nombre, usuarios.apellido, usuarios.correo, usuarios.telefono, usuarios.usuario, usuarios.clave, roles.rol ';
	private $filtrado 	= ' usuarios.idRol = roles.idRol ';

	public function ListarProfesores(){
		$this->db->select($this->columnas)->from($this->tablas)->where($this->filtrado);
		return $this->db->get()->result();
	}

}