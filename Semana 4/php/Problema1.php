<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <title>Promedio de notas con PHP</title>
    <link rel="stylesheet" type="text/css" href="css/Problema1.css">
    <script src="js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="js/Problema1.js"></script>
</head>
	<body>
		<div class = "titulo">
			<img src="img/upc.png"><h1>C&aacute;lculo del promedio final del curso SOTR de la UPC</h1>
		</div>
		<div class="notas">
			<form action="Problema1.php" method="GET">	
				<table>
					<tr>
						<td>PC1:</td>
						<td><input type="number" name="PC1" min="0" max="20"></td>
					</tr>
					<tr>
						<td>LB1:</td>
						<td><input type="number" name="LB1" min="0" max="20"></td>
					</tr>
					<tr>
						<td>EA:</td>
						<td><input type="number" name="EA" min="0" max="20"></td>
					</tr>
					<tr>
						<td>PC2:</td>
						<td><input type="number" name="PC2" min="0" max="20"></td>
					</tr>
					<tr>
						<td>LB2:</td>
						<td><input type="number" name="LB2" min="0" max="20"></td>
					</tr>
					<tr>
						<td>DD:</td>
						<td><input type="number" name="DD" min="0" max="20"></td>
					</tr>
					<tr>
						<td>TF:</td>
						<td><input type="number" name="TF" min="0" max="20"></td>
					</tr>
				</table>
				<input type="submit" value="CALCULAR" style="width: 100%;margin-top: 20px;">
						
			</div>
			
		</form>
		<?php
			if($_SERVER["REQUEST_METHOD"]=="GET"){
				if(!empty($_GET['TF']) && !empty($_GET['DD']) && !empty($_GET['PC1']))
				{
				
					echo "<div class = 'resultado' id='res_container'>";
					$notas = array("pc1"=>$_GET['PC1'],
								   "pc2"=>$_GET['PC2'],
								   "lb1"=>$_GET['LB1'],
								   "lb2"=>$_GET['LB2'],
								   "ea"=>$_GET['EA'],
								   "dd"=>$_GET['DD'],
								   "tf"=>$_GET['TF']);
					$mensaje = 0;
					foreach($notas as $x => $val) {
  						if($val>20 || $val< 0 )
  						{
  							$mensaje = "La ".$x." no puede estar fuera del rango 0 a 20";
  						}
					}
					if(empty($mensaje)){
						$pf = $notas["pc1"]*0.15+$notas["pc2"]*0.15+ $notas["lb1"]*0.15+$notas["lb2"]*0.15+$notas["ea"]*0.2+
						$notas["dd"]*0.05+$notas["tf"]*0.15;
						$mensaje = "Su promedio final es: ".$pf;
					}
					
					echo "<p id=resul'>".$mensaje."</p>";
					echo "</div>";
					//var_dump($mensaje);
				}
			}	
		?>
	</body>
</html>