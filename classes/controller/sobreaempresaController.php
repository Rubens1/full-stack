<?php 
	namespace controller;
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class sobreaempresaController
	{
		public function __construct(){
			
			$this->view = new \views\mainView('sobreaempresa');
		}
		public function executar(){
			$this->view->render(array('titulo'=>'Sobre a Empresa'));
		}
	}
 ?>