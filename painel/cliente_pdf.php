<?php
include('../config.php');
?>


<style>
    .pdf{
        width: 100%;
    }
    .pdf .tr_pdf{
    text-align: center;
    background: none ;
    color: black;
}
.pdf .td_pdf{
    text-align: center;
    border: 1px solid #646464;
}

</style>
<?php

 $url = $_GET['cliente'];
    $pedido = "";
    $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_site.pedido` $pedido ORDER BY id DESC");
    $sql->execute();
    $pedidos = $sql->fetchAll();
    $consumido = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.consumido` WHERE id = ?");
    $consumido->execute(array($url));
    $consumido = $consumido->fetchAll();
    foreach ($consumido as $key => $usuario) {
?>

        <table class="pdf">
            <tr class="tr_pdf">
                <td class="td_pdf">Nome:</td>
                <td class="td_pdf"  colspan="2">CPF:</td>
                <td class="td_pdf"  colspan="2">Email:</td>
            </tr>
            <tr>
                <td class="td_pdf"><?php echo $usuario['nome'] ?> <?php echo $usuario['sobrenome'] ?></td>
                <td class="td_pdf" colspan="2"><?php echo $usuario['cpf'] ?></td>
                <td class="td_pdf" colspan="2"><?php echo $usuario['email'] ?></td>
            </tr>
            <tr class="tr_pdf">
                <td class="td_pdf">CEP:</td>
                <td class="td_pdf">Estado:</td>
                <td class="td_pdf">Bairro:</td>
                <td class="td_pdf">Complemento:</td>
                <td class="td_pdf">Numero:</td>
            </tr>
            <tr>
                <td class="td_pdf"><?php echo $usuario['cep'] ?></td>
                <td class="td_pdf"><?php echo $usuario['estado'] ?></td>
                <td class="td_pdf"><?php echo $usuario['cidade'] ?></td>
                <td class="td_pdf"><?php echo $usuario['complemento'] ?></td>
                <td class="td_pdf"><?php echo $usuario['numero'] ?></td>
            </tr>
            <tr class="tr_pdf">
            <td class="td_pdf center" colspan="5"><h2>Pedido</h2></td>
            </tr>
                
			<?php
			
            foreach ($pedidos as $key => $value) {
                
                   if($value['usuario_id'] == $usuario['id']){

                       $consumido = MySql::conectar()->prepare("SELECT * FROM `tb_admin.consumido` WHERE id = ? ");
                       $consumido->execute(array($value['usuario_id']));
                       $consumido = $consumido->fetchAll();
                       $estoque = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
                       $estoque->execute(array($value['produto_id']));
                       $estoque = $estoque->fetch()['nome'];
                       $pedido_id = $value['id'];
                       $loja_id = $value['loja_id'];
                       $usuario_id = $value['usuario_id'];
                       if($value['promocao'] != 0){
                           $valor = $value['quantidade'] * $value['promocao'];
                       }else{
                       $valor = $value['quantidade'] * $value['preco'];
                       }
                       foreach ($consumido as $key => $usuario) {
                ?>

               <tr>


                   <td class="td_pdf" >Produto: <?php echo $estoque;  ?></td>
                   <td class="td_pdf" >Quantidade: <?php echo $value['quantidade']; ?></td>
                   <td class="td_pdf" >Tamanho: <?php echo $value['tamanho']; ?></td>
                   <td class="td_pdf" >Cor: <?php echo $value['cor']; ?></td>
                   <td class="td_pdf" >Total: R$ <?php echo Painel::convertMoney($valor); ?></td>
                   
               </tr>
           
           <?php } } } ?>
        </table>

         <p style="color:red;">ATENÇÃO: todos os pedidos acima não são a confirmação de pagamentos é só uma forma de mostra os detalhes de cada cliente com todos os produtos a ser enviado individual. Certifique que todos os pedidos foram pagos em sua plataforma de pagamento preferido.</p>   
<?php } ?>