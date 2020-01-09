<?php
include "Model/crud.php";

if(isset($_POST['opcao']))
$op=filter_input(INPUT_POST,'opcao',FILTER_SANITIZE_SPECIAL_CHARS);


if(isset($_GET['opcao']))
$op=filter_input(INPUT_GET,'opcao',FILTER_SANITIZE_SPECIAL_CHARS);

if(isset($_GET['id_reserva']))
$id_reserva=filter_input(INPUT_GET,'id_reserva',FILTER_SANITIZE_SPECIAL_CHARS);


if(isset($_POST['id_quarto'])){
$nome=filter_input(INPUT_POST,'nome',FILTER_SANITIZE_SPECIAL_CHARS);
$cpf=filter_input(INPUT_POST,'cpf',FILTER_SANITIZE_SPECIAL_CHARS);
$telefone=filter_input(INPUT_POST,'telefone',FILTER_SANITIZE_SPECIAL_CHARS);
$url = filter_input(INPUT_POST,'url',FILTER_SANITIZE_SPECIAL_CHARS);
$id_quarto = filter_input(INPUT_POST,'id_quarto',FILTER_SANITIZE_SPECIAL_CHARS);
$valor = filter_input(INPUT_POST,'valor',FILTER_SANITIZE_SPECIAL_CHARS);
$data_inicial = filter_input(INPUT_POST,'data_inicial',FILTER_SANITIZE_SPECIAL_CHARS);
$data_final = filter_input(INPUT_POST,'data_final',FILTER_SANITIZE_SPECIAL_CHARS);
$num_hospedes = filter_input(INPUT_POST,'num_hospedes',FILTER_SANITIZE_SPECIAL_CHARS);
$info_adicionais = filter_input(INPUT_POST,'info-adicionais',FILTER_SANITIZE_SPECIAL_CHARS);
$id_reserva =  filter_input(INPUT_POST,'id_reserva',FILTER_SANITIZE_SPECIAL_CHARS);

}




//Consulta os dados do cliente vinculado a reserva
if($op=='select'){
$consulta = selecionar("SELECT *,q.id as id_reserva FROM cliente as c RIGHT JOIN quartos as q on c.id = q.fk_cliente_nome LEFT JOIN detalhes as d on d.detalhes_numero=q.fk_detalhes_numero  WHERE q.id='$id_reserva'");

echo json_encode($consulta);
}




if($op=='delete'){

    
   $op = deletar("quartos","id=$id_reserva");

  
        if($op){
            print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
            <script type = 'text/javascript'> alert ('Reserva Apagada com Sucesso!') </script>";
        }
        else{
            print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
            <script type = 'text/javascript'> alert ('ERRO 200: OS DADOS NAO FORAM INSERIDOS!') </script>";
        }


}

//caso seja passado insert na url no opcao = insert, ele insere os dados da reserva no banco
if($op=='insert'){
    $url = filter_input(INPUT_POST,'url',FILTER_SANITIZE_SPECIAL_CHARS);


    if(empty($_POST['nome']) || empty($_POST['cpf']) || empty($_POST['telefone'])){
    
        echo "Deu ruim alguma coisa ai, algum campo vazio";
     
        //echo "<script>alert('O nome de usuario que você \n Digitou já existe tente outro!');</script>";
        // header("Location: $url");
        exit();   
    }   
    
 //armazena dados do cliente
    $array_clientes = array(
        "cliente_nome" => $nome,
        "cliente_cpf" => $cpf,
        "cliente_telefone" => $telefone
    );
    

//Inicia uma transação para que não aconteça nada no meio do caminho(outra pessoa tentar ao mesmo tempo)
    executar("START TRANSACTION;");
    // insere os dados do cliente
    
   $transacao = inserir("cliente",$array_clientes);
   $consulta = consultar("cliente ORDER BY id DESC"); 
  $ultimo_id= $consulta[0]["id"];
   

$array_reserva = array(
    "fk_detalhes_descricao" => $id_quarto,   
    "fk_detalhes_numero" => $id_quarto,   
    "fk_cliente_nome" => $ultimo_id,
   "quartos_data_entrada"=> $data_inicial,
   "quartos_data_saida"=> $data_final,
   "quartos_valor" => $valor,
   "quartos_info_adicionais" => $info_adicionais,
   "quartos_qtd_hospedes" => $num_hospedes
);
   $transacao = inserir("quartos",$array_reserva);


   executar("COMMIT;");
   if($transacao){
    print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
    <script type = 'text/javascript'> alert ('Reserva Feita com Sucesso!') </script>";
}
else{
    print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
    <script type = 'text/javascript'> alert ('ERRO 200: OS DADOS NAO FORAM INSERIDOS!') </script>";

}
}

if($op=='update'){
    $url = filter_input(INPUT_POST,'url',FILTER_SANITIZE_SPECIAL_CHARS);


    if(empty($_POST['nome']) || empty($_POST['cpf']) || empty($_POST['telefone'])){
    
        echo "Deu ruim alguma coisa ai, algum campo vazio";
     
        //echo "<script>alert('O nome de usuario que você \n Digitou já existe tente outro!');</script>";
        // header("Location: $url");
        exit();   
    }   
    
 //armazena dados do cliente
    $array_clientes = array(
        "cliente_nome" => $nome,
        "cliente_cpf" => $cpf,
        "cliente_telefone" => $telefone
    );
    

//Inicia uma transação para que não aconteça nada no meio do caminho(outra pessoa tentar ao mesmo tempo)
    executar("START TRANSACTION;");
    // insere os dados do cliente
   
echo $id_reserva;
$array_reserva = array(
   "quartos_data_entrada"=> $data_inicial,
   "quartos_data_saida"=> $data_final,
   "quartos_valor" => $valor,
   "quartos_info_adicionais" => $info_adicionais,
   "quartos_qtd_hospedes" => $num_hospedes
);
$transacao = alterar("quartos",$array_reserva,"id='$id_reserva'");
$consulta = consultar("quartos","id='$id_reserva'");
echo $id_cliente = $consulta[0]["fk_cliente_nome"];
$transacao = alterar("cliente",$array_clientes,"id='$id_cliente'");


    

    
   
   executar("COMMIT;");
    if($transacao){
        print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
        <script type = 'text/javascript'> alert ('Reserva Editada com Sucesso!') </script>";
    }
    else{
        print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url'>
        <script type = 'text/javascript'> alert ('ERRO 200: OS DADOS NAO FORAM EDITADOS!') </script>";
 
    }

}

