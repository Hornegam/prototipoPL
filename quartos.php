<?php include 'validaSessao.php'; ?>
<!-- HEAD -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Canto Sul</title>
    <!-- Adicionando Bibilioteca JQuery e Ajax -->
    <script src="_Js/ajax_jquery.min.js"></script>
    <script src="_Js/jquery-ui.min.js"></script>

    <!-- CSS do Site -->
    <link rel="stylesheet" href="_css/style.css">
    <link rel="stylesheet" href="_css/loader.css">


<!--Adicionando as Bibiliotecas do Formulario de Calendario da Jquery -->
<script src="_Js/jquery-1.8.2.js"></script>
<script src="_Js/jquery-ui.js"></script>

<!--Adicionando as Bibiliotecas para Mascarar as pontuações e traços dos formularios -->
<script src="_Js/mask_jquery.js"></script>
<script src="_Js/funcionalidadesCargo.js"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />

</head>
<!-- HEAD end -->
<body class="app" onload="setFuncionalidades(<?php echo $_SESSION['cargo'] ?>)">
    <div class="container">
     <?php require_once 'includes/header.php'; ?>  

    <?php include 'includes/listagem_modal.php'; ?>
</div> 



<script src="_Js/modal.js"></script>
<script src="_Js/ajax_cantosul.js"></script>
</body>
</html>