<div class="box-content">
	<div class="body-box">
		<h1 class="disolay-4"><i class="fas fa-users"></i> Cadastrar Notícia</h1>
		
		<form class="form-row mt-4 ajax" method="post" enctype="multipart/form-data">
			<?php
			if(isset($_POST['acao'])){
				$titulo = $_POST['titulo'];
				$conteudo = $_POST['conteudo'];
				$capa = $_FILES['capa'];
				$loja_id = $_SESSION['id_loja'];
				
				if($titulo == '' || $conteudo == ''){
					Painel::alert('erro','Campos vázios não são permitidos');
				}else if($capa['tmp_name'] == ''){
					Painel::alert('erro','A imagem de capa precissa ser selecionada');
				}else{
					if(Painel::imagemValida($capa)){
						$verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo = ? AND loja_id = ?");
						$verificar->execute(array($titulo,$loja_id));
						if($verificar->rowCount() == 0){
						$imagem = Painel::uploadFile($capa);
						$slug = Painel::generateSlug($titulo);
						$arr = [ 'loja_id'=>$loja_id, 'data'=>date('Y-m-d'), 'titulo'=>$titulo, 'conteudo'=>$conteudo, 'capa'=>$imagem, 'slug'=>$slug,
						'order_id'=>'0',
						'nome_tabela'=>'tb_site.noticias',
					];
					
					if(Painel::insert($arr)){
						Painel::redirect(INCLUDE_PATH_PAINEL_LOJA.'?sucesso');
						//Painel::alert('sucesso','Cadastro realizado com sucesso');
					}
					}else{
						Painel::alert('erro', 'Já existe uma notícia com esse titulo');
						}
					}else{
						Painel:: alert('erro', 'Selecione uma imagem valida');
					}
					
				}
			}
			if(isset($_GET['sucesso']) && !issert($_POST['acao'])){
				Painel::alert('sucesso','Cadastro foi realizado com sucesso');
			}
		?>
			<div class="form-group col-sm-12">
				<label>Titulo: </label>
				<input type="text" class="form-control" name="titulo" value="<?php recoverPost('titulo'); ?>">
			</div>
			<div class="form-group col-sm-12">
				<label>Conteudo: </label>
				
				<textarea class="tinymce" id="full-featured" name="conteudo"><?php recoverPost('conteudo'); ?></textarea>
			</div>
			<div class="form-group col-sm-12">
				<label>Capa: </label>
				<input type="file" class="form-control" name="capa">
			</div>
			<div class="form-group col-sm-12">
				<input type="hidden" name="loja_id">
				<input type="hidden" name="order_id" value="0">
				<input type="hidden" name="nome_tabela" value="tb_site.noticias" />
				<input class="btn btn-info" type="submit" name="acao" value="Cadastrar">
			</div>
		</form>
	<div class="clear"></div>
</div>
</div>