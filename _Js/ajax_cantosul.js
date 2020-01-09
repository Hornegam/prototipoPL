//ESSAS VARIAVEIS SÃO GLOBAIS PARA ANDAR PELO CALENDARIO AO CLICAR EM PŔOXIMO OU ANTERIOR
var hoje = new Date();
var mostra_mes = (hoje.getMonth()+1);
var mostra_ano = hoje.getFullYear();

//PULA UM MES PARA FRENTE NO CALENDARIO QUANDO É CHAMADA
function ProximoMes(num_quarto, num_modal){
  console.log("Proximo Mes Modal: "+num_modal);
  console.log("Proximo Mes Quarto: "+num_quarto);

  mostra_mes++;
     if(mostra_mes<10){
      mostra_mes = '0'+mostra_mes;
     }
     if(mostra_mes>12){
      mostra_mes = '01';
      mostra_ano++;
     }

     var url = "agenda.php?mes="+mostra_mes+"&ano="+mostra_ano+"&quarto="+num_quarto+"&modal="+num_modal;
     $.post(url, function(result) {
       	$(".calendario").html(result); // Só pra verificar retorno
       });
    }



//PULA UM MES PARA TRAS NO CALENDARIO QUANDO É CHAMADA
    function VoltaMes(num_quarto, num_modal){
      mostra_mes--;
     if(mostra_mes<10){
      mostra_mes = '0'+mostra_mes;
     }
     if(mostra_mes<1){
      mostra_mes = '12';
      mostra_ano--;
     }

     var url = "agenda.php?mes="+mostra_mes+"&ano="+mostra_ano+"&quarto="+num_quarto+"&modal="+num_modal;
     $.post(url, function(result) {
       	$(".calendario").html(result); // Só pra verificar retorno
       });
    }


    function MostraCalendario(num_quarto, num_modal){
      mostra_mes = (hoje.getMonth()+1);
      mostra_ano = hoje.getFullYear();
      console.log("Numero Quarto: "+num_quarto);
      console.log("Numero Modal: "+num_modal);
      
var url = "agenda.php?mes="+mostra_mes+"&ano="+mostra_ano+"&quarto="+num_quarto+"&modal="+num_modal;
	$.post(url, function(result) {
       	$(".calendario").html(result); // Resultado do calendario 
       });
   
       $(".calendario").html(""); // Resultado do calendario 

      }







// quando clica na suite abre o modal
function mostraModal(modal,pos,id_quarto) {
//reseta o calendario para mostrar o Mês Atual
// document.getElementsByClassName("calendario")[pos].style.display = "block";
num_modal = pos;
pos--;
console.log(pos);
document.getElementsByClassName("loader")[pos].style.display = "block";
document.getElementsByClassName("calendario")[pos].style.display = "none";
document.getElementsByClassName("anterior")[pos].style.display = "none";
document.getElementsByClassName("proximo")[pos].style.display = "none";

    document.getElementById(modal).style.display = "block";
    //  document.getElementById("modal-title").innerHTML="Quarto 1";

  var inputs = document.getElementsByClassName("input-readonly").length;
  inputClass = document.getElementsByClassName("input-readonly");
  // for (var i = 0; i < inputs; i++) {
  //   inputClass[i].readOnly = false;
  //   inputClass[i].classList.add("input-edit");
  // }
  for (var i = 0; i < inputs; i++) {
    inputClass[i].readOnly = true;
    inputClass[i].value="";
    inputClass[i].classList.remove("input-edit");

  }
  MostraCalendario(id_quarto,num_modal);
  document.getElementsByClassName("loader")[pos].style.display = "none";
  document.getElementsByClassName("calendario")[pos].style.display = "block";
  document.getElementsByClassName("anterior")[pos].style.display = "block";
  document.getElementsByClassName("proximo")[pos].style.display = "block";
  document.getElementsByClassName("dados")[pos].style.display = "none";
  document.getElementsByClassName("btn_ExcluiReserva")[pos].style.display = "none";
  document.getElementsByClassName("editar_modal")[pos].style.display = "none";
  document.getElementsByClassName("btn_Checkin")[pos].style.display="none";
  document.getElementsByClassName("btn_EditaReserva")[pos].style.display="none";
  document.getElementsByClassName("btn_Reserva")[pos].style.display="none";
  document.getElementsByClassName("num_hospedes")[pos].value="";
  document.getElementsByClassName("data_inicial")[pos].value="";
  document.getElementsByClassName("data_final")[pos].value="";
  document.getElementsByClassName("info-adicionais")[pos].value="";

  document.getElementsByClassName("criar_reserva")[pos].style.display="block";
  document.getElementsByClassName("opcao")[pos].value="insert";

  document.getElementsByClassName("num_hospedes")[pos].readOnly=true;
  document.getElementsByClassName("num_hospedes")[pos].style.disṕlay="block"
  document.getElementsByClassName("data_inicial")[pos].style.display="none";
  document.getElementsByClassName("data_final")[pos].style.display="none";
  info_adicionais = document.getElementsByClassName("info-adicionais")[pos].readOnly=true;

  document.getElementsByClassName("erro")[pos].innerHTML="";

  
  
console.log("Quarto:"+id_quarto)
$.ajax({
    url: 'op_status_quarto.php?num_quarto='+id_quarto,
    type: 'post',    
    dataType: 'json',
    data: status,
    success: function(response){
             
       $.each(response,function(key,value){
        console.log("status:"+value.detalhes_status);
        if(value.detalhes_status==1){
        document.getElementsByClassName("btn_Checkout")[pos].style.display="block";
        }else{
          document.getElementsByClassName("btn_Checkout")[pos].style.display="none";
        
        }

});
           
          
    }
  });

}

  // quando clica no 'x', fecha o modal
function fechaModal(modal) {
    document.getElementById(modal).style.display = "none";
  }

function cadastraReserva(){
    jQuery(document).ready(function(){
		jQuery('#modal-form').submit(function(){
			var dados = jQuery( this ).serialize();

			jQuery.ajax({
				type: "POST",
                url:'op_reserva.php?opcao=insert',
				data: dados,
				success: function( data )
				{
					alert( data );
				}
			});
			
			return false;
		});
	});

}

function consultaReserva(id_reserva, pos){
    //var busca = $("#busca").val();
    limpaInputs();
    $.ajax({
    url: 'op_reserva.php?id_reserva='+id_reserva+'&opcao=select',
    type: 'post',    
    dataType: 'json',
    data: id_reserva,
    success: function(response){
        // $('.modal-body').empty();
       var formulario;
      
       $.each(response,function(key,value){
        i = pos;
        pos = pos*4;
        var inputs = document.getElementsByClassName("input-readonly");
        //Irá inserir os dados com o ajax sobre a reserva especifica e também irá liberar o campo para editar
        document.getElementsByClassName("editar_modal")[i-1].style.display = "block";
        //libera o campo para edicao
        inputs[pos-4].readOnly=true;
        //libera o remove a classe com fundo claro
        inputs[pos-4].classList.remove("input-edit");
        //adiciona o valor da consulta no input
        inputs[pos-4].value=value.cliente_nome;
        
        inputs[pos-3].readOnly=true;
        inputs[pos-3].classList.remove("input-edit");
        inputs[pos-3].value=value.cliente_cpf;
        
        inputs[pos-2].readOnly=true;
        inputs[pos-2].classList.remove("input-edit");
        inputs[pos-2].value=value.cliente_telefone;
        
        inputs[pos-1].readOnly=true;
        inputs[pos-1].classList.remove("input-edit");
        inputs[pos-1].value=value.quartos_valor;
        document.getElementsByClassName("num_hospedes")[i-1].value=value.quartos_qtd_hospedes;
        document.getElementsByClassName("data_inicial")[i-1].value=value.quartos_data_entrada;
        document.getElementsByClassName("data_final")[i-1].value=value.quartos_data_saida;
        document.getElementsByClassName("info-adicionais")[i-1].value=value.quartos_info_adicionais;
        document.getElementsByClassName("id_reserva")[i-1].value=value.id_reserva;
        console.log("Reserva: "+value.id_reserva)
        var dNow = new Date();
  if(dNow.getDate()<10)
  var dia = '0'+dNow.getDate()
  else
  var dia = dNow.getDate()

         var diaAtual = dNow.getFullYear() + '-' + (dNow.getMonth()+1) + '-' + dia;

         console.log("Dia Atual: "+diaAtual);

         console.log('Data Entrada: '+value.quartos_data_entrada +"Data Saida:"+value.quartos_data_saida);
         console.log('Botão de Checkin'+diaAtual>=value.quartos_data_entrada && diaAtual<=value.quartos_data_saida && value.detalhes_status==0);

 document.getElementsByClassName("btn_EditaReserva")[i-1].style.display="none";
 document.getElementsByClassName("btn_Reserva")[i-1].style.display="none";
 document.getElementsByClassName("btn_ExcluiReserva")[i-1].style.display="block";
 document.getElementsByClassName("btn_ExcluiReserva")[i-1].href="op_reserva.php?opcao=delete&id_reserva="+value.id_reserva;
 document.getElementsByClassName("criar_reserva")[i-1].style.display="none";
 document.getElementsByClassName("data_inicial")[i-1].style.display="block";
 document.getElementsByClassName("data_final")[i-1].style.display="block";
 document.getElementsByClassName("data_inicial")[i-1].readOnly=true;
 document.getElementsByClassName("data_final")[i-1].readOnly=true;
 
 
 if(diaAtual>=value.quartos_data_entrada && diaAtual<=value.quartos_data_saida && value.detalhes_status==0){
    document.getElementsByClassName("btn_Checkin")[i-1].style.display="block";
  
}else{
    document.getElementsByClassName("btn_Checkin")[i-1].style.display="none";

}
if(value.detalhes_status==1){
  document.getElementsByClassName("btn_Checkout")[i-1].style.display="block";
}else{
  document.getElementsByClassName("btn_Checkout")[i-1].style.display="none";

}

});
           
          
    }
  });
}



function limpaInputs(){
  var inputs = document.getElementsByClassName("input-readonly");
  var inputs1 = document.getElementsByClassName("input");
  
      
      
   for(var i=0; i<inputs.length;i++){
     inputs[i].value="";
     
   }

   for(var i=0; i<inputs1.length;i++){
    inputs1[i].value="";
    
  }

  console.log("Todos os campos foram limpos");   
}







function editaInput(pos){
  var inputs = document.getElementsByClassName("input-readonly").length;
  inputClass = document.getElementsByClassName("input-readonly");
  document.getElementsByClassName("dados")[pos-2].style.display = "block";
  document.getElementsByClassName("btn_EditaReserva")[pos-2].style.display="block";
  document.getElementsByClassName("btn_Reserva")[pos-2].style.display="none";
  document.getElementsByClassName("editar_modal")[pos-2].style.display = "none";
  document.getElementsByClassName("btn_Checkin")[pos-2].style.display="none";
  document.getElementsByClassName("btn_Checkout")[pos-2].style.display="none";
  document.getElementsByClassName("calendario")[pos-2].style.display = "block";
  document.getElementsByClassName("btn_ExcluiReserva")[pos-2].style.display="none";
  document.getElementsByClassName("opcao")[pos-2].value="update";

  document.getElementsByClassName("data_inicial")[pos-2].readOnly=false;
  document.getElementsByClassName("data_final")[pos-2].readOnly=false;
  for (var i = 0; i < inputs; i++) {
    inputClass[i].readOnly = false;
    inputClass[i].classList.add("input-edit");
  }
  info_adicionais = document.getElementsByClassName("info-adicionais")[pos-2].readOnly=false;
  
  document.getElementsByClassName("num_hospedes")[pos-2].readOnly=false;
  document.getElementsByClassName("data_inicial")[pos-2].style.display="block";
  document.getElementsByClassName("data_final")[pos-2].style.display="block";
  
  document.getElementsByClassName("opcao")[pos-2].value="update";
  
  }



function criarReserva(pos){
  var inputs = document.getElementsByClassName("input-readonly").length;
  inputClass = document.getElementsByClassName("input-readonly");
  document.getElementsByClassName("dados")[pos-2].style.display = "block";
  document.getElementsByClassName("btn_EditaReserva")[pos-2].style.display="none";
  document.getElementsByClassName("btn_Reserva")[pos-2].style.display="block";
  document.getElementsByClassName("editar_modal")[pos-2].style.display = "none";
  document.getElementsByClassName("btn_Checkin")[pos-2].style.display="none";
  document.getElementsByClassName("btn_Checkout")[pos-2].style.display="none";
  document.getElementsByClassName("calendario")[pos-2].style.display = "none";
  document.getElementsByClassName("calendario")[pos-2].style.display = "block";
  document.getElementsByClassName("btn_ExcluiReserva")[pos-2].style.display="none";
  document.getElementsByClassName("criar_reserva")[pos-2].style.display="none";
  document.getElementsByClassName("data_inicial")[pos-2].style.display="block";
  document.getElementsByClassName("data_final")[pos-2].style.display="block";
  
  document.getElementsByClassName("data_inicial")[pos-2].readOnly=false;
  document.getElementsByClassName("data_final")[pos-2].readOnly=false;
  for (var i = 0; i < inputs; i++) {
    inputClass[i].readOnly = false;
    inputClass[i].classList.add("input-edit");
  }
  info_adicionais = document.getElementsByClassName("info-adicionais")[pos-2].readOnly=false;
  document.getElementsByClassName("num_hospedes")[pos-2].readOnly=false;
  
  
  }






  //Validor para verificar se CPF é válido, se for válido retorna verdadeiro
	function ValidaCPF(strCPF,pos) {
		var Soma, Resto, borda_original;
		Soma = 0;
		
		if (strCPF == "00000000000"){

      return false;
		}
		
		for (i=1; i<=9; i++){
			Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
		}
		
		Resto = (Soma * 10) % 11;
		if ((Resto == 10) || (Resto == 11)){
			Resto = 0;
		}
		
		if (Resto != parseInt(strCPF.substring(9, 10))){
			return false;
		}
		
		Soma = 0;
		for (i = 1; i <= 10; i++){
			Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
		}
		
		Resto = (Soma * 10) % 11;
		if ((Resto == 10) || (Resto == 11)){
			Resto = 0;
		}
		
		if (Resto != parseInt(strCPF.substring(10, 11))){

return false;
    }
    
		return true;
  }





  
//Valida a data para verificar se a Data inicial é menor do que a final, se for maior deve ser retornado como falso
function validaDatas(pos){
    var dataInicial = new Date($("input[name='data_inicial']").val());
    var dataFinal = new Date($("input[name='data_final']").val());
    if (!dataInicial || !dataFinal) return false;
    if (dataInicial >= dataFinal) {
        return false;
    } else {
      document.getElementsByClassName("erro")[pos-2].innerHTML="";
        return true
    }
}


//Valida Formuário - Essa função chama todas as funçoes de validaçoes para colocar no topo do formulário no 'onsubmit' 
function validaForm(pos){

  var cpf = document.getElementsByClassName("cpf")[pos-2].value;
  console.log("CPF: "+ cpf);
  var validaCPF = ValidaCPF(cpf,pos);
    if(!validaCPF){
     alert("Cpf Inválido!")
      document.getElementsByClassName("erro")[pos-2].innerHTML="Cpf Inválido!";
    }
    validaDatas(pos);
  if(!validaDatas(pos)){
    document.getElementsByClassName("erro")[pos-2].innerHTML="Data inicial deve ser menor que a final";
  }else{
    document.getElementsByClassName("erro")[pos-2].innerHTML="";
  }

  if(validaDatas(pos) && ValidaCPF(cpf,pos)){
    return true;
  }
  return false;

}



