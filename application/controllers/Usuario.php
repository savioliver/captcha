<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller 
{

	public function index()
	{
		$data = array(
			'info' => $this->session->flashdata('info')
		);

		$this->load->view('cadastro', $data);
	}

	public function add()
	{
		$this->load->model('UsuarioModel','usuarios');

		// Recuperar dados do Usuário
		$dados_usuario = array(
			'login' => $this->input->post('login'),
			'senha'	=> $this->input->post('senha')
		);

        // Recuperar resposta do Captcha
      	$ca = $this->input->post('g-recaptcha-response');

        // Recuperar Key Interna
        $secret = '6LfUpWsUAAAAAPCqNHmD0cAOeWBAfBE3snPrze0o';

        // Recuperar JSON da requisição
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        // Recuperar dados do Captcha
        $dados_captcha = array(
            'secret'    => $secret,
            'response'  => $ca
        );

        // Enviar dados recebido para a API do cpatcha a partir de um Canal iniciado pela biblioteca CURL do PHP
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados_captcha);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $resposta = curl_exec($ch);
        curl_close($ch);

        // Após enviar os dados ele encerra o canal e espera a resposta via JSON

        $status = json_decode($resposta, true);

        if ($status['success']) 
        {
        	$this->session->set_flashdata('info',"O usuário ".$dados_usuario['login']." foi cadastrado no sistema");
        	$this->usuarios->insert($dados_usuario);	
        	redirect('usuario');
        }
        else
        {
        	$this->session->set_flashdata('info',"O usuário ".$dados_usuario['login']." é um robô");
        	redirect('usuario');	
        }
	}
}
