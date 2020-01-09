<?php
require_once 'Model/crud.php';
session_start();
if(!empty($_SESSION['id'])){
}else{
	$_SESSION['msg'] = "Área restrita";
	header("Location: index.php");	
	exit();

}
