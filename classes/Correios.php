<?php 
require ('../vendor/autoload.php');
	class Correios{

		public static function correios{
		
			$correios = new \FlyingLuscas\Correios\Client;
			$correios = new \FlyingLuscas\Correios\Service;

			$correios = new Client;

			$correios->freight()
		    ->origin('01001-000')
		    ->destination($_POST['cep'])
		    ->services(Service::SEDEX, Service::PAC)
		    ->item(16, 16, 16, .3, 1) // largura, altura, comprimento, peso e quantidade
		    ->calculate();
	}
}
 ?>