<?php session_start() ; //inicia uma sessão ?>
<!-- HEAD -->
<!DOCTYPE html>
<html lang="pt-br"><!-- dis em que lingua a pagina foi escrita -->
<head>
    <meta charset="UTF-8"><!-- avisa para usar a encodificacao utf-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- define o tamando da pagina como o tamanho do device -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><!-- forca o browser a renderizar essa versao especifica -->
    <link href="_css/style.css"  rel="stylesheet"><!-- link do arquivo CSS -->
    <title>Canto Sul</title><!-- titulo da aba -->
</head>
<!-- HEAD end -->
<body class="login">
<!-- logo -->
    <div class="logo">
        <img src="_img/LogoCantoSul.png" alt="">
    </div>
<!-- /logo -->
<!-- login -->
    <div class="login">
<!-- span -->
<div id="senhaIncorreta">
       <?php  
              if(isset($_SESSION['msg'])){// caso tenha uma sessão startada com o nome 'msg' será utilizada e mostrara a mensagem que foi dada a ele  
              echo $_SESSION['msg']; //mostra a mensagem
              unset($_SESSION['msg']); // apaga a mensagem da sessão para quando recarregar a pagina nao aparecer mais esta mensagem
              }
       ?>   
        </div>
<!-- /span -->
<!-- form -->
<form action="valida.php" method="POST"><!-- formulario de login -->
    <!-- campo email -->
            <div class="login-input"><!-- container do input de email -->
                
                <div class="login-input-icon left"><!-- container do icone esquerdo -->
                    <img src="_img/1-IconePerfil.png" alt=""><!-- icone de perfil -->
                </div>
                <input id="login-input-email" placeholder="Usuário" type="text" name="usuario"><!-- campo de email -->
                <div class="login-input-icon right"><!-- container do incone direito -->
                        <!-- vazio -->
                </div>
            </div>
    <!-- /campo email -->
    <!-- campo senha -->
            <div class="login-input"><!-- container do imput de senha -->
                <div class="login-input-icon left"><!-- container do icone esquerdo -->
                    <img src="_img/2-IconeCadeado.png" alt=""><!-- icone da imagem do cadeado -->
                </div>
                <input id="login-input-password" placeholder="Senha" type="password" name="senha" >
                    <div class="login-input-icon right"><!-- container do icone direito -->
                        <input id="show-password" type="checkbox" onclick="showpasswd()"><!-- checkbox com a funcao mostrarSenha -->
                        <label for="show-password"><!-- rotulo do checkbox -->
                            <img src="_img/3-IconeOlho.png" alt=""><!-- icone da imagem do olho -->
                        </label>
                    </div>
            </div>
    <!-- /campo senha -->
    <!-- link esqueceu senha -->
            




            <!-- <div id="esqueceu-senha">
                <a href="#">Esqueceu senha?</a>
            </div> -->




    <!-- link esqueceu senha -->
    <!-- botao login -->
             <div class="login-button">
                <input id="button" type="submit" name="btnLogin" value="Login">
            </div>
    <!-- botao login -->
        </form>
<!-- /form -->
    </div>
<!-- login -->
    <script src="./_Js/script_login.js"></script>
</body>
</html>