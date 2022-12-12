<?php
 require_once('modelo.php');
class Funciones extends modeloCredencialesBD {
    
    public function mostrarIngresos(){
        $instruccion = "CALL sp_mostrarIngresos()";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if(!$resultado){
            echo "Fallo al mostrar las tareas";
        }else{
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

    public function mostrarEgresos(){
        $instruccion = "CALL sp_mostrarEgresos()";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if(!$resultado){
            echo "Fallo al mostrar las tareas";
        }else{
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }

   public function insertarIngreso($descripcion,$monto){
        $instruccion = "CALL sp_insertar_ingreso('$descripcion','$monto')";
        $consulta = $this->_db->query($instruccion);
        if(!$consulta){
            echo "Fallo al insertar ingreso";
        }else{
            return $consulta;
            $this->_db->close();
        }
    }

    public function insertarEgreso($descripcion,$monto){
        $instruccion = "CALL sp_insertar_egreso('$descripcion','$monto')";
        $consulta = $this->_db->query($instruccion);
        if(!$consulta){
            echo "Fallo al insertar Egreso";
        }else{
            return $consulta;
            $this->_db->close();
        }
    }

    public function eliminarIngreso($id){
        $instruccion = "CALL sp_eliminar_ingreso($id)";
        $consulta = $this->_db->query($instruccion);
        if(!$consulta){
            echo "Fallo al mostrar las tareas";
        }else{
            return $consulta;
            $this->_db->close();
        }
    }

    public function eliminarEgreso($id){
        $instruccion = "CALL sp_eliminar_egreso($id)";
        $consulta = $this->_db->query($instruccion);
        if(!$consulta){
            echo "Fallo al mostrar las tareas";
        }else{
            return $consulta;
            $this->_db->close();
        }
    }

    function totalIngresos($datos){
        $acum = 0;
        foreach($datos as $resultado){
            $acum += $resultado['monto'];
        }

        return $acum;
    
    }

    function totalEgresos($datos){
        $acum = 0;
        foreach($datos as $resultado){
            $acum += $resultado['monto'];
        }

        return $acum;
    
    }

    function presupuestoTotal($ingresos, $egresos){
        $total = $ingresos -$egresos;

        return $total;
    }   



    public function buscarUsuario($usuario,$contrasena)
    {
        $instruccion = "CALL sp_buscar_usuario('$usuario','$contrasena')";
        $consulta = $this->_db->query($instruccion);
        $resultado = $consulta->fetch_all(MYSQLI_ASSOC);
        if(!$resultado){
        }else{
            return $resultado;
            $resultado->close();
            $this->_db->close();
        }
    }


}

     

?>