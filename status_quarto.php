<?php
include "Model/crud.php";

$op=filter_input(INPUT_GET,'opcao',FILTER_SANITIZE_SPECIAL_CHARS);
$num_quarto=filter_input(INPUT_GET,'num_quarto',FILTER_SANITIZE_SPECIAL_CHARS);

if($op=='status'){
    $consulta = consultar("detalhes","detalhes_numero=$num_quarto");
   echo  $status =  $consulta[0]["detalhes_status"];
    if($status==1){
     $dados = array( "detalhes_status" => 0);
    }
    if($status==0){
        $dados = array( "detalhes_status" => 1);
        }

    $op = alterar("detalhes",$dados,"detalhes_numero='$num_quarto'");
    if($op){
        header("Location: quartos.php");
    
    }


    }
    
// echo json_encode($consulta);
