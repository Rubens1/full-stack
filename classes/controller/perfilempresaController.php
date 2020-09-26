<?php 
	namespace controller;
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class perfilempresaController
	{

		public function __construct(){
			$this->view = new \views\mainView('perfilempresa');
		}
		
		public function executar(){
			$this->view->render(array('titulo'=>'Perfil Empresa'));
		}
	}
 ?>