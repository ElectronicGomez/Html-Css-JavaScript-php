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
    include "mis_clases.php";
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
                  <li><a href="#">Crear un horario de curso</a></li>
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

<!--Formulario de ingreso de la disponibilidad del docente-->
  <div class="container" style="background-color: #F5F5F5;
  border-radius: 20px;">
    <h1>Disponiblidad del docente</h1>
    
  <form class="form-horizontal" action="crear_disponibilidad.php" method="POST">
    <div class="row">
      <div class = "col-sm-6">
        <label class="control-label">Seleccione el docente:</label>
        <?php 

            $lista = new crear_disponibilidad();
            $docentes = $lista->lista_docente();

        ?>
        <select class="form-control" name="docente">
            <?php
            for($i=0;$i<count($docentes);$i++){
              echo "<option value='".$docentes[$i]['iddocente']."'>".$docentes[$i]['nombre']." ".$docentes[$i]['apellidop']."</option>";
            }
            ?>
        </select>
      </div>
      <div class = "col-sm-2">
        <label class="control-label">Ciclo:</label>
        <select class="form-control" name="ciclo">
            <option value='2020-2'>2020-2</option>
        </select>
      </div>
    </div>
    <div class="row" style="margin-top: 20px;">
      <h4 class="text-left" style="margin-left: 15px;">Haga click sobre cada horario para modificarlo</h4>
    </div>
    <h6>MO: Disponibilidad en el campus Monterrico</h6>
    <h6>SM: Disponibilidad en el campus San Miguel</h6>
    <h6>VL: Disponibilidad en el campus Villa</h6>
    <h6>MO-SM: Disponibilidad en el campus Monterrico o campus San Miguel</h6>
    <h6>TODOS: Disponibilidad en todos los campus</h6>
    
    <table class="table" style="margin-top: 20px">
      <thead>
          <tr class = "text-center">
            <th>Horario</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Mi&eacute;rcoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>S&aacute;bado</th>
            <th>Domingo</th>            
          </tr>
      </thead>
      <tbody>
       <?php 
          $horario = array(0=>"07:00-08:00",1=>"08:00-09:00",2=>"09:00-10:00",
                           3=>"10:00-11:00",4=>"11:00-12:00",5=>"12:00-13:00",
                           6=>"13:00-14:00",7=>"14:00-15:00",8=>"15:00-16:00",
                           9=>"16:00-17:00",10=>"17:00-18:00",11=>"18:00-19:00",
                          12=>"19:00-20:00",13=>"20:00-21:00",14=>"21:00-22:00",
                          15=>"22:00-23:00"); 
          for($i=0;$i<16;$i++){
            echo "<tr>";
            echo "<td>".$horario[$i]."</td>";
              for($j=0;$j<7;$j++){
                if($j<6){
                  $n = ($i+7).'-'.$j;//11-0,11-1,11-2
                  if($j==4 && ($i==6 || $i==7)){
                      echo "<td>NO DISPONIBLE</td>";  
                  }
                  else{
                    echo "<td><select class='form-horizontal text-center' name='".$n."'>".
                    "<option value=NO>NO DISPONIBLE</option>".
                    "<option value=MO>MO</option>".
                    "<option value=SM>SM</option>".
                    "<option value=MO-SM>MO-SM</option>".
                    "<option value=VL>VL</option>".
                    "<option value=TODOS>TODOS</option></td>";
                  }
                }
                else{
                  echo "<td>NO DISPONIBLE</td>";
                }
              }
            echo "</tr>";  
          } 
        ?>  
        </tbody>
      </table>
      <div class="container">        
        <div class="col-sm-12">
          <button type="submit" class="btn btn-default btn-block">Grabar horario</button>
        </div>
      </div>
    </form>
  </div>
  <?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){
      //var_dump($_POST['docente']);
      //var_dump($_POST['ciclo']);
      $lunes =array();$martes = array();$miercoles=array();$jueves=array();
      $viernes=array();$sabado=array();
      for($hora=7;$hora<23;$hora++)
      {
        for($dia=0;$dia<6;$dia++)
        {
            switch($dia){
              case 0:
                $lunes[$hora]=$_POST[$hora."-".$dia]; 
              break;
              case 1:
                $martes[$hora]=$_POST[$hora."-".$dia];
              break;
              case 2:
                $miercoles[$hora]=$_POST[$hora."-".$dia];
              break;
              case 3:
                $jueves[$hora]=$_POST[$hora."-".$dia];
              break;
              case 4:
                $viernes[$hora]=$_POST[$hora."-".$dia];
              break;
              case 5:
                $sabado[$hora]=$_POST[$hora."-".$dia];              
              break;
            }
            //var_dump($_POST[$hora."-".$dia]);
        }
      }
      //var_dump($lunes);
      //var_dump($martes);
      //var_dump($miercoles);
      //var_dump($jueves);
      //var_dump($viernes);
      //var_dump($sabado);
      /*Hay que obtener la hora de inicio y hora de fin de cada día */
      $vez=0;
      for($dia=0;$dia<6;$dia++){
          for($hora=7;$hora<23;$hora++)
          {
            if($vez==0)
            {
              if($lunes[$hora]!=="NO" && $dia==0){
                $hora_inicio=$hora;
                $vez=1;
              }  
            }
            if($vez==1){
              if($lunes[$hora]==="NO" && $dia==0){
                $hora_fin=$hora-1;
                $vez=2;
              }
            }
          }
      }
      var_dump($hora_inicio);
      if(!isset($hora_fin))
        var_dump($hora_fin);
  }
  ?>
</body>
</html>