<?php 
	namespace controller;
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class produtosempresaController
	{
		public function __construct(){
			
			$this->view = new \views\mainView('produtosempresa');
		}
		public function executar(){
			$this->view->render(array('titulo'=>'Produtos da Empresa'));
		}
	}
 ?>