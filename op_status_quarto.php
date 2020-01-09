<?php
include "Model/crud.php";

$num_quarto=filter_input(INPUT_GET,'num_quarto',FILTER_SANITIZE_SPECIAL_CHARS);


//Consulta os dados do quarto e seus status
$consulta = selecionar("SELECT detalhes_status FROM detalhes where id='$num_quarto'");
echo json_encode($consulta);

?>