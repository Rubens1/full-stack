<?php 
	if(isset($_GET['id'])){
		$id = (int)$_GET['id'];
		$categoria = Painel::select('tb_site.categoria','id = ?', array($id));
	}else{
		Painel::alert('erro','Voceê precisa passar o parametro do ID: ');
		die();
	}
 ?>
<div class="box-content">
	<h2><i class="fas fa-pencil-alt"></i> Editar categoria</h2>
	<form method="post" enctype="multipart/form-data">
		<?php 
			if(isset($_POST['acao'])){
				$slug = Painel::generateSlug($_POST['nome']);
				$arr = array_merge($_POST,array('slug'=>$slug));
				$verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.categoria` WHERE nome = ? AND id != ?");
				$verificar->execute(array($_POST['nome'],$id));
				if($verificar->rowCount() == 1){
					Painel::alert('erro','Já existe uma categoria com este nome');
				}else{
				if(Painel::update($_POST)){
					Painel::alert('sucesso','Acategorai foi atualizada com sucesso');
					$categoria = Painel::select('tb_site.categoria','id = ?', array($id));
				}else{
					Painel::alert('erro','Campos vázios não são premitido.');
				}
			  }
			}
		 ?>
		<div class="form-group">
			<label>Categoria</label>
			<input type="text" class="form-control" name="nome" value="<?php echo $categoria['nome'];?>">
		</div>
		<div class="form-group">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="hidden" name="nome_tabela" value="tb_site.categoria">
			<input type="submit" name="acao" value="Atualizar">
		</div>
	</form>
</div>