<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioModel extends CI_Model
{
	public function insert($dados)
	{
		$this->db->insert('usuario',$dados);
	}
}