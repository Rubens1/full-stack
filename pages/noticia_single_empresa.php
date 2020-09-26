<?php 
	$slug_categoria = explode('/', $_GET['url']);
	$slug_loja = explode('/', $_GET['url']);
	$verifica_loja = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE slug = ?");
	$verifica_loja->execute(array($url[1]));

	$loja_info = $verifica_loja->fetch();
	$post =  MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE slug = ? AND loja_id = ? ");
	$post->execute(array($url[2],$loja_info['id']));
	if($post->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'perfil-empresa');
	}

	$post = $post->fetch();
 ?>
<section class="noticia-single">
		
			<h1 class="center"><?php echo date('d/m/Y', strtotime($post['data'])); ?> - <?php echo $post['titulo']; ?></h1>
		
			<article>
				<?php echo $post['conteudo'] ?>
		</article>
<?php 
	if(Painel::logadoconsumido() == false){
		if(Painel::logado() == false){ 
?>
<div class="container-erro-login">
<h2><i class="fa fa-times"></i> Você precisa estar conectado com a sua conta para comenta</h2>
</div>
<?php
}else{}
	}else{


if(isset(($_POST['posta_comentario']))){
	$nome = $_POST['nome'];
	$comentario = $_POST['mensagem'];
	$noticia_id = $_POST['noticia_id'];
	$loja_id = $_POST['loja_id'];

	$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.comentarios` VALUES (null,?,?,?,?)");
	$sql->execute(array($nome,$comentario,$noticia_id,$loja_id));
	echo '<script>alert("Comentario realizado com sucesso")</script>';
	}
 ?>
<h2 class="posta-comentario ">Faça um comentario <i class="fa fa-comment"></i></h2>
<form method="post">
	<input type="hidden" name="nome" value="<?php echo $_SESSION['nome'];?>" >
	<textarea placeholder="Seu comentario..." name="mensagem"></textarea>
	<input type="hidden" name="noticia_id" value="<?php echo $post['id']; ?>">
	<input type="hidden" name="loja_id" value="<?php echo $loja_info['id']; ?>">
	<input type="submit" name="posta_comentario" value="Comentar">
</form>
<br>
<h2 class="posta-comentario center">Comentarios sobre a noticia <i class="fa fa-comments"></i></h2>
<?php 
}
	$comentarios = MySql::conectar()->prepare("SELECT * FROM `tb_site.comentarios` WHERE noticia_id = ? ORDER BY comentario ASC");
	$comentarios->execute(array($post['id']));
	$comentarios = $comentarios->fetchAll();
	foreach ($comentarios as $key => $value) {
	
 ?>
<div class="box-coment-noticia">
	<h3><?php echo ucfirst($value['nome']); ?></h3>
	<p><?php echo $value['comentario']; ?></p>
	
	<?php 

	$respostas = MySql::conectar()->prepare("SELECT * FROM `tb_site.resposta_comentarios` WHERE comentario_id = ?");
	$respostas->execute(array($value['id']));
	$respostas = $respostas->fetchAll();
	foreach ($respostas as $key => $value) {
	
 ?>
	<h3><?php  echo ucfirst($loja_info['loja']); ?></h3>
	<p><?php echo $value['resposta']; ?></p>
<?php } ?>
	
</div>
<?php }  ?>
</section>

