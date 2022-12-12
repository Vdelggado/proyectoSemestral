<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Aplicacion de presupuesto</title>
</head>
<body onload = "cargar()">
       <main>
           <section id="header">
           <div class="nav">
            <h1>Bienvenido  <?php echo $_SESSION['user'];?></h1>
        </div>
               <div id="presupuesto">
                    <p class="title">Presupuesto Disponible:</p>
                    <p class="presu-monto" id="presuTot">$1,200.00</p>
                </div>
               <div class="ingresos">
                    <p class="p-ingreso">INGRESOS</p>
                    <p class="ingresos-monto" id="ingre"></p>
               </div>
               <div class="egresos">
                   <p class="t-egresos">EGRESOS</p>
                   <p class="eg-monto" id="egre"></p>
               </div>
           </section>

           <form class="input-Ie"  id="forma" action="xd/insertar.php" method ="post">
                <div class="select">
                    <select name="tipo[]" id="tipo">
                        <option value="ingreso">+</option>
                        <option value="egreso">-</option>
                    </select>
                </div>
                <div>
                    <input type="text" placeholder="agregar descripcion" id="descripcion" name="descripcion" required>
                </div>
                <div> 
                    <input type="number" placeholder="Valor" id="valor" step="any" name="monto" required> <!--el step permite que se puedan recibir numero con decimales-->
                </div>
                <input type="submit" value="Enviar" class="submitE" name="enviar">
            </form>

           <section class="footer">
                
                    <?php 
                    require_once('class/funciones.php');
                    $funciones = new Funciones();
                    $funciones2=new Funciones();
                    $consulta = $funciones->mostrarIngresos();  
                    $consultaEgresos= $funciones2->mostrarEgresos();                                                            
                    $nFilas = count($consulta);
                    echo "<div class='f-ingresos'>";
                    echo "<h3>Ingresos</h3>";
                    if($nFilas >0){
                        foreach($consulta as $resultado){
                            echo "<div id='lista-ingresos'>";
                            echo "<div class='f-content'>";
                               echo  "<h5 class='f-content-descrip'>".$resultado['descripcion']."</h5>";
                               echo  "<div class='elemnto-list-monto'>";
                                  echo   "<h5 class='list-ingre-monto'>$". $resultado['monto'] ."</h5>";
                                   echo  "<div class='elemento_eliminar'>";
                                   echo "<div class='eliminar'>";
                                   echo "<a href='xd/eliminar.php?id=" . $resultado['id'] . "&tipo=ingreso' ><ion-icon name='close-outline'></ion-icon></a>";  
                                   echo  "</div>";
                                echo "</div>";
                                echo "</div>";
                           echo "</div>";
        
                               echo "</div>";
                               
                        }
                        echo "</div>";

                        echo "<div class='f-egresos'>";
                        echo "<h3>Egresos</h3>";

                        foreach($consultaEgresos as $resul){
                         echo "<div id='lista-egresos'>";
                             echo "<div class='f-content-egreso'>";
                                 echo "<h5>".$resul['descripcion']."</h5>";
                                 echo "<div class='elemnto-list-monto'>";
                                     echo "<h5>$". $resul['monto'] ."</h5>";
                                     echo "<div class='eliminar'>";
                                     echo "<a href='xd/eliminar.php?id=" . $resul['id'] . "&tipo=egreso' ><ion-icon name='close-outline'></ion-icon></a>";  
                                     echo  "</div>";
                                 echo "</div>";
                             echo "</div>";
                         
                            echo "</div>";
                     
                        }
                        echo "</div>";
 
                    }
                    $datos = $funciones->totalIngresos($consulta);
                    $datosEgresos = $funciones2->totalEgresos($consultaEgresos);
                    $presupuestoTotal = $funciones -> presupuestoTotal($datos,$datosEgresos);
                    ?>
           </section>
       </main>

  
       
       <script type='text/javascript'>
                            const cargar = ()=>{
                                document.querySelector('.presu-monto').innerHTML = formatoMoneda(<?php echo $presupuestoTotal ?>);
                                document.querySelector('.ingresos-monto').innerHTML = formatoMoneda(<?php echo $datos ?>);
                                document.querySelector('.eg-monto').innerHTML =formatoMoneda(<?php echo $datosEgresos?>);
                            }
                            const formatoMoneda= (valor)=>{
                                return valor.toLocaleString('en-US',{style:'currency',currency:'USD',minimumFractionDigit:2});
                            } 
                        

        </script>      
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>      
</body>

</html>