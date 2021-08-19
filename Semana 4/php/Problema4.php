<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Arreglos y cadenas de Arreglos con PHP</title>
		<link rel="stylesheet" type="text/css" href="css/Problema4.css">
		<script src="js/jquery-3.5.1.js"></script>		
	</head>
	<body>
		<h1>Copa Am&eacute;rica Colombia 2021</h1>
		<h2>Grupo B</h2>

		<table>
			<thead>
				<tr>
					<th>Pa&iacute;s</th>
					<th>PJ</th>
					<th>PG</th>
					<th>PE</th>
					<th>PP</th>
					<th>GF</th>
					<th>GC</th>
					<th>DIF</th>
					<th>PTS</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$paises[]=array("pais"=>"Brasil","PJ"=>0,"PG"=>0,"PE"=>0,"PP"=>0			,"GF"=>0,"GC"=>0,"DIF"=>0,"PTS"=>0);
					$paises[]=array("pais"=>"Colombia","PJ"=>0,"PG"=>0,"PE"=>0,
						             "PP"=>0,"GF"=>0,"GC"=>0,"DIF"=>0,"PTS"=>0);
					$paises[]=array("pais"=>"Per&uacute;","PJ"=>0,"PG"=>0,"PE"=>0,
						             "PP"=>0,"GF"=>0,"GC"=>0,"DIF"=>0,"PTS"=>0);
					$paises[]=array("pais"=>"Venezuela","PJ"=>0,"PG"=>0,"PE"=>0,
						             "PP"=>0,"GF"=>0,"GC"=>0,"DIF"=>0,"PTS"=>0);
					$paises[]=array("pais"=>"Ecuador","PJ"=>0,"PG"=>0,"PE"=>0,
						             "PP"=>0,"GF"=>0,"GC"=>0,"DIF"=>0,"PTS"=>0);
					$paises[]=array("pais"=>"Qatar","PJ"=>0,"PG"=>0,"PE"=>0,
						             "PP"=>0,"GF"=>0,"GC"=>0,"DIF"=>0,"PTS"=>0);
					include "libProblema4.php";
					$copa = new copa_america($paises);
					$paises = $copa->jugar();
					$paises = $copa->ordenar($paises);
					for($i=0;$i<count($paises);$i++){
						if($i<4)
							echo "<tr style='background:green'>";
						else
							echo "<tr>";
						echo "<td>".$paises[$i]["pais"]."</td>";
						echo "<td>".$paises[$i]["PJ"]."</td>";
						echo "<td>".$paises[$i]["PG"]."</td>";
						echo "<td>".$paises[$i]["PE"]."</td>";
						echo "<td>".$paises[$i]["PP"]."</td>";
						echo "<td>".$paises[$i]["GF"]."</td>";
						echo "<td>".$paises[$i]["GC"]."</td>";
						echo "<td>".$paises[$i]["DIF"]."</td>";
						echo "<td>".$paises[$i]["PTS"]."</td>";
						echo "</tr>";		
					}	
				?>
					
			</tbody>
			
		</table>
		<h2>
			<form action = "Problema4.php" method="GET">
					<input type="submit" id="simula" value="Simular" name="Simula"
					width="300px"/>
			</form>
			
		</h2>
	</body>
</html>