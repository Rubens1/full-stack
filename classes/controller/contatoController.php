<?php 
	namespace controller;
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class contatoController
	{
		public function __construct(){
			
			$this->view = new \views\mainView('contato');
		}
		public function executar(){
			$this->view->render(array('titulo'=>'Contato'));
		}
	}
 ?>