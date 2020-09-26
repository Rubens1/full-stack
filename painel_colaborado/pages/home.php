<?php 
	$usuariosOnline = Painel::listarUsuariosOnline();
	$pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
	$pegarVisitasTotais->execute();

	$pegarVisitasTotais = $pegarVisitasTotais->rowCount();

	$pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
	$pegarVisitasHoje->execute(array(date('Y-m-d')));

	$pegarVisitasHoje = $pegarVisitasHoje->rowCount();
 ?>

<!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
       <h3> <i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA ?></h3>

        <!--<div class="collapse navbar-collapse" id="navbarSite">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>-->
      </nav>

      	<div class="container bg-light painel mt-5">
      		<div class="row">
		<h3>Bem-vindo <?php echo $_SESSION['nome']; ?></h3>
		<div class="box-metricas col-12">
			<div class="box-metrica-single ">
				<div class="box-metrica-wraper">
					<h2>Usuários Online</h2>
					<p><?php echo count($usuariosOnline); ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="box-metrica-single ">
				<div class="box-metrica-wraper">
					<h2>Total de Visitas</h2>
					<p><?php echo $pegarVisitasTotais; ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="box-metrica-single ">
				<div class="box-metrica-wraper">
					<h2>Visitas Hoje</h2>
					<p><?php echo $pegarVisitasHoje ; ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="clear"></div>

			<div class="box-metrica-single ">
				<div class="box-metrica-wraper">
					<h2>Comprador</h2>
					<p><?php echo count($usuariosOnline); ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="box-metrica-single ">
				<div class="box-metrica-wraper">
					<h2>Total de lojas</h2>
					<p><?php echo count($usuariosOnline); ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="box-metrica-single">
				<div class="box-metrica-wraper">
					<h2>Vendas total</h2>
					<p><?php echo count($usuariosOnline); ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="clear"></div>
		</div>
    </div>
</div>
<div class="container">
<div class="row">

<div class="box-content mt-4 col-sm-6 col-md-12 ">
	<h2><i class="fas fa-at"></i> Usuarios online</h2>
	<div class="table-responsive">
		<div class="rows-table">
			<div class="col">
				<span>IP</span>
		</div>
			<div class="col">
				<span>Ultima ação</span>
		</div>
		</div>
		<?php 
			foreach ($usuariosOnline as $key => $value) {
				
		 ?>
		<div class="rows-table">
			<div class="col">
				<span><?php echo $value['ip'] ?></span>
		</div>
			<div class="col">
				<span><?php echo date('d/m/Y H:i:s', strtotime($value['ultima_acao'])); ?></span>
		</div>
		</div>
	<div class="clear"></div>
<?php } ?>
</div>
</div>
<div class="box-content col-md-12">
	<h2><i class="fas fa-user"></i>Usuarios Cadastrado</h2>
	<div class="table-responsive">
		<div class="rows-table">
			<div class="col">
				<span>Nome</span>
		</div>
			<div class="col">
				<span>Cargo</span>
		</div>
		</div>
		<?php 
		$usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `tb_admin.colaborado`");
		$usuariosPainel->execute();
		$usuariosPainel = $usuariosPainel->fetchAll();
			foreach ($usuariosPainel as $key => $value) {
				
		 ?>
		<div class="rows-table">
			<div class="col">
				<span><?php echo $value['nome'] ?></span>
		</div>
			<div class="col">
				<span><?php echo pegaCargo($value['cargo']); ?></span>
		</div>
		</div>
	<div class="clear"></div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
