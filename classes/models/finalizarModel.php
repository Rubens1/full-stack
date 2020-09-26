<?php 
	namespace models;

	class finalizarModel{
		public static function getFinalizarItems(){
			$sql = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque`");
			$sql->execute();
			return $sql->fetchAll();
		}

			public static function getTotalItemsCarrinho(){
			if(isset($_SESSION['carrinho'])){
			$amount = 0;
			foreach ($_SESSION['carrinho'] as $key => $value) {
				
				$amount+=$value;
			}
		}else{
			return 0;
		}
		return $amount;
		}
		
	}
 ?>