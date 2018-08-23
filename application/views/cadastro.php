
<h1>Cadastro de Usuário</h1>

<?php if (isset($info)): ?>
<?php print "<script type='text/javascript'>alert('$info')</script>";?>
<?php endif; ?>

<form action="<?=base_url('usuario/add')?>" method="POST">
	<input type="text" name="login" placeholder="Nome de usuário">
	<input type="password" name="senha" placeholder="Senha"> <br />
	<div class="g-recaptcha" data-sitekey="6LfUpWsUAAAAAHTjz0QVa3bvIbjEkLh6xhQ6kHW6"></div> <br />
	<input type="submit" value="Enviar dados">
</form>

<script src="<?=base_url('assets/js/api.js')?>"></script>