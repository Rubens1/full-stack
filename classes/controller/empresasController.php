<?php 
	namespace controller;
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class empresasController
	{

		public function __construct(){
			$this->view = new \views\mainView('empresas');
		}
		
		public function executar(){
			$this->view->render(array('titulo'=>'Empresas'));
		}
	}
 ?>