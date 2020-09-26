<div class="box-content">
	<h2>Lista de Empreendimento</h2>
		<div class="busca">
		<h4>Realizar busca</h4>
		<form method="post">
			<input type="text" class="form-control" name="busca" placeholder="Procure pelo nome do empreendimento">
			<input type="submit" name="acao" value="Buscar!">
		</form>
	</div>
	<?php 

		if(isset($_GET['deletar'])){
			$id = (int)$_GET['deletar'];
			$imagens = MySql::conectar()->prepare("SELECT `imagem` FROM `tb_admin.empreendimento` WHERE id = $id");
			$imagens->execute();
			$imagens = $imagens->fetch();
			@unlink(BASE_DIR_PAINEL_LOJA.'/uploads/'.$imagens['imagem']);
			
			$imoveis =  MySql::conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE empreend_id = $id");
			$imoveis->execute();
			$imoveis = $imoveis->fetchAll();
			foreach ($imoveis as $key => $value) {
				$imagens =  MySql::conectar()->prepare("SELECT * FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $value[id]");
				$imagens->execute();
				$imagens = $imagens->fetchAll();
				foreach ($imagens as $key2 => $value2) {
					@unlink(BASE_DIR_PAINEL_LOJA.'/uploads/'.$value2['imagem']);
					MySql::conectar()->exec("DELETE FROM `tb_admin.imagens_imoveis` WHERE id = $value2[id]");
				}
				
			}
			MySql::conectar()->exec("DELETE FROM `tb_admin.imoveis` WHERE empreend_id = $id");
			MySql::conectar()->exec("DELETE FROM `tb_admin.empreendimento` WHERE id = $id");
			Painel::alert('sucesso','O empreendimento foi deletado com sucesso');
		}
	 ?>
	<div class="boxes">
		<?php 
			$query = "";
			if(isset($_POST['acao']) && $_POST['acao'] == 'Buscar!'){
				$nome = $_POST['busca'];
				$query = "WHERE (nome LIKE '%$nome%')";

			}
			if($query == ''){
				$query2 = "";
			}else{
				$query2 = "";
			}
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimento` $query ORDER BY order_id ASC");
			$sql->execute();
			$empreendimento = $sql->fetchAll();
			if($query != ''){
					echo '<div style="width:100%" ><p>Foram encontrado(s):<b>'.count($empreendimento).'</b></p></div>';
				}
			foreach ($empreendimento as $key => $value) {
							
		 ?>
	
		<div id="item-<?php echo $value['id'];?>" class="box-single-wraper">
			<div style="padding:8px 15px;height: 100%;">
				<div style="width: 100%;float: left;" class="box-imagem">
										
				<img style="width: 100%;" class="img-produto" src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>uploads/<?php echo $value['imagem']; ?>" />
			
			</div>
			<div class="box-single">
			<div class="body-box">
				<p><b class=""><i></i>Nome:</b> <?php echo $value['nome']; ?></p>
				<p><b class=""><i></i>Tipo:</b> <?php echo ucfirst($value['tipo']); ?></p>
				<p><b class=""><i></i>Preço:</b> <?php echo $value['preco']; ?></p>
				<div class="group-btn">
					<a item_id="<?php echo $value['id']; ?>" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO?>listar-empreendimento?deletar=<?php echo $value['id'];?>"><i class="fa fa-times"></i> Excluir</a>
					<a class="btn views" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>visualizar-empreendimento/<?php echo $value['id'] ?> "><i class="fas fa-eye"></i> Visualizar</a>
				</div>
			</div>
		</div>
			<div class="clear"></div>
	  </div>
	</div>
	  <?php } ?>
	  
	</div>
</div>
