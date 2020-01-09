<?php include "agenda.php"; ?>
<main class="app">

<?php echo $_SESSION['cargo']; ?>
<div class="suite-container">

<?php
$consultas = consultar ("detalhes");
$i=1;
foreach($consultas as $consulta){
$i++;
$id_quarto = $consulta["id"];

?>


<!--Inicia Suite -->
                <div class="suite" onclick="mostraModal('modal<?php echo $i; ?>','<?php echo $i-1; ?>','<?php echo $id_quarto ?>')">
                <a> 
                <div class="suite-content">
                        <p><?php echo $consulta["detalhes_descricao"]; ?> </p>
                       <?php if($consulta["detalhes_status"]==0){?>
                        <img class="icon" src="_img/2-IconeLivre.png" alt="">
                        <?php }elseif($consulta["detalhes_status"]==1){ ?>
                            <img class="icon" src="_img/1-IconeOcupado.png" alt="">
                        <?php } ?>
                    </div>
                </a>
                </div>      
         <!-- Finaliza Suite -->
         
        
<?php
    }
    ?>
            </div>

</main>

    </div>

    <?php

//CONSULTA TODOS OS QUARTOS CRIADOS NO BANCO DE DADOS
$consultas = consultar ("detalhes");
$i=1;

foreach($consultas as $consulta){
    $i++;
    $id_quarto = $consulta["id"];
    $num_quarto = $consulta["detalhes_numero"];
    $status = $consulta["detalhes_status"];
    $url = $_SERVER['PHP_SELF'];
?>
<!-- Modal -->
<div id="modal<?php echo $i; ?>" class="modal" oncontextmenu="return false" ondragstart="return false" onselectstart="return false" >
  <!-- Modal conteudo -->
  <div class="modal-container">
<!-- modal header -->
      <div class="modal-header">

          <div class="modal-header-1">
          <a><span id="modal-edit" class="editar_modal" onclick="editaInput(<?php echo $i; ?>)"><img src="_img/2-IconeEditar.png" alt=""></span></a>
          <a><span id="modal-edit" class="criar_reserva" onclick="criarReserva(<?php echo $i; ?>)"><img src="_img/8-IconeAdicionar.png" alt=""></span></a>
          </div>
          <div class="modal-header-2">
                <p id="modal-title"><?php echo $consulta["detalhes_descricao"]; ?></p>
          </div>
          <div class="modal-header-3">
                <span class="right close" onclick="fechaModal('modal<?php echo $i; ?>')"><img src="_img/1-IconeFechar.png" alt=""></span>
          </div>
      </div>
<!-- /modal header -->





<!-- modal body -->
            <form id="modal-form" action="op_reserva.php" autocomplete="off" method="post" onsubmit="return validaForm(<?php echo $i; ?>)">
            <div class="modal-body">         
            <center>   <span style="color: red;" class="erro">Insira os dados abaixo!</span></center>
            <center>   <span style="color: red; margin-bottom: 4px;" class="dados">Insira os dados abaixo!</span></center>

            <input type="hidden"  name="opcao" class="opcao">
            <input type="hidden" value='<?php echo $id_quarto; ?>' name="id_quarto">
            <input type="hidden" value='' name="id_reserva" class="id_reserva">
            <input type="hidden" value='<?php echo $url; ?>' name="url">
            <label for="modal-name">Nome: </label>
            <input id="modal-name" class="input-readonly" type="text" name="nome" required readonly>
            <br>
            <label for="modal-rg">CPF:</label>
            <input id="modal-rg"  class="input-readonly cpf" type="number" name="cpf" size="12" maxlength="11" style="color:white; margin-top:4px; margin-bottom: 4px; height: 20px;  border: none;" required readonly>
            <br>

           
            <label for="modal-rg">Telefone:</label>
            <input id="modal-rg" class="input-readonly tel" type="text" name="telefone" required readonly>
            <br>
            <label for="modal-valor">Valor: R$</label>
            <input id="modal-valor" class="input-readonly valor" type="number" name="valor" style="margin-top:3px; height: 20px; border: none; color:white;" required readonly>
            <br>Qtd Hospedes:

            <input class="num_hospedes input"  style="background-color: rgba(0,0,0,.3); width: 50px; height: 20px; color: white; border:none; margin-top: 7px;" type="number" name="num_hospedes" style="width:20%;" min=0 max=5 required><br>

            <br/>


<center><?php
//pega data atual para usar no input de data como data minima
date_default_timezone_set('America/Sao_Paulo');
$data_atual = date('Y-m-d');
 ?>
 
           <input style="height:30px; background-color: rgba(0,0,0,.3);border:none;color:#fff;float: left; color: black; margin-right: 10px; width: 40%; color:white;" class="data_inicial input" type="date" name="data_inicial" min="<?php echo $data_atual; ?>" required>

           <input style="height:30px; background-color: rgba(0,0,0,.3);border:none;color:#fff;float: left; color: black; width: 40%; color:white;" class="data_final input" type="date" name="data_final" min="<?php echo $data_atual; ?>" required><br/>
</center><br/>
           <script>

//MASCARA PARA TELEFONE E CELULAR NO FORMULARIO COLOCANDO TRAÇOS E PARENTESES
$(document).ready(function(){
    var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

$('.tel').mask(SPMaskBehavior, spOptions);

});

// $('.valor').mask('00000000000000000', {reverse: true});


</script>
















<a class="anterior" style="width:50%; float:left;" onclick="VoltaMes(<?php echo $num_quarto; ?>,<?php echo $i-1; ?>)" >&#8592;Mês anterior</a>
<a class="proximo" style="width:50%; float: right; text-align:right;" onclick="ProximoMes(<?php echo $num_quarto; ?>, <?php echo $i-1; ?>)" >Próximo Mês &#8594;</a>
<br/>



            <div class="calendario" class="marg10" style="margin-top: 10px;">


            </div>
            <script>
            $('.calendario').unbind('click');
            </script>
            <center><div class="lds-dual-ring loader"  class="marg10" style=""></div></center>


















            <!-- provisorio -->
            <br>
            <label for="modal-desc">Alguma informacao adicional?</label>
            <textarea name="info-adicionais" id="modal-desc" class="marg10 info-adicionais input" cols="30" rows="7" ></textarea>
    </div>
<!-- /modal body -->

<!-- modal footer -->
        <div class="modal-footer">
            <div class="modal-footer-1">
            <button class="btn_modal btn_Reserva" id="btn_Reserva" type="submit">Reservar</button>
            <button class="btn_modal btn_EditaReserva" id="btn_Reserva" type="submit">Editar Reserva</button>
            <a class="btn_modal btn_ExcluiReserva" id="btn_Check-out" href=""><center>Excluir</center> </a>
            </div>
            <div class="modal-footer-2">
           

            </div>
            <div class="modal-footer-3">
                <a class="btn_modal btn_Checkin" style="text-align: center; display:block;" id="btn_Check-in" href="status_quarto.php?opcao=status&num_quarto=<?php echo $num_quarto; ?>">Check-in</a>
           
                <a class="btn_modal btn_Checkout" id="btn_Check-out" href="status_quarto.php?opcao=status&num_quarto=<?php echo $num_quarto; ?>"><center>Check-out</center></a>
   
            </div>
            <div class="modal-footer-4">

            </div>
        </div>
        
        </form>

<!-- /modal footer -->
    </div>
  </div>
<!-- /modal -->
    <div id="modal-reserva">
        <div class="modal-container">
            <span class="right close"><img src="_img/1-IconeFechar.png" alt=""></span>
        </div>
    </div>

    <?php } ?>


   