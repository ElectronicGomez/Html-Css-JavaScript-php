<?php
	$datos[] = array('volumen' => 67, 'edición' => 2);
	$datos[] = array('volumen' => 86, 'edición' => 1);
	$datos[] = array('volumen' => 85, 'edición' => 6);
	$datos[] = array('volumen' => 98, 'edición' => 2);
	$datos[] = array('volumen' => 86, 'edición' => 6);
	$datos[] = array('volumen' => 67, 'edición' => 7);


	foreach ($datos as $clave => $fila) {
		echo "<p>Clave: ".$clave."</p>";
   		$volumen[$clave] = $fila['volumen'];
   		//echo "<p>".$volumen[$clave]."</p>";
    	$edición[$clave] = $fila['edición'];
    	//echo "<p>".$edición[$clave]."</p>";
	}
	array_multisort($volumen, SORT_DESC, $edición, SORT_ASC, $datos);
	var_dump($datos);
	var_dump($volumen);
	var_dump($edición);
?>
