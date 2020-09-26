<?php
	
	class Usuario{

		public function atualizarUsuario($nome,$senha,$email,$imagem){
			$sql = MySql::conectar()->prepare("UPDATE `tb_admin.colaborado` SET nome = ?,password = ?,email = ?,img = ? WHERE user = ?");
			if($sql->execute(array($nome,$senha,$email,$imagem,$_SESSION['user']))){
				return true;
			}else{
				return false;
			}
		}

		public static function userExists($user){
			$sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.colaborado` WHERE user=?");
			$sql->execute(array($user));
			if($sql->rowCount() == 1)
				return true;
			else
				return false;
		}

		public static function cadastrarUsuario($user,$senha,$nome,$email,$imagem,$cargo){
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.colaborado` VALUES (null,?,?,?,?,?,?)");
			$sql->execute(array($user,$senha,$nome,$email,$imagem,$cargo));
		}

	}

?>