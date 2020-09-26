<?php 
	namespace controller;
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class homeController
	{
		public function __construct(){
			
			$this->view = new \views\mainView('home');
		}
		public function executar(){
			$this->view->render(array('titulo'=>'Início'));
		}
	}
 ?>