<?php 
	namespace controller;
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class categoriaController
	{
		public function __construct(){
			
			$this->view = new \views\mainView('categoria');
		}
		public function executar(){
			$this->view->render(array('titulo'=>'categoria'));
		}
	}
 ?>