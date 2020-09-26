<div class="container">
<div class="verification-cadastro" id="verification">
   <div class="cadastrar">
        <form method="post">
            <div class="center"> <h2>Registra minha loja</h2></div>
                                        <?php 
                    if(isset($_POST['acao'])){
                        
                        $empresario = $_POST['empresario'];
                        $loja = $_POST['loja'];
                        $email = $_POST['email'];
                        $cnpj = $_POST['cnpj'];
                        $senha_sem_cript = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
                        $senha = password_hash($senha_sem_cript,PASSWORD_DEFAULT);
                        $confirmasenha = filter_input(INPUT_POST, 'confirmasenha', FILTER_DEFAULT);
                        $cep = $_POST['cep'];
                        $estado = $_POST['estado'];
                        $cidade = $_POST['cidade'];
                        $bairro = $_POST['bairro'];
                        $complemento = $_POST['complemento'];
                        $numero = $_POST['numero'];
                        $slug = Painel::generateSlug($_POST['loja']);
                        $logo = '';

                        if(Loja::lojaExists($email)){
                            Painel::alert('erro',' O email já existe, selecione outro por favor!');
                        }else if(Loja::cnpjExists($cnpj)){
                            Painel::alert('erro',' O cnpj já existe, selecione outro por favor!');
                        }else if(!Loja::isCnpj($cnpj)){
                           Painel::alert('erro','CNPJ Invalido');
                        }else{
                                if($confirmasenha == $senha_sem_cript){
                                    //Apenas cadastrar no banco de dado//
                                    //$loja = new Empresa();
                                    //$loja->cadastrarEmpresa($empresario,$email,$senha,$cnpj,$loja,$cep,$estado,$cidade,$bairro,$complemento,$numero,$slug);
                                    $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.lojas` VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                    $sql->execute(array($empresario,$logo,$email,$senha,$cnpj,$loja,$cep,$estado,$cidade,$bairro,$complemento,$numero,$slug));
                                    Painel::alert('sucesso','O cadastro foi feito com sucesso!');
                                }
                            }
                        }
                    ?>
            <div class="cadastro">
                <div class="info-cadastro">
                    <label>Nome do Empresario</label>
                    <input class="form-cadastro" type="text" name="empresario" required>
                </div>
                <div class="info-cadastro">
                    <label>Nome da Empresa</label>
                    <input class="form-cadastro" type="text" name="loja" required>
                </div>
                <div class="info-cadastro">
                    <label>CNPJ</label>
                    <input class="form-cadastro" type="text" name="cnpj" required>
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