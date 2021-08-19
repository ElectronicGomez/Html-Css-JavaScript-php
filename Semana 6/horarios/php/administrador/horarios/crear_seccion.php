<?php
  header('Content-Type: text/html; charset=ISO-8859-1');
  session_start();
  /*Si no se ingresa por sesión a este archivo regresamos a index.html*/
  if(!isset($_SESSION['correo']) || !isset($_SESSION['admin'])){
    header("Location:../../../index.html");
    return;
  }
  $correo = $_SESSION['correo'];
  /*Vamos a obtener el nombre y apellido del usuario*/
  $sql = "select nombre,apellidop from docentes where correo = :mail";
  $nombre="";
  $apellido="";
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=horarios','root','');
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  

  try{
      $stmt=$pdo->prepare($sql);
      $stmt->execute(array(
              ':mail'=>$correo
              )); 
    }catch(Exception $ex){
      header('Location:../../../index.html');
      return;
    }
    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $nombre = $row['nombre'];
        $apellido=$row['apellidop'];
    }
    else{
      header('Location:../../../index.html');
      return;
    }
    include "../../timeout.php";
    include "../formularios/mis_clases.php"; 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $codigo = $_POST["codigo"];
        $sql = "select nombre from cursos where codcurso= :codigo";
        try{
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array(
                        ':codigo'=>$codigo
                        )); 
        }catch(Exception $ex){
          header('Location:../../../index.html');
          return;
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $curso = $row['nombre'];

        $datos_curso = new crear_seccion();
        $horas = $datos_curso->horas_curso($codigo);
        //var_dump($horas);
        
    }else{
      header('Location:../../../index.html');
      return; 
    }
     
            
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Crear una secci&oacute;n nueva</title>
        <!--Se necesita este enlace para que funcione el Navbar de Boostrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

      <script src="../../js/jquery-3.5.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/menuadmin.js"></script>
    </head>
    <body>
      <div class="container">
        <h1>Creando una secci&oacute;n para el curso <?php echo $curso;?>
         en el campus <?php echo $_POST["campus"] ?></h1>
      </div>
      <div class = "container">
          <form action="insertar_seccion.php" method="POST">
              <div class="form-inline">
                <label for="seccion">Ingrese el c&oacute;digo de la secci&oacute;n:</label>
                <input type="text" class="form-control" name="seccion">
                <label for="vacantes">Vacantes:</label>
                <input type="number" class="form-control" name="vacantes">
              </div>
              
              <?php
                if($horas['teoria']>0)
                {
                  echo '<div class = "form-inline">';
                  echo "<h2>Teor&iacute;a (".$horas['teoria']." horas):</h2>";
                  echo "</div>";
                  echo '<table class="table text-center">';
                  echo "<tr>";
                  echo '<td><label for = "te_inicio">Hora de inicio:</label></td>';
                  echo '<td><input type="time" class="form-control" name="te_inicio"/></td>';
                  echo '<td>D&iacute;a</td>';
                  echo '<td><label for = "aula_te">Aula:</td><td><label for="docente">Elija al docente:</label></td></tr>';
                  echo '<tr>';
                  echo '<td><label for = "te_inicio">Hora de t&eacute;rmino:</label></td>';
                  echo '<td><input type="time" class="form-control" name="te_fin"/></td>';
                  echo '<td><select class="form-control" name="dia">';
                  echo '<option value="lunes">Lunes</option>';
                  echo '<option value="martes">Martes</option>';
                  echo '<option value="miercoles">Mi&eacute;rcoles</option>';
                  echo '<option value="jueves">Jueves</option>';
                  echo '<option value="viernes">Viernes</option>';
                  echo '<option value="sabado">S&aacute;bado</option>';
                  echo '</select></td>';
                  echo '<td><select class="form-control text-center" name="aula_te">
                      <option value="teorica">Te&oacute;rica</option>
                      <option value="computo">C&oacute;mputo</option>';
                  $lab = new laboratorios();
                  $labos = $lab->mis_laboratorios();
                  for($i=0;$i<count($labos);$i++)
                  {
                    echo "<option value='".$labos[$i]['laboratorio']."'>".$labos[$i]['laboratorio']."</option>";
                  }
                  echo "</select></td>";
                  echo "<td>";
                  echo '<select class="form-control text-center" name="docente">';
                  $lista = new crear_disponibilidad();
                  $docentes = $lista->lista_docente();
                  echo "<option value='ninguno'>Sin docente</option>";
                  for($i=0;$i<count($docentes);$i++){
                     echo "<option value='".$docentes[$i]['iddocente']."'>".$docentes[$i]['nombre']." ".$docentes[$i]['apellidop']."</option>";
                  }
                  echo "</select></td></tr></table>";
                }
              
              if($horas['practica']>0)               
              {
                echo '<div class = "form-inline">';
                echo "<h2>Pr&aacute;ctica (".$horas['practica']." horas):</h2>";
                echo "</div>";
                echo '<table class="table text-center">';
                echo '<tr>';
                echo '<td><label for = "pr_inicio">Hora de inicio:</label></td>';
                echo '<td><input type="time" class="form-control" name="pr_inicio"/></td>';
                echo '<td>D&iacute;a</td>';
                echo '<td><label for = "aula_pr">Aula:</td>';
                echo '<td><label for="docente">Elija al docente:</label></td>';
               
                echo '</tr>';
                echo '<tr>';
                echo  '<td><label for = "pr_inicio">Hora de t&eacute;rmino:</label></td>';
                echo  '<td><input type="time" class="form-control" name="pr_fin"/></td>';
                echo  "<td>";
                echo  '<select class="form-control" name="dia">';
                echo  '<option value="lunes">Lunes</option>';
                echo  '<option value="martes">Martes</option>';
                echo  '<option value="miercoles">Mi&eacute;rcoles</option>';
                echo  '<option value="jueves">Jueves</option>';
                echo  '<option value="viernes">Viernes</option>';
                echo  '<option value="sabado">S&aacute;bado</option>';
                      
                echo  "</select>";
                echo  "</td>";
                echo  '<td><select class="form-control text-center" name="aula_pr">';
                echo  '<option value="teorica">Te&oacute;rica</option>';
                echo  '<option value="computo">C&oacute;mputo</option>';
                     
                        for($i=0;$i<count($labos);$i++)
                        {
                          echo "<option value='".$labos[$i]['laboratorio']."'>".$labos[$i]['laboratorio']."</option>";
                        }
                echo  "</select>";    
                echo  "</td>";
                echo  "<td>";
                echo  '<select class="form-control text-center" name="docente">';
                  
                echo "<option value='ninguno'>Sin docente</option>";
                for($i=0;$i<count($docentes);$i++){
                    echo "<option value='".$docentes[$i]['iddocente']."'>".$docentes[$i]['nombre']." ".$docentes[$i]['apellidop']."</option>";
                }
                    
                echo  "</select>";
                echo  "</td>";
                echo "</tr>";
              echo "</table>";

              }

              if ($horas['laboratorio']>0){
                echo '<div class = "form-inline">';
                echo '<h2>Laboratorio Grupo 01('.$horas['laboratorio'].' horas):</h2>';
                echo '</div>';
                echo '<table class="table text-center">';
                echo '<tr>';
                echo '<td><label for = "lb1_inicio">Hora de inicio:</label></td>';
                echo '<td><input type="time" class="form-control" name="lb1_inicio"/></td>';
                echo  '<td>D&iacute;a</td>';
                echo  '<td><label for = "aula_lb">Aula:</td>';
                echo  '<td><label for="docente">Elija al docente:</label></td>';
                echo  '</tr>';
                echo  '<tr>';
                echo  '<td><label for = "lb1_fin">Hora de t&eacute;rmino:</label></td>';
                echo  '<td><input type="time" class="form-control" name="lb1_fin"/></td>';
                echo  '<td>';
                echo  '<select class="form-control" name="dia">';
                echo  '<option value="lunes">Lunes</option>';
                echo  '<option value="martes">Martes</option>';
                echo  '<option value="miercoles">Mi&eacute;rcoles</option>';
                echo  '<option value="jueves">Jueves</option>';
                echo  '<option value="viernes">Viernes</option>';
                echo  '<option value="sabado">S&aacute;bado</option>';
                echo  '</select>';
                echo  '</td>';
                echo  '<td><select class="form-control text-center" name="aula_lb1">
                      <option value="teorica">Te&oacute;rica</option>
                      <option value="computo">C&oacute;mputo</option>';
                for($i=0;$i<count($labos);$i++)
                {
                    echo "<option value='".$labos[$i]['laboratorio']."'>".$labos[$i]['laboratorio']."</option>";
                }
                echo '</select>';   
                echo '</td>';
                echo '<td>';
                echo '<select class="form-control text-center" name="docente">';
                echo "<option value='ninguno'>Sin docente</option>";
                for($i=0;$i<count($docentes);$i++){
                   echo "<option value='".$docentes[$i]['iddocente']."'>".$docentes[$i]['nombre']." ".$docentes[$i]['apellidop']."</option>";
                }
                echo '</select>';
                echo '</td>';
                echo '</tr>';
                echo '</table>';

              }
              if($horas['grupos']>0){
                echo '<div class = "form-inline">';
                echo '<h2>Laboratorio Grupo 02 ('.$horas['laboratorio'].' horas)</h2>';
                echo '</div>';
                echo '<table class="table text-center">';
                echo '<tr>';
                echo  '<td><label for = "lb2_inicio">Hora de inicio:</label></td>';
                echo  '<td><input type="time" class="form-control" name="lb2_inicio"/></td>';
                echo  '<td>D&iacute;a</td>';
                echo  '<td><label for = "aula_lb">Aula:</td>';
                echo  '<td><label for="docente">Elija al docente:</label></td>';
                echo '</tr>';
                echo '<tr>';
                echo  '<td><label for = "lb1_fin">Hora de t&eacute;rmino:</label></td>';
                echo  '<td><input type="time" class="form-control" name="lb2_fin"/></td>';
                echo  '<td>';
                echo   '<select class="form-control" name="dia">';
                echo   '<option value="lunes">Lunes</option>';
                echo   '<option value="martes">Martes</option>';
                echo   '<option value="miercoles">Mi&eacute;rcoles</option>';
                echo   '<option value="jueves">Jueves</option>';
                echo   '<option value="viernes">Viernes</option>';
                echo   '<option value="sabado">S&aacute;bado</option>';
                      
                echo  '</select>';
                echo  '</td>';
                echo  '<td><select class="form-control" name="aula_lb2">';     
                echo  '<option value="teorica">Te&oacute;rica</option>';
                echo  '<option value="computo">C&oacute;mputo</option>';
                for($i=0;$i<count($labos);$i++)
                        {
                          echo "<option value='".$labos[$i]['laboratorio']."'>".$labos[$i]['laboratorio']."</option>";
                        }
                echo '</select>';    
                echo  '</td>';
                echo  '<td>';
                echo  '<select class="form-control text-center" name="docente">';
                      
                echo "<option value='ninguno'>Sin docente</option>";
                for($i=0;$i<count($docentes);$i++){
                        echo "<option value='".$docentes[$i]['iddocente']."'>".$docentes[$i]['nombre']." ".$docentes[$i]['apellidop']."</option>";
                }
                   
                echo '</select></td></tr></table>';
              }
              ?>
                
              <button type="submit" class="btn btn-primary btn-block">Crear secci&oacute;n</button>
          </form>
      </div>
    </body>
</html>