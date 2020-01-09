<?php
    session_cache_limiter ('private, must-revalidate');
    $cache_limiter = session_cache_limiter();
    session_cache_expire(60);
    session_start() ;
//Inclui no codigo o CRUD com as consultas e conexoes ao banco de dados
include_once("Model/crud.php");
//Caso tenha clicado em Login ele verifica e filtra para nao ter perigo de modificações via inspeção
$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if($btnLogin){
    //Filtra as informações que chegam do formulario
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    //Verifica se não está Vazio os campos de usuario
    if((!empty($usuario)) AND (!empty($senha))){
    //Filtra novamente informações que chegam do formulario pela bibilioteca do Mysqli
  $usuario = mysqli_real_escape_string(abrirConexao(),$_POST['usuario']);
   $senha = mysqli_real_escape_string(abrirConexao(),$_POST['senha']);
$consultarLogin = consultar("funcionario", "funcionario_usuario='$usuario' AND funcionario_senha= md5('$senha') AND funcionario_ativo=1","id,funcionario_senha,funcionario_usuario,funcionario_nome, funcionario_cargo");


        if($consultarLogin){


				$_SESSION['id'] = $consultarLogin[0]['id'];
				$_SESSION['nome'] = $consultarLogin[0]['funcionario_nome'];
				$_SESSION['email'] = $consultarLogin[0]['funcionario_usuario'];
				$_SESSION['cargo'] = $consultarLogin[0]['funcionario_cargo'];
				header("Location: quartos.php");
                exit();


			}else{
				$_SESSION['msg'] = "Usuario e/ou senha incorretos";
				header("Location: index.php");
                exit();

		}
	}else{
		$_SESSION['msg'] = "Usuario e/ou senha incorretos";
		header("Location: index.php");
        exit();
	}
}else{
	$_SESSION['msg'] = "Página não encontrada";
	header("Location: index.php");
    exit();
}
