<?php 
	namespace controller;
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class produtosController
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
				\Painel::redirect(INCLUDE_PATH.'produtos');
			}
			$this->view = new \views\mainView('produtos');
		}
		
		public function executar(){
			$this->view->render(array('titulo'=>'Produtos'));
		}

		
	}
 ?>