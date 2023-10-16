<?php
use Microblog\Usuario;
require_once "../vendor/autoload.php";
$usuarios = new Usuario;
$usuarios->setId($_GET['id']);
$usuarios->excluirUsuario();
header('location:usuarios.php')
?>