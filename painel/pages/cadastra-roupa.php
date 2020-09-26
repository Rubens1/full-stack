<div class="box-content">
		<div class="body-box">
			<div class="titulo">
                <h2><i class="fas fa-tshirt"></i> Cadastrar Produto</h2>
            </div>
				<form class="form-row mt-4 w100" method="post" enctype="multipart/form-data">

				<?php
				
				if(isset($_POST['acao'])){
					$nome = $_POST['nome'];
					$descricao = $_POST['descricao'];
					@$tamanho = implode(' , ', $_POST['tamanho']);
					@$cor = implode(' , ', $_POST['cor']);
					
					$quantidade = $_POST['quantidade'];
					$preco = \Painel::formatarMoedaBd($_POST['preco']);
					$loja_id = $_SESSION['id_loja'];
					$categoria_id = $_POST['categoria_id'];
					$subcategoria_id = $_POST['subcategoria_id'];
					$promocao = \Painel::formatarMoedaBd(0);
					$slug = Painel::generateSlug($_POST['nome']);

					
					$imagens = array();
					$amountFiles = count($_FILES['imagem']['name']);

					$sucesso = true;
				
					if($_FILES['imagem']['name'][0] != ''){
					for($i = 0; $i < $amountFiles; $i++){
						$imagemAtual = ['type'=>$_FILES['imagem']['type'][$i], 'size'=>$_FILES['imagem']['size'][$i]];
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
					
					if($cor == ''){
						$sucesso = false;
						Painel::alert('erro','Você precisa selecionar pelo menos uma cor!');
					}
					if($tamanho == ''){
						$sucesso = false;
						Painel::alert('erro','Você precisa selecionar pelo menos um tamanho!');
					}

					if($sucesso){
						for($i = 0; $i < $amountFiles; $i++){
							$imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i], 'name'=>$_FILES['imagem']['name'][$i]];
						$imagens[] = Painel::uploadFile($imagemAtual);
						}
										
						$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.estoque` VALUES (null,?,?,?,?,?,?,?,?,?,?,?)");
						$sql->execute(array($loja_id,$categoria_id,$subcategoria_id,$nome,$descricao,$tamanho,$cor,$quantidade,$preco,$promocao,$slug));
						$lastId = MySql::conectar()->lastInsertId();
						foreach($imagens as $key => $value){
							MySql::conectar()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES (null,$lastId,'$value')");
						}
						
						Painel::alert('sucesso','O produto foi cadastrado com sucesso!');
					}

				}

				
			?>

					<div class="form-group col-sm-12">
						<label>Nome do produto: </label>
						<input type="text" class="form-control" name="nome" required>
					</div><!--form-group-->
					<div class="form-group col-sm-12">
					<label>Categoria:</label>
						<select name="subcategoria_id" class="form-control">
							<?php
							$slide = Painel::select('tb_admin.estoque','id = ?',array($id));
								$subcategorias = Painel::selectAll('tb_admin.subcategoria');
								foreach ($subcategorias as $key => $value) {
									if($value['categoria_id'] == 2){
									

							?>
							<option <?php if($value['id'] == $slide['subcategoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['subcategoria']; ?></option>
							<?php } } ?>
						</select>
					</div><!--form-group-->
					<div class="form-group col-sm-12">
						<label>Descrição do produto: </label>
						<textarea class="form-control tinymce" name="descricao" required></textarea>
					</div><!--form-group-->
					<div class="form-group col-sm-12">
						<label>Tipo de tamanho:</label>
						<select name="tipo_tamanho" class="form-control">
							<option value="letra">Tamano por letra</option>
							<option value="numero">Tamanho por número</option>
						</select>
				</div><!--form-group-->
					<div ref="tamanho_letra" class="form-group col-sm-12 tamanho_letra">
						<label>Tamanho do produto: P, M, G e GG </label><br>
							<input type="checkbox" name="tamanho[]" id="tamanho_letra" value="P"> P
							<input type="checkbox" name="tamanho[]" id="tamanho_letra" value="M"> M
							<input type="checkbox" name="tamanho[]" id="tamanho_letra" value="G"> G
							<input type="checkbox" name="tamanho[]" id="tamanho_letra" value="GG"> GG
					</div><!--form-group-->

					<div style="display: none;" ref="tamanho_numero" class="form-group col-sm-12">
					<label>Tamanho do produto: de 34 a 60 </label><br>
					<?php for($i = 34; $i <= 60; $i++){ ?>
						<input style="margin-left: 5px;" type="checkbox" name="tamanho[]" id="tamanho_numero" value="<?php echo $i; ?>"> <?php echo $i; ?>
					<?php } ?>
					
					</div><!--form-group-->
					<div class="form-group col-sm-12">
						<label>Cores: </label>
							<input type="checkbox" name="cor[]" value="Estampado"> Estampado
							<input type="checkbox" name="cor[]" value="Azul"> Azul
							<input type="checkbox" name="cor[]" value="Amarelo"> Amarelo
							<input type="checkbox" name="cor[]" value="Branco"> Branco
							<input type="checkbox" name="cor[]" value="Preto"> Preto
							<input type="checkbox" name="cor[]" value="Verde"> Verde
							<input type="checkbox" name="cor[]" value="Vermeio"> Vermeio
					</div><!--form-group-->
					<div class="form-group col-sm-12">
						<label>Quantidade atual do produto: </label>
						<input type="text" class="form-control" name="quantidade" required>
					</div><!--form-group-->
					<div class="form-group col-sm-12">
						<label>Preço: </label>
						<input type="text" class="form-control" name="preco" required>
					</div><!--form-group-->
					<div class="form-group col-sm-12">
						<label>Selecione a capa do produto: </label>
						<input multiple type="file" class="form-control" name="imagem[]">
					</div><!--form-group-->
					<div class="form-group col-sm-12">		
						<input type="hidden" name="loja_id">
						<input type="hidden" name="categoria_id" value="2">
						<input class="btn btn-info" type="submit" name="acao" value="Cadastrar Produto">
					</div><!--form-group-->
					</form>
		<div class="clear"></div>
	</div><!--body-box-->
</div><!--box-content-->