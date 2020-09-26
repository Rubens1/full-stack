<?php 
	$id = $par[1];
	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimento` WHERE id = ?");
	$sql->execute(array($id));

	$infoEmpreend = $sql->fetch();

	if($infoEmpreend['nome'] == ''){
		header('Location: '.INCLUDE_PATH_PAINEL_COLABORADO);
		die();
	}

 ?>
<div class="box-content">
	<h2>Mais sobre o empreendimento <?php echo $infoEmpreend['nome']; ?></h2>
	<div class="info-item">
		<div class="row1">
			<div class="card-title">Imagem do empreendimento:</div>
			<img src="<?php echo INCLUDE_PATH_PAINEL_LOJA?>uploads/<?php echo $infoEmpreend['imagem']?>">
		</div>
		<div class="row2">
			<div class="card-title">informações do empreendimento</div>
			<p>Nome do empreendimento: <?php echo $infoEmpreend['nome'] ?></p>
			<p>Tipo do empreendimento: <?php echo ucfirst($infoEmpreend['tipo']) ?></p>
		</div>
		<div class="clear"></div>
	</div>

	<div class="card-title">Cadastrar Imóveil</div>
	<form method="post" enctype="multipart/form-data">
		<?php
			if(isset($_POST['acao'])){
				$empreendimento = $id;
				$nome = $_POST['nome'];
				$preco = Painel::formatarMoedaBd($_POST['preco']);
				$area = $_POST['area'];


				$imagens = array();
				$amountFiles = count($_FILES['imagens']['name']);

				$sucesso = true;

				if($_FILES['imagens']['name'][0] != ''){
				for($i = 0; $i < $amountFiles; $i++){
					$imagemAtual = ['type'=>$_FILES['imagens']['type'][$i], 'size'=>$_FILES['imagens']['size'][$i]];
					if(Painel::imagemValida($imagemAtual) == false){
						$sucesso = false;
						Painel::alert('erro','Uma das imagem selecionadas são invalidas!');
						break;
						}
					}
				}else{
					$sucesso = false;
					Painel::alert('erro','Você precisa selecionar pelo menos uma imagem!');
				}

				if($sucesso){
					for($i = 0; $i < $amountFiles; $i++){
						$imagemAtual = ['tmp_name'=>$_FILES['imagens']['tmp_name'][$i], 'name'=>$_FILES['imagens']['name'][$i]];
					$imagens[] = Painel::uploadFile($imagemAtual);
					}
					$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.imoveis` VALUES (null,?,?,?,?,0)");
					$sql->execute(array($empreendimento,$nome,$preco,$area));
					$lastId = MySql::conectar()->lastInsertId();
					foreach($imagens as $key => $value){
						MySql::conectar()->exec("INSERT INTO `tb_admin.imagens_imoveis` VALUES (null,$lastId,'$value')");
					}
					Painel::alert('sucesso','O imovel foi cadastrado com sucesso!');
				}

			}
		?>
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome">
		</div>
		<div class="form-group">
			<label>Preço</label>
			<input type="text" name="preco">
		</div>
		<div class="form-group">
			<label>Área</label>
			<input type="number" name="area" min="0" max="2000" step="100" value="0">
		</div>
		<div class="form-group">
			<label>Selecione imagens</label>
			<input type="file" multiple name="imagens[]">
		</div>
		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar Imóvel">
		</div>
	</form>
		<div class="wraper-table">
	
	<table>
		<tr>
			<td>Nome</td>
			<td>Preço</td>
			<td>Área</td>
			<td>Açao</td>
		</tr>

		<?php  
		$pegaImoveis = Painel::selectQuery('tb_admin.imoveis', 'empreend_id=?',array($id));
		foreach($pegaImoveis as $key=>$value){ 
			$value['preco'] = Painel::convertMoney($value['preco']);
			?> 
		<tr>
			<td><?php echo $value['nome']; ?></td>
			<td>R$ <?php echo $value['preco']; ?></td>
			<td><?php echo $value['area']; ?>m²</td>
			<td><a class="btn visualizar" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>editar-imovel?id=<?php echo $value['id'] ?>"><i class="fa fa-eye"></i> Visualizar</a></td>
			
		</tr>
		<?php } ?>
	</table>
	</div>
</div>