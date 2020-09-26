<?php 
include('../config.php'); 

  if(Painel::consumido_logado() == false){
    include('login2.php');
  }else{
    include('main.php');
  }
     
  ?>



