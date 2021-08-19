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
    
            
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Buscar el curso a crear</title>
        <!--Se necesita este enlace para que funcione el Navbar de Boostrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

      <script src="../../js/jquery-3.5.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/menuadmin.js"></script>
    </head>

  <body>
    <div class="container">
      <h2 class="text-center">Busque el curso y campus donde crear&aacute; el nuevo horario</h2>
      <form action="crear_seccion.php" method = "POST">
        <div class="form-group">
          <label for="curso">Curso:</label>
          <select class="form-control text-center" name="codigo">
            <?php
              $sql="SELECT codcurso, nombre FROM cursos WHERE activo = 'SI' order by nombre ASC";
              try{
                $stmt=$pdo->prepare($sql);
                $stmt->execute(); 
              }catch(Exception $ex){
                header('Location:../../../index.html');
                return;
              }
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                  echo "<option value=".$row['codcurso'].">".$row['codcurso']."-".$row['nombre']."</option>";
              }
            ?>
            </select>
        </div>
        <div class="form-group">
          <label for="pwd">Campus:</label>
          <select class="form-control text-center" name="campus">
            <option value="MO">Monterrico</option>
            <option value="SM">San Miguel</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Ir a crear</button>
      </form>

    </div>

  </body>
</html>