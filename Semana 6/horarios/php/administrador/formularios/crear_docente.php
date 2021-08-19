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
      header('Loacation:../../index.html');
      return;
    }
    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $nombre = $row['nombre'];
        $apellido=$row['apellidop'];
    }
    else{
      header('Loacation:../../../index.html');
      return;
    }
    include "../../timeout.php";
    /*Si se ha insertado un nuevo cliente*/
    $malcodigo = "hidden";
    $malnombre = "hidden";
    $malapellidop = "hidden";
    $malapellidom = "hidden";
    $malemail = "hidden";
    $malhorasmax = "hidden";
    $malhorasmin = "hidden";
    $docente = array('codigo'=>"",'nombre'=>"",'apellidop'=>"",'apellidom'=>"",
        'email'=>"",'carrera'=>"",'contrato'=>"",'habil'=>"",
        'horas_max'=>"",'horas_min'=>"");
    //echo $_SERVER['PHP_SELF'];
    //echo $_SERVER["REQUEST_METHOD"];

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $docente = array('codigo'=> $_POST['codigo'],'nombre'=>$_POST['nombre'],
        'apellidop'=>$_POST['apellidop'],'apellidom'=>$_POST['apellidom'],
        'email'=>$_POST['email'],'carrera'=>$_POST['carrera'],
        'contrato'=>$_POST['contrato'],'habil'=>$_POST['habil'],
        'horas_max'=>$_POST['horas_max'],'horas_min'=>$_POST['horas_min']);

        unset($_POST);
        
        include "mis_clases.php";
        
        $prof = new crear_profesor($docente);
        $ver=$prof->verificar_datos();
        $cod=$prof->verificar_codigo();
        $cont = 0;
        if($cod===false){
          $malcodigo = "visible";
          $cont++;
        }
        if($ver['email']===false){
          $malemail = "visible";
          $cont++;
        }
        if($ver['horas']===false){
          $malhorasmax="visible";
          $malhorasmin="visible";
          $cont++;
        }
        if($ver['vacios']===false){
          if(empty($docente['codigo']))
            $malcodigo="visible";
          if(empty($docente['nombre']))
            $malnombre="visible";
          if(empty($docente['apellidop']))
            $malapellidop="visible";
          if(empty($docente['apellidom']))
            $malapellidom="visible";
          if(empty($docente['email']))
            $malemail="visible";
          if(empty($docente['horas_max']))
            $malhorasmax="visible";
          if(empty($docente['horas_min']))
            $malhorasmin="visible";  
          $cont++;
        }
        if($cont==0){/*Ya podemos insertar el nuevo docente*/
          $val=$prof->insertar_docente();
          /*Reiniciamos los valores*/
          header('Location:docente_creado.html');
          
        }
          
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Horarios modo administrador</title>
        <!--Se necesita este enlace para que funcione el Navbar de Boostrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

      <script src="../../../js/jquery-3.5.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    </head>
    <body>
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">Gesti&oacute;n de horarios UPC</a>
          </div>
          <ul class="nav navbar-nav">
              <li class="active"><a href="../menuadmin.php">Home</a></li>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Docentes<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="crear_docente.php">Insertar nuevo docente</a></li>
                  <li><a href="crear_disponibilidad.php">Insertar disponibilidad del docente</a></li>
                  <li><a href="#">Editar datos del docente</a></li>
                  <li><a href="#">Ver horario propuesto del docente</a></li>
                  <li><a href="#">Ver disponibilidad del docente</a></li>
                  <li><a href="#">Ver horas de dictado de los docentes</a></li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Horarios<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#" id="menucrearhorario">Crear un horario de curso</a></li>
                  <li><a href="#">Modificar un horario de curso</a></li>
                  <li><a href="#">Eliminar un horario</a></li>
                  <li><a href="#">Ver horarios por curso</a></li>
                  <li><a href="#">Ver horarios por ciclo</a></li>
                  <li><a href="#">Ver todos los horarios por carrera</a></li>      
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Ocupabilidad<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Ver la ocupabilidad de los laboratorios</a></li>
                </ul>
              </li>  
              <li><a href="#">Cambiar contrase&ntilde;a</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="#"><span class="glyphicon glyphicon-user"></span>    Bienvenido <?php echo $nombre." ".$apellido?></a></li>
              <li><a href="../../cerrar.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesi&oacute;n</a></li>
          </ul>
        </div>
    </nav>

<!--Formulario de ingreso de nuevo docente-->
  <div class="container" id="crear_docente" style="background-color: #F5F5F5;
  border-radius: 20px;">
  <h1>Crear docente nuevo</h1>
  <br>
  <form class="form-horizontal" action="crear_docente.php" method="POST">
    <div class="form-group">
      <label class="control-label col-sm-2" for="codigo">C&oacute;digo:</label>
      <div class="col-sm-2">
        <input type="number" class="form-control" id="codigo" placeholder="4 d&iacute;gitos" name="codigo" value="<?php echo $docente['codigo'] ?>">
      </div>
      <label class="control-label col-sm-2 alert-danger text-center" style="visibility:<?php echo $malcodigo ?>;">El c&oacute;digo ya existe</label>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="nombre">Nombre:</label>
      <div class="col-sm-8">          
        <input type="text" class="form-control" id="nombre" placeholder="Ingrese los nombres" name="nombre" value="<?php echo $docente['nombre'] ?>">
      </div>
      <label class="control-label col-sm-2 alert-danger text-center" style="visibility:<?php echo $malnombre ?>;">No deje el nombre en blanco</label>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="apellidop">Apellido paterno:</label>
      <div class="col-sm-8">          
        <input type="text" class="form-control" id="apellidop" placeholder="Ingrese el apellido paterno" name="apellidop" value="<?php echo $docente['apellidop'] ?>">
      </div>
      <label class="control-label col-sm-2 alert-danger text-center" style="visibility:<?php echo $malapellidop ?>;">No deje el apellido paterno en blanco</label>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="apellidom">Apellido materno:</label>
      <div class="col-sm-8">          
        <input type="text" class="form-control" id="apellidom" placeholder="Ingrese el apellido materno" name="apellidom" value="<?php echo $docente['apellidom'] ?>">
      </div>
      <label class="control-label col-sm-2 alert-danger text-center" style="visibility:<?php echo $malapellidom ?>;">No deje el apellido materno en blanco</label>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Correo electr&oacute;nico:</label>
      <div class="col-sm-8">          
        <input type="email" class="form-control" id="email" placeholder="Ingrese el email" name="email" value="<?php echo $docente['email'] ?>">
      </div>
      <label class="control-label col-sm-2 alert-danger text-center" style="visibility:<?php echo $malemail ?>">El correo no tiene el formato correcto</label>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="carrera">Direcci&oacute;n:</label>
      <div class="col-sm-8">          
        <select class="form-control" name="carrera">
          <option value='electronica'>Ing. Electr&oacute;nica</option>
          <option value='mecatronica'>Ing. Mecatr&oacute;nica</option>
          <option value='industrial'> Ing. Industrial        </option>
          <option value='sistemas'>   Ing. Sistemas          </option>
          <option value='redes_epe'>  Ing. de Redes EPE      </option>
          <option value='ciencias'>   Ciencias               </option>
          <option value='otro'>       Otra direcci&oacute;n  </option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="contrato">Contrato:</label>
      <div class="col-sm-8">          
        <select class="form-control" name="contrato">
          <option value='Staff'>Staff</option>
          <option value='Director'>Director</option>
          <option value='Parcial'>Parcial</option>
          <option value='Dictante'>Dictante</option>
          <option value='Investigador'>Investigador</option>
        </select> 
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="habil">Habilitado:</label>
      <div class="col-sm-8">          
        <select class="form-control" name="habil">
          <option value='si'>SI</option>
          <option value='no'>NO</option>          
        </select> 
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="horas_max">M&aacute;ximo de horas:</label>
      <div class="col-sm-2">
        <input type="number" class="form-control" id="horas_max" placeholder="" name="horas_max" value = "<?php echo $docente['horas_max'] ?>">
      </div>
      <label class="control-label col-sm-2 alert-danger text-center" style="visibility: <?php echo $malhorasmax ?>">Debe ingresar el m&aacute;ximo de horas</label>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="horas_min">M&iacute;nimo de horas:</label>
      <div class="col-sm-2">
        <input type="number" class="form-control" id="horas_min" placeholder="" name="horas_min" value = "<?php echo $docente['horas_min'] ?>">
      </div>
      <label class="control-label col-sm-2 alert-danger text-center" style="visibility: <?php echo $malhorasmin ?>">Debe ingresar el m&iacute;nimo de horas</label>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Insertar nuevo docente</button>
      </div>
    </div>
  </form>
</div>