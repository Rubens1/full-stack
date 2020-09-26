<?php
	namespace views;


	class mainView
	{
		
		public static $par = [];

		public static function setParam($par){
			self::$par = $par;
		}

		private $fileName;
		private $header;
		private $footer;

		public function __construct($fileName,$header = 'header',$footer = 'footer'){
			$this->fileName = $fileName;
			$this->header = $header;
			$this->footer = $footer;
		}
		
		public function render($arr = []){
			include('pages/includes/'.$this->header.'.php');
			include('pages/'.$this->fileName.'.php');
			include('pages/includes/'.$this->footer.'.php');
		}
	}
?>