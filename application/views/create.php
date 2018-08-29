<h1>Cadastro de Candidato</h1>

<?php if ($this->session->flashdata('info')): ?>
	<?=$this->session->flashdata('info')?> 
<?php endif ?>

<form action="<?=base_url('candidato/add')?>" method="post">
	Matrícula <input type="number" name="matricula"><br /> 
	Nome <input type="text" name="nome"><br />	
	Endereço <input type="text" name="endereco"><br />	
	Telefone <input type="text" name="telefone"><br />	
	Email <input type="text" name="email"><br />	
	Objetivo profissional <input type="text" name="objetivo"><br />	

	<div class="g-recaptcha" data-sitekey="6LfUpWsUAAAAAHTjz0QVa3bvIbjEkLh6xhQ6kHW6"></div>
	<br>

	<input type="submit" value="Enviar dados">
</form>



<script type="text/javascript" src="<?=base_url('assets/js/api.js')?>"></script>