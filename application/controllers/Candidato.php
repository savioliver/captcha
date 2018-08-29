<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidato extends CI_Controller 
{

	public function index()
	{
		$this->load->view('create');
	}
	
	public function add()
	{
		$this->load->model('CandidatosModel','candidatos');
		$data = $this->input->post();

		$ce = $data['g-recaptcha-response'];
		$ci = '6LfUpWsUAAAAAPCqNHmD0cAOeWBAfBE3snPrze0o';
		$url = 'https://www.google.com/recaptcha/api/siteverify';

		$dados_captcha = array(
			'secret' 	=> $ci,
			'response'	=> $ce
		);

		// Excluindo Coluna g-recaptcha-responde do Array de dados para Inserir os dados no Banco

		unset($data['g-recaptcha-response']);

		// Abrindo canal Curl

		$ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados_captcha);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $resposta = curl_exec($ch);
        curl_close($ch);

        $status = json_decode($resposta, true);

      	if ($status['success']) 
        {
        	$this->session->set_flashdata('info',"O usuário ".$data['nome']." foi cadastrado no sistema");
        	$this->candidatos->insert($data);	
        	redirect('candidato');
        }
        else
        {
        	$this->session->set_flashdata('info',"O usuário ".$data['nome']." é um robô");
        	redirect('candidato');	
        }

		print_r($data);
	}
}

