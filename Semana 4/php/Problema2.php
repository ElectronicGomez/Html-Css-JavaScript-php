<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <title>C&aacute;lculo de edad con PHP</title>
    <link rel="stylesheet" type="text/css" href="css/Problema2.css">
    <script src="js/jquery-3.5.1.js"></script>
    
</head>
	<body>
		<h1>Calcular la edad</h1>
		<div class="fecha">
			<form action = "Problema2.php" method="POST">
				<table>
					<tr>
						<td>Ingrese su fecha de nacimiento</td>
						<td><input type="date" name="fecha"></td>
					</tr>
				</table>
				<input type="submit" value="Calcular edad"/>
			</form>
		</div>
		<div class="resultado" id="resultado">
		<?php
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$fecha = $_POST["fecha"];
				//var_dump($fecha);
				if(!empty($fecha))
					list($año, $mes, $dia) = explode('-', $fecha);
				else{
					$año = 0;
					$mes = 0;
					$dia = 0;
				}
				$hoy = date("Y/m/d");
				list($añohoy,$meshoy,$diahoy) = explode("/",$hoy);
				
				$edad = $añohoy-$año;
				if($mes>$meshoy){
					$edad--;
				}
				else if($mes==$meshoy){
					if($dia>$diahoy)
						$edad--;
				}

				echo "<p id='resul'>Su edad es ".$edad." a&ntilde;os</p>";
			}
			else{
				echo "<p id='resul'>No hay edad para calcular</p>";
			}
		?>
		</div>
	</body>
</html>