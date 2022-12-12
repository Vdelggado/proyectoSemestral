<?php
session_start();
require_once('../class/funciones.php');
    if(isset($_POST['enviar'])){
        $descripcion = $_POST['descripcion'];
        $monto = floatval($_POST['monto']);
        $tipo = $_POST['tipo'];
        
        $funciones = new Funciones();
        foreach($tipo as $resultado){
            if($resultado == 'ingreso'){
                $funciones->insertarIngreso($descripcion,$monto);

            }else{
                $funciones->insertarEgreso($descripcion,$monto);
            }
        }
        header('Location: ../index.php');
        
    }

?>