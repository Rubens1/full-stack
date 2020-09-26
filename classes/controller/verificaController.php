<?php 
	namespace controller;
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class verificaController
	{
		public function __construct(){
			
			$this->view = new \views\mainView('verifica');
		}
		public function executar(){
			$this->view->render(array('titulo'=>'Verifica'));
		}
	}
 ?>