<?php
	
	class Loja{

		public function atualizarLoja($empresario,$logo,$email,$cnpj,$loja,$slug){
			$sql = \MySql::conectar()->prepare("UPDATE `tb_admin.lojas` SET empresario = ?,logo = ?,email = ?,cnpj = ?,loja = ?,slug = ? WHERE id = ?");
			if($sql->execute(array($empresario,$logo,$email,$cnpj,$loja,$slug,$_SESSION['id_loja']))){
				return true;
			}else{
				return false;
			}
		}

		public function atualizarEnderecoLoja($cep,$estado,$cidade,$bairro,$complemento,$numero){
			$sql = MySql::conectar()->prepare("UPDATE `tb_admin.lojas` SET cep = ?,estado = ?,cidade = ?, bairro = ?,complemento = ?,numero = ? WHERE id = ?");
			if($sql->execute(array($cep,$estado,$cidade,$bairro,$complemento,$numero,$_SESSION['id_loja']))){
				return true;
			}else{
				return false;
			}
		}

		public function atualizarSenhaoja($senha){
			$sql = MySql::conectar()->prepare("UPDATE `tb_admin.lojas` SET senha = ? WHERE id = ?");
			if($sql->execute(array($senha,$_SESSION['id_loja']))){
				return true;
			}else{
				return false;
			}
		}

		public static function lojaExists($email){
			$sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.lojas` WHERE email= ?");
			$sql->execute(array($email));
			if($sql->rowCount() == 1)
				return true;
			else
				return false;
		}

		public static function cnpjExists($cnpj){
			$sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.lojas` WHERE cnpj= ?");
			$sql->execute(array($cnpj));
			if($sql->rowCount() == 1)
				return true;
			else
				return false;
		}

		public static function cadastrarLoja($empresario,$email,$senha,$cnpj,$loja,$cep,$estado,$cidade,$bairro,$complemento,$numero,$slug){
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.lojas` VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?)");
			$sql->execute(array($empresario,$email,$senha,$cnpj,$loja,$cep,$estado,$cidade,$bairro,$complemento,$numero,$slug));
		}

		public static function isCnpj($cnpj){
			$cnpj = preg_replace("/[^0-9]/", "", $cnpj);
			$digitoUm = 0;
			$digitoDois = 0;

			for($i = 0, $x = 5; $i <= 11; $i++, $x--){
				$x = ($x < 2) ? 9 : $x;
				$numero = substr($cnpj, $i, 1);
				$digitoUm += $numero * $x;
			}

			for($i = 0, $x = 6; $i <= 12; $i++, $x--){
				if(str_repeat($i, 11) == $cnpj){
					return false;
				}
				$x = ($x < 2) ? 9 : $x;
				$numero = substr($cnpj, $i, 1);
				$digitoDois += $numero * $x;
			}

			$calculoUm = (($digitoUm%11) < 2 ? 0 : 11 -($digitoUm%11));
			$calculoDois = (($digitoDois%11) < 2 ? 0 : 11 -($digitoDois%11));
			if($calculoUm <> substr($cnpj, 12, 1) || $calculoDois <> substr($cnpj, 13, 1)){
				return false;
			}else{
				return true;
			}
		}

		public static function verificaDadosEmpresa($email){
			if(isset($_POST['enviar']) && $_POST['enviar'] == 'form'){
				$email = addslashes($_POST['email']);
				$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE email=?");
				$sql->execute(array($email));
				if($sql->rowCount() > 0){
					Loja::add_dados_racover_empresa($email);
				}else{
					echo Painel::alert('erro','Digite um email cadastrado');
				}
			}
		}

		public static function add_dados_racover_empresa($email){
			$rash = md5(rand());
			$sql = MySql::conectar()->prepare("INSERT INTO `recover_solicitado_empresa` VALUES (null,?,?)");
			$sql->execute(array($email,$rash));

			if($sql->rowCount() > 0){
				Loja::enviarEmailEmpresa($email,$rash);
			}else{

			}
		}

		public static function enviarEmailEmpresa($email,$rash){
			$mail = new Email('labdevelop.com.br','rubens.jesus@labdevelop.com.br','Ru19051997','LordLis');
			$mail->addAdress($email,'Pedido de uma nova senha');
			$subject = "RECUPERAR SENHA";
			$messege = '<html><head>';
			
				$messege .= "
			<h2>Você solicitou uma nova senha</h2>
			<h3>Entre nesse link para altera a senha: </h3><p><a href='".INCLUDE_PATH_REGISTRO."alterar_empresa&rash={$rash}'>".INCLUDE_PATH_REGISTRO."alterar_empresa&rash={$rash}</a></p>
			<hr>
			<p>Atenciosamente, LORDLIS.</p>
			";
			$messege .='</html></head>';
			
			$info = array('assunto'=>$subject,'corpo'=>$messege);	
			$mail->formatarEmail($info);

			if($mail->enviarEmail()){
				echo Painel::alert('sucesso','Uma nova senha foi enviado');
			}else{
				echo Painel::alert('erro','Erro ao enviar o link de alteração da senha');
			}
		}

		public static function verificaRashEmpresa($rash){
			
			$alterar = MySql::conectar()->prepare("SELECT * FROM `recover_solicitado_empresa` WHERE rash=?");
			$alterar->execute(array($rash));
			if($alterar->rowCount() > 0){
				if(isset($_POST['env']) && $_POST['env'] == 'upd'){
					$senha_sem_cript = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
					$novasenha = addslashes(password_hash($senha_sem_cript,PASSWORD_DEFAULT));
					$dados = $alterar->fetch()['email'];
					Loja::atualizarSenhaEmpresa($dados,$novasenha);
					Loja::deletarRashEmpresa($dados);
					echo Painel::alert('sucesso','Senha alterada com sucesso.');
					Loja::redirecionarEmpresa(INCLUDE_PATH);
				}
			}else{
				Loja::redirecionarEmpresaErro(INCLUDE_PATH);

			}
		}

		public static function atualizarSenhaEmpresa($email,$senha){
			$atualizar = MySql::conectar()->prepare("UPDATE `tb_admin.lojas` SET senha = ? WHERE email = ?");
			$atualizar->execute(array($senha, $email));

			if($atualizar->rowCount() > 0){
				return true;
			}else{
				return false;
			}

		}

		public static function deletarRashEmpresa($email){
			$atualizar = MySql::conectar()->prepare("DELETE FROM `recover_solicitado_empresa` WHERE email = ?");
			$atualizar->execute(array($email));

			if($atualizar->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}
		public static function redirecionarEmpresa($dir){
			echo "<meta http-equiv='refresh' content='3; url={$dir}'>";
		}
		public static function redirecionarEmpresaErro($dir){
			echo "<meta http-equiv='refresh' content='0; url={$dir}'>";
		}

	}

?>