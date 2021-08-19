<?php
	$usuario = ""; $clave = "";
	date_default_timezone_set("America/Lima");

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$pdo = new PDO('mysql:host=localhost;port=3306;dbname=tienda','root','');
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$usuario = $_POST["correo"];
		$clave = $_POST["clave"];
		$sql = "Select correo, admin, accesos from usuarios where correo = :mail".
		" and clave = aes_encrypt(:password,'upc')";
		echo $sql;
		try{
			$stmt=$pdo->prepare($sql);
			$stmt->execute(array(
							':mail'=>$usuario,
							':password'=>$clave
			));
		}catch(Exception $ex){
			header('Location:../index.html');
			return;
		}
		if($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
			$admin = $fila['admin'];
			$accesos = $fila['accesos'];
			var_dump($fila);
			/*Ya se que mi usuario y contraseña son correctos*/
			session_start();
			$_SESSION['correo']=$usuario;
			$_SESSION['admin']=$admin;
			$_SESSION['hora_entrada']=date("Y-n-j H:i:s");
			if($admin=='S'){
				header("Location:administrador.php");
				return;
			}
			else if($admin=='N'){
				header("Location:cliente.php");
				return;
			}
		}
		else{
			echo "<script language= javascript>
			alert('Su clave o usuario son errados.')
			self.location='../index.html'</script>";	
		}

	}
	else{
		echo "<script language= javascript>
		alert('Se debe ingresar a traves de index.html.')
		self.location='../index.html'</script>";
	}




?>