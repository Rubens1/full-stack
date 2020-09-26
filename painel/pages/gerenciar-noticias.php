<?php
	if(isset($_GET['excluir'])){
		$idExcluir = intval($_GET['excluir']);
		$selectImagem = MySql::conectar()->prepare("SELECT capa FROM `tb_site.noticias` WHERE id = ?");
		$selectImagem->execute(array($_GET['excluir']));

		$imagem = $selectImagem->fetch()['capa'];
		Painel::deleteFile($imagem);
		Painel::deletar('tb_site.noticias',$idExcluir);
		Painel::redirect(INCLUDE_PATH_PAINEL_LOJA.'gerenciar-noticias');
	}else if(isset($_GET['order']) && isset($_GET['id'])){
		Painel::orderItem('tb_site.noticias',$_GET['order'],$_GET['id']);
	}

	$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
	$porPagina = 10;
	
	$noticias = Painel::selectLojaAll('tb_site.noticias',($paginaAtual - 1) * $porPagina,$porPagina);
	
?>
<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Notícias Cadastradas</h2>
	<a style="margin-right: 20px;" href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>cadastrar-noticia">
	<i class="far fa-clipboard"></i> Cadastrar publicações 
		</a>
		<a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>comentario">
		<i class="far fa-comment-alt"></i> Responder comentarios
        </a>
	<div class="wraper-table">
	<table>
		<tr>
			<td>Titulo</td>
			<td>Capa</td>
			<td>Editar</td>
			<td>Deletar</td>
		</tr>

		<?php
			foreach ($noticias as $key => $value) {
		?>
		<tr>
			<?php if($_SESSION['id_loja'] === $value['loja_id']){ ?>
			<td><?php echo $value['titulo']; ?></td>
			<td><img style="width: 50px;height:50px;" src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>uploads/<?php echo $value['capa']; ?>" /></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>editar-noticia?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>gerenciar-noticias?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
		</tr>

		<?php } } ?>

	</table>
	</div>

	<div class="paginacao">
		<?php
			$totalPaginas = ceil(count(Painel::selectLojaAll('tb_site.noticias')) / $porPagina);
			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual)
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL_LOJA.'gerenciar-noticias?pagina='.$i.'">'.$i.'</a>';
				else
					echo '<a href="'.INCLUDE_PATH_PAINEL_LOJA.'gerenciar-noticias?pagina='.$i.'">'.$i.'</a>';
					
			
		}

		?>
	</div><!--paginacao-->


</div><!--box-content-->