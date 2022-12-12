<?php 
session_start();
require_once('../class/funciones.php');
$funciones = new Funciones();
if($_GET['tipo']== "ingreso"){
    $eliminado = $funciones->eliminarIngreso($_GET['id']);
}else{

    $eliminado = $funciones->eliminarEgreso($_GET['id']);
}

header('Location: ../index.php');
?>
