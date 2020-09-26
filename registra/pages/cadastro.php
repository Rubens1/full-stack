<div class="container">
<div class="verification-cadastro">
   <div class="cadastrar">
        <form method="post">
            <div class="titulo-cadastro"> <h1>Cadastre aqui</h1><a href="<?php echo INCLUDE_PATH_REGISTRO; ?>cadastra-loja" class="btn-cadastro-loja">Registra a minha empresa</a></div>
                    <?php 
                    if(isset($_POST['acao'])){
                        
                        $nome = $_POST['nome'];
                        $sobrenome = $_POST['sobrenome'];
                        $email = $_POST['email'];
                        $cpf = $_POST['cpf'];
                        $senha_sem_cript = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
                        $senha = password_hash($senha_sem_cript,PASSWORD_DEFAULT);
                        $confirmasenha = filter_input(INPUT_POST, 'confirmasenha', FILTER_DEFAULT);
                        $cep = $_POST['cep'];
                        $estado = $_POST['estado'];
                        $cidade = $_POST['cidade'];
                        $bairro = $_POST['bairro'];
                        $complemento = $_POST['complemento'];
                        $numero = $_POST['numero'];
                        if($nome == ''){
                            Painel::alert('erro','');
                        }else if($sobrenome == ''){
                            Painel::alert('erro','');
                        }else if($email == ''){
                            Painel::alert('erro','');
                        }else if($senha == ''){
                            Painel::alert('erro','');
                        }else if($cpf == ''){
                            Painel::alert('erro','');
                        }else if($cep == ''){
                            Painel::alert('erro','');
                        }else if($estado == ''){
                            Painel::alert('erro','');
                        }else if($cidade == ''){
                            Painel::alert('erro','');
                        }else if($bairro == ''){
                            Painel::alert('erro','');
                        }else if($complemento == ''){
                            Painel::alert('erro','');
                        }else if($numero == ''){
                            Painel::alert('erro','');
                        }
                        
                        if(Consumido::consumidoExists($email)){
                        Painel::alert('erro',' O email já existe, selecione outro por favor!');
                        }else if(Consumido::cpfExists($cpf)){
                            Painel::alert('erro',' O cpf já existe, selecione outro por favor!');
                        }else if(!Consumido::isCpf($cpf)){
                           Painel::alert('erro','CPF Invalido');
                        }else{
                                if($confirmasenha == $senha_sem_cript){
                                    //Apenas cadastrar no banco de dado//
                                    $consumido = new Consumido();
                                    $consumido->cadastrarConsumido($nome,$sobrenome,$email,$cpf,$senha,$cep,$estado,$cidade,$bairro,$complemento,$numero);
                                    Painel::alert('sucesso','O cadastro foi feito com sucesso!');
                                }else{
                                    Painel::alert('erro',' Por favor confirma a senha');
                                }
                            }
                        }
                    ?>
            <div class="cadastro">
                <div class="info-cadastro">
                    <label>Nome</label>
                    <input class="form-cadastro" type="text" name="nome" required>
                </div>
                <div class="info-cadastro">
                    <label>Sobrenome</label>
                    <input class="form-cadastro" type="text" name="sobrenome" required>
                </div>
                <div class="info-cadastro">
                    <label>CPF</label>
                    <input class="form-cadastro" type="text" name="cpf" required>
                </div>
                <div class="info-cadastro">
                    <label>Email</label>
                    <input class="form-cadastro" type="email" name="email" required>
                </div>
                <div class="info-cadastro">
                    <label>Senha</label>
                    <input class="form-cadastro" type="password" name="senha" required>
                </div>
                <div class="info-cadastro">
                    <label>Confirma Senha</label>
                    <input class="form-cadastro" type="password" name="confirmasenha" required>
                </div>
                <div class="center"><h3>Endereço</h3></div>
                <div class="info-cadastro">
                    <label>CEP</label>
                    <input class="form-cadastro" type="text" name="cep" required>
                </div>
                <div class="info-cadastro">
                    <label>Estado</label>
                    <input class="form-cadastro" type="text" name="estado" required>
                </div>
                <div class="info-cadastro">
                    <label>Cidade</label>
                    <input class="form-cadastro" type="text" name="cidade" required>
                </div>
                <div class="info-cadastro">
                    <label>Bairro</label>
                    <input class="form-cadastro" type="text" name="bairro" required>
                </div>
                <div class="info-cadastro">
                    <label>Complemento</label>
                    <input class="form-cadastro" type="text" name="complemento" required>
                </div>
                <div class="info-cadastro">
                    <label>Numero</label>
                    <input class="form-cadastro" type="text" name="numero" required>
                </div>
            </div>
            <div class="center">
                <input type="submit" value="registra" name="acao" class="btn-cadastro">
            </div>
        </form>

    </div>
</div>
</div>