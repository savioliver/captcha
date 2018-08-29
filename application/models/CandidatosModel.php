<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CandidatosModel extends CI_Model 
{
	public function insert($dados)
	{
		$this->db->insert('candidato',$dados);
	}
}