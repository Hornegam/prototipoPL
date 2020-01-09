<?php
 require_once "Model/crud.php";

function MostreSemanas() {
	$semanas = "DSTQQSS";
	for( $i = 0; $i < 7; $i++ )
	 echo "<td class='semanas-td' >".$semanas{$i}."</td>";
}
 
function GetNumeroDias( $mes )
{
	$numero_dias = array( 
			'01' => 31, '02' => 28, '03' => 31, '04' =>30, '05' => 31, '06' => 30,
			'07' => 31, '08' =>31, '09' => 30, '10' => 31, '11' => 30, '12' => 31
	);
 
	if (((date('Y') % 4) == 0 and (date('Y') % 100)!=0) or (date('Y') % 400)==0)
	{
	    $numero_dias['02'] = 29;	// altera o numero de dias de fevereiro se o ano for bissexto
	}
 
	return $numero_dias[$mes];
}
 
function GetNomeMes( $mes )
{
     $meses = array( '01' => "Janeiro", '02' => "Fevereiro", '03' => "Março",
                     '04' => "Abril",   '05' => "Maio",      '06' => "Junho",
                     '07' => "Julho",   '08' => "Agosto",    '09' => "Setembro",
                     '10' => "Outubro", '11' => "Novembro",  '12' => "Dezembro"
                     );
 
      if( $mes >= 01 && $mes <= 12)
        return $meses[$mes];
 
        return "Mês deconhecido";
 
}
 
 
 
function MostreCalendario( $mes,$ano, $modal, $id_reserva  )
{
 
	$numero_dias = GetNumeroDias( $mes );	// retorna o número de dias que tem o mês desejado
	$nome_mes = GetNomeMes( $mes );
	$diacorrente = 0;	
	$diasemana = jddayofweek( cal_to_jd(CAL_GREGORIAN, $mes,"01",$ano) , 0 );	// função que descobre o dia da semana
    echo $nome_mes."-".$ano;
	echo "<table id='calendarioID'  border = 0 cellspacing = '0' align = 'center'>";
	 echo "<tr>";
	 echo "</tr>";
	 echo "<tr>";
	   MostreSemanas();	// função que mostra as semanas aqui
	 echo "</tr>";
	 $inicio = 0;

	for( $linha = 0; $linha < 6; $linha++ )
	{
 
 
	   echo "<tr>";
 
	   for( $coluna = 0; $coluna < 7; $coluna++ )
	   {
		echo "<td class='dia-td'";
 
		 				  	echo " id = 'dia_comum' ";

		  
		echo " align = 'center' valign = 'center'>";
 
 
		   /* TRECHO IMPORTANTE: A PARTIR DESTE TRECHO É MOSTRADO UM DIA DO CALENDÁRIO (MUITA ATENÇÃO NA HORA DA MANUTENÇÃO) */
 
		      if( $diacorrente + 1 <= $numero_dias )
		      {
			 if( $coluna < $diasemana && $linha == 0)
			 {
			  	 echo " ";
			 }
			 else
			 {
			     
				 $periodo ="$ano-$mes-".($diacorrente+1);
				  
                if(consultaDiasReservados($modal,$periodo)){
					  
			//PARA TODOS OS IF A COR DO DIA RESERVADO COM ESTÁ STYLE RED
			// O PRIMEIRO IF A DATA FICA COM 'SF' QUE SIGNIFICA QUE A DATA INICIAL É A MESMA DA FINAL
			if(consultaDataFinal($modal,$periodo)==true && consultaDataInicial($modal,$periodo)==true){
				echo "<div class='dia-div-unico'><a onclick=consultaReserva('".consultaDiasReservados($id_reserva,$periodo)."',$modal)  >".($diacorrente+1)."</a></div>";	
			}elseif(consultaDataInicial($modal,$periodo)){		
				// O SEGUNDO IF A DATA FICA COM 'S' QUE SIGNIFICA QUE ESTA É A DATA INICIAL DA RESERVA
			echo "<div class='dia-div-inicio'><a  onclick=consultaReserva('".consultaDiasReservados($id_reserva,$periodo)."',$modal)  >".($diacorrente+1)."</a></div>";	
			}elseif(consultaDataFinal($modal,$periodo)){
				// O SEGUNDO IF A DATA FICA COM 'F' QUE SIGNIFICA QUE ESTA É A DATA FINAL DA RESERVA
				echo "<div class='dia-div-final'><a onclick=consultaReserva('".consultaDiasReservados($id_reserva,$periodo)."',$modal)  >".($diacorrente+1)."</a></div>";	

			}else{
		       //DIA CORRENTE NORMAL
 				echo "<div class='dia-div-meio'><a onclick=consultaReserva('".consultaDiasReservados($id_reserva,$periodo)."',$modal)  >".($diacorrente+1)."</a></div>";	
	
			}
				
				} else{
					 $inicio=0;
	//DIA NORMAL SEM RESERVA NENHUMA  
					 echo "<a onclick=limpaInputs()>".($diacorrente+1)."</a>";
				 }
                                           ++$diacorrente;

             
             }
		      }
		      else
		      {
			break;
		      }
 
		   /* FIM DO TRECHO MUITO IMPORTANTE */
 
 
 
		echo "</td>";
	   }
	   echo "</tr>";
	}
 
	echo "</table>";
}
 
function MostreCalendarioCompleto()
{
	    echo "<table align = 'center'>";
	    $cont = 1;
	    for( $j = 0; $j < 4; $j++ )
	    {
		  echo "<tr>";
		for( $i = 0; $i < 3; $i++ )
		{
		 
		  echo "<td>";
			MostreCalendario( ($cont < 10 ) ? "0".$cont : $cont );  
 
		        $cont++;
		  echo "</td>";
 
	 	}
		echo "</tr>";
	   }
	   echo "</table>";
}
 
function consultaDiasReservados($quarto,$data){
    // $consultas = consultar("quartos","MONTH(quartos_data_entrada) = 10 AND fk_detalhes_descricao = 1");
        $consultas = selecionar("SELECT * FROM quartos where fk_detalhes_numero='$quarto'");
   $i=0; 
   if($consultas){
     
   foreach($consultas as $consulta){
    $entrada = $consulta["quartos_data_entrada"];
    $saida = $consulta["quartos_data_saida"];
   
   $start = new DateTime($entrada);
    $end = new DateTime($saida);
    $compara = new DateTime($data);

    if($compara>=$start && $compara<=$end){
        return $consulta["id"];
    }
   
}
}

return false;
}

function consultaDataInicial($quarto,$data){
    // $consultas = consultar("quartos","MONTH(quartos_data_entrada) = 10 AND fk_detalhes_descricao = 1");
        $consultas = selecionar("SELECT * FROM quartos where fk_detalhes_numero='$quarto'");
   $i=0; 
   if($consultas){
     
   foreach($consultas as $consulta){
    $entrada = $consulta["quartos_data_entrada"];
    $saida = $consulta["quartos_data_saida"];
   
   $start = new DateTime($entrada);
    $end = new DateTime($saida);
    $compara = new DateTime($data);

    if($start==$compara){
        return true;
    }
   
}
}

return false;
}



function consultaDataFinal($quarto,$data){
    // $consultas = consultar("quartos","MONTH(quartos_data_entrada) = 10 AND fk_detalhes_descricao = 1");
        $consultas = selecionar("SELECT * FROM quartos where fk_detalhes_numero='$quarto'");
   $i=0; 
   if($consultas){
     
   foreach($consultas as $consulta){
    $entrada = $consulta["quartos_data_entrada"];
    $saida = $consulta["quartos_data_saida"];
   
   $start = new DateTime($entrada);
    $end = new DateTime($saida);
    $compara = new DateTime($data);

    if($end==$compara){
        return true;
    }
   
}
}

return false;
}


if(isset($_GET['mes']) && isset($_GET['ano'])){
    $mes = $_GET['mes'];
    $ano = $_GET['ano'];
    $num_quarto = $_GET['quarto'];
    $num_modal = $_GET['modal'];
    MostreCalendario($mes,$ano,$num_modal,$num_quarto);
}













?>