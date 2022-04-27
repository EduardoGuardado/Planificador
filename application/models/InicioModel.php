<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InicioModel extends CI_Model{
    private $tablas 	= ' usuarios, roles ';
    private $columnas 	= ' usuarios.idUsuario, usuarios.nombre, usuarios.apellido, usuarios.correo, usuarios.telefono, usuarios.usuario, usuarios.clave, roles.rol ';
	private $filtrado 	= ' usuarios.idRol = roles.idRol ';
	private $preciso 	= ' AND usuarios.usuario = ';

	public function ListarUsuarios($usuario){
		$this->db->select($this->columnas)->from($this->tablas)->where($this->filtrado.$this->preciso.'"'.$usuario.'"');
		return $this->db->get()->result();
	}
}