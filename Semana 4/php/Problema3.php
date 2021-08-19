<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Conversi&oacute;n de bases con PHP</title>
			<link rel="stylesheet" type="text/css" href="css/Problema3.css">
			<script src="js/jquery-3.5.1.js"></script>			
		</head>
		<body>
			<h1>Conversi&oacute;n de bases</h1>
			<h2>Ingrese el n&uacute;mero en base 2</h2>
			<form action="Problema3.php" method="POST">
				<table>
					<tr>
						<td><input type="number" name="numero"></td>
						<?php
						if($_SERVER["REQUEST_METHOD"]=="POST"){
							$num= $_POST["numero"];
							$num = (string)$num;
							$mensaje = 0;
							for($i=0;$i<strlen($num);$i++){
								if($num[$i]!=='0' && $num[$i]!=='1'){
									$mensaje="Solo se aceptan 1s y 0s";
								}
							}
							if(empty($mensaje)){
								$numero=0;
								for($i=0;$i<strlen($num);$i++){
									$numero += $num[$i]*pow(2,(strlen($num)-1)-$i);
								}
								
							}
							if(isset($_POST["decimal"]))
								$mensaje="El n&uacute;mero en decimal es ".$numero;	
							else if(isset($_POST["hexadecimal"])){
								$numero = strtoupper(dechex($numero));
								$mensaje="El n&uacute;mero en hexadecimal es 0x".$numero;
							}	
							echo "<td id='respuesta'>".$mensaje."</td>";
						}
						else{
							echo '<td id="respuesta"></td>';	
						}
						?>
						
					</tr>
					<tr>
						<td><input type="submit" name="decimal" value="Decimal"/></td>
						<td><input type="submit" name="hexadecimal" value="Hexadecimal"</td>
					</tr>
				</table>
			</form>

		</body>
	</html>