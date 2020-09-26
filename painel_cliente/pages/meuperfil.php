<div class="perfil-container">
	<div class="mensagem">
		<div class="mensagem-viws">
	<?php 
		if(isset($_POST['acao'])){

		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$email = $_POST['email'];
		$cep = $_POST['cep'];
		$estado = $_POST['estado'];
		$cidade = $_POST['cidade'];
		$bairro = $_POST['bairro'];
		$complemento = $_POST['complemento'];
		$numero = $_POST['numero'];
		$cliente = new Consumido();
		if($cliente->atualizarConsumido($nome,$sobrenome,$email,$cep,$estado,$cidade,$bairro,$complemento,$numero)){
			Painel::alert('sucesso','Atualizado com sucesso!');
		}else{
			Painel::alert('erro','Ocorreu um erro ao atualizar...');
		}
	}
	?>
		</div>
		</div>
	<?php
	$consumido = MySql::conectar()->prepare("SELECT * FROM `tb_admin.consumido`");
	$consumido->execute();
	$consumido = $consumido->fetchAll();
	foreach ($consumido as $key => $value) {
		if($_SESSION['id_usuario'] == $value['id']){
		?>

		<h1> Informações da conta</h1>
		<form method="post">
<div class="info-cliente">
	 <label>Nome:</label>
	 <input type="text" name="nome" value="<?php echo $value['nome']; ?>"> 
 </div>
 <div class="info-cliente">
	 <label>Sobrenome:</label>
	 <input type="text" name="sobrenome" value="<?php echo $value['sobrenome']; ?>">
 </div>
 <div class="info-cliente">  
	 <label>Email:</label>
	 <input type="email" name="email" value="<?php echo $value['email']; ?>"> 
 </div>
 <div class="info-cliente"> 
	 <label>CPF:</label>
	 <input type="text" name="cpf" value="<?php echo $value['cpf']; ?>" disabled>  
 </div>
 <div class="info-cliente"> 
	 <label>CEP:</label>
	 <input type="text" name="cep" value="<?php echo $value['cep']; ?>">  
 </div>
 <div class="info-cliente"> 
	 <label>Estado:</label>
	 <input type="text" name="estado" value="<?php echo $value['estado']; ?>">  
 </div>
 <div class="info-cliente"> 
	 <label>Cidade:</label>
	 <input type="text" name="cidade" value="<?php echo $value['cidade']; ?>">  
 </div>
 <div class="info-cliente"> 
	 <label>Bairro:</label>
	 <input type="text" name="bairro" value="<?php echo $value['bairro']; ?>">  
 </div>
  <div class="info-cliente"> 
	 <label>Bairro:</label>
	 <input type="text" name="complemento" value="<?php echo $value['complemento']; ?>">  
 </div>
 <div class="info-cliente"> 
	 <label>Numero:</label>
	 <input type="text" name="numero" value="<?php echo $value['numero']; ?>">  
 </div>
 <div class="center">
 	<input type="submit" name="acao" value="Salvar">
 </div>
 </form>
 <?php	
		}
	}
 ?>
  <div class="clear"></div>
 </div>
