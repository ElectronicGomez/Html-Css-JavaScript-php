<?php
 header('Content-Type: text/html; charset=ISO-8859-1');
  session_start();
  /*Si no se ingresa por sesión a este archivo regresamos a index.html*/
  if(!isset($_SESSION['correo']) || !isset($_SESSION['admin'])){
    header("Location:../../index.html");
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
      header('Location:../../index.html');
      return;
    }
    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $nombre = $row['nombre'];
        $apellido=$row['apellidop'];
    }
    else{
      header('Location:../../index.html');
      return;
    }
    include "../timeout.php";
    
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Horarios modo usuario</title>
        <!--Se necesita este enlace para que funcione el Navbar de Boostrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  		<script src="../../js/jquery-3.5.1.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../../js/menuadmin.js"></script>
    </head>
    <body>
    	<nav class="navbar navbar-inverse">
  			<div class="container-fluid">
    			<div class="navbar-header">
     				<a class="navbar-brand" href="#">Gesti&oacute;n de horarios UPC</a>
	   			</div>
    			<ul class="nav navbar-nav">
			      	<li class="active"><a href="menuadmin.php">Home</a></li>
  			      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Mi informaci&oacute;n<span class="caret"></span></a>
  			        <ul class="dropdown-menu">
                  <li><a href="formularios/crear_docente.php">Insertar mi disponibilidad horaria</a></li>
                  <li><a href="formularios/crear_disponibilidad.php">Ver mi horario propuesto</a></li>
                  <li><a href="#">Ver estad&iacute;stica de horas por semestre</a></li>
                  
                </ul>
              </li>
               
      				<li><a href="#">Cambiar contrase&ntilde;a</a></li>
    			</ul>
    			<ul class="nav navbar-nav navbar-right">
      				<li><a href="#"><span class="glyphicon glyphicon-user"></span>    Bienvenido <?php echo $nombre." ".$apellido?></a></li>
      				<li><a href="../cerrar.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesi&oacute;n</a></li>
    			</ul>
  			</div>
		</nav>

  <div class="jumbotron" id="bienvenida">
    <div class="container">
      <h1 class="display-4">Bienvenido al sistema de gesti&oacute;n de horarios!</h1>
      <p>Usted se encuentra en modo administrador. Nos encontramos en el semestre 2020-2. Los horarios de Ing. Electr&oacute;nica se encuentran ingresados al 78% y los horarios de Ing. Mecatr&oacute;nica al 90%. Aqu&iacute; deber&iacute;a mostrar alg&uacute;n mensaje relevante de la base de datos que requiera atenci&oacute;n inmediata.</p>
      <p><a class="btn btn-primary btn-lg" href="#" role="button">Ver reglas de uso &raquo;</a></p>
    </div>
  </div>
  

  </body>
</html>