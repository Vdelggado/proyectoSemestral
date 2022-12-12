<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Inicio de Sesion</title>
</head>
<body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="container" method ="post">
            <h1>Login</h1>
            <input type="text" placeholder="Username" name ="usuario" required>
            <input type="password" placeholder="Password" name ="contrasena" required>
            <div class="btn-container">
                <button  type="submit" name ="ingresar">Ingresar</button>
            </div>
            
        </form>
    


        <?php 
            require_once('class/funciones.php');
            if(isset($_POST['ingresar'])){
                $objeto = new Funciones();
                $usuario = $_POST['usuario'];
                $contrasena = $_POST['contrasena'];
                $user = $objeto->buscarUsuario($usuario,$contrasena);
                $_SESSION['user']=$usuario;
                if($user){
                         echo "<script type='text/javascript'>
                         document.querySelector('.container').innerHTML = '<h1 style:text-align:center> Se ha iniciado sesion correctamente</h1>';

                         setTimeout( function() { window.location.href = 'http://localhost/proyectoSemestral/index.php';}, 1000)

                         </script>";
                }else{
                    echo "<script language='javascript'>
                    document.querySelector('.container').innerHTML = '<h1>Usurario no registrado</h1>';
                    setTimeout( function() { window.location.href = 'http://localhost/proyectoSemestral/login.php';}, 1000)
                    </script>";
              }
            }
        ?>