<div class="box-content">

  <div class="boxes">
    <?php 
      
      $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas`");
      $sql->execute();
      $lojas = $sql->fetchAll();
      foreach ($lojas as $key => $value) {
        

        
     ?>
  
    <div class="box-single-wraper">
      <div style="padding:8px 15px;height: 100%;">
        <div style="width: 100%;float: left; height: 80%;" class="box-imagem">
          <?php 
            if($value['logo'] == ''){
          ?>
            <h1><i class="fas fa-store-alt"></i></h1>
          <?php
            }else{
           ?>
        <img class="img-loja" src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>logo/<?php echo $value['logo']; ?>" />
        <?php } ?>
      </div>
      <div class="box-single">
        <div class="body-box">
        <p><b class=""><i></i>Nome da Loja:</b> <?php echo $value['loja']; ?></p>
       
     
          <div class="link">
             <a href="<?php echo INCLUDE_PATH; ?>perfilempresa/<?php echo $value['slug'] ?>">Ver mais sobre essa loja</a>
          </div>
       </div>
    </div>
      <div class="clear"></div>
    </div>
  </div>
    <?php  } ?>
    
  </div>
</div>
