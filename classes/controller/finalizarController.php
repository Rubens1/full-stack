<?php 
	namespace controller;
	
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class finalizarController
	{

		public function __construct(){
			if(isset($_GET['addCart'])){
				$idProduto = (int)$_GET['addCart'];
				if(isset($_SESSION['carrinho']) == false){
					$_SESSION['carrinho'] = array();

				}
				if(isset($_SESSION['carrinho'][$idProduto]) == false){
					$_SESSION['carrinho'][$idProduto] = 1;
				}else{
					$_SESSION['carrinho'][$idProduto]++;
				}
				\Painel::redirect(INCLUDE_PATH.'finalizar');
			}
			if(isset($_GET['removerCart'])){
				$idProduto = (int)$_GET['removerCart'];
				if(isset($_SESSION['carrinhos']) == true){
					$_SESSION['carrinho'] = array();

				}if(isset($_SESSION['carrinho'][$idProduto]) == false){
					$_SESSION['carrinho'][$idProduto] = 1;
				}else{
					$_SESSION['carrinho'][$idProduto]--;
				}
				\Painel::redirect(INCLUDE_PATH.'finalizar');
			}

			
			
			$this->view = new \views\mainView('finalizar');
		}
		
		public function executar(){
			$this->view->render(array('titulo'=>'Finalizar Pedido'));
		}
	}
 ?>