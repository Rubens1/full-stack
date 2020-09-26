<?php 
	namespace controller;
	/**
	*
	* @autor Rubens Nogueira
	*
	*/

	class ofertaController
	{
		public function __construct(){
			
			$this->view = new \views\mainView('oferta');
		}
		public function executar(){
			$this->view->render(array('titulo'=>'Ofertas'));
		}
	}
 ?>