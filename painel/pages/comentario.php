<section class="noticia-single" style="width: 100%; margin: 5px;">

<h2 class="posta-comentario center">Comentarios sobre a noticia <i class="fa fa-comments"></i></h2>

<?php 
		$comente = "";
		
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.comentarios` $comente ORDER BY id DESC");
		$sql->execute();
		$comentario = $sql->fetchAll();
					
?>
<div class="container">

<div class="box-coment-noticia w100" style="background: white;"> 
	<?php
	if(isset(($_POST['responde_comentario']))){
	$loja_id = $_POST['loja_id'];
	$resposta = $_POST['resposta'];
	$comentario_id = $_POST['comentario_id'];

	$sql = MySql::conectar()->prepare("INSERT INTO `tb_site.resposta_comentarios` VALUES (null,?,?,?)");
	$sql->execute(array($loja_id,$resposta,$comentario_id));
	
	}
	foreach ($comentario as $key => $value) {
				$noticia = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE id = ? AND loja_id = ? ");
				$noticia->execute(array($value['noticia_id'], $_SESSION['id_loja']));
				$noticias = $noticia->fetchAll();
	 foreach ($noticias as $key => $value2) {
		if($value2['loja_id'] == $_SESSION['id_loja']){ 
	 ?>
	<h2 class="center"><?php echo $value2['titulo']; ?></h2>
	<?php } ?>
	<h4><?php echo $value['nome']; ?></h4>
	<p><?php echo $value['comentario']; ?></p>
	
	<?php 
	

	$respostas = MySql::conectar()->prepare("SELECT * FROM `tb_site.resposta_comentarios` WHERE comentario_id = ? AND loja_id = ?");
	$respostas->execute(array($value['id'], $_SESSION['id_loja']));
	$respostas = $respostas->fetchAll();
	foreach ($respostas as $key => $value3) {
	 ?>
	<div class="resposta" style="background: #9765; padding: 0 8px; border-radius: 7px;">

		<p><?php echo $value3['resposta']; ?></p>
	</div>
<?php }  ?>
	<form method="post">
		<input type="hidden" name="loja_id" value="<?php echo $_SESSION['id_loja']; ?>">
		<textarea class="tinymce" name="resposta" placeholder="Responder.."></textarea>
		<input type="hidden" name="comentario_id" value="<?php echo $value['id']; ?>">
		<input type="hidden" name="noticia_id"><br>
		<input type="submit" name="responde_comentario" value="Responder">
	</form>
	<div class="clear"></div><hr style="background: black;">
	<?php } } ?>
</div>
</div>

</section>
