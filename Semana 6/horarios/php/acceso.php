<?php
	$usuario = "";$clave="";
	date_default_timezone_set("America/Lima");

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$pdo = new PDO('mysql:host=localhost;port=3306;dbname=horarios','root','');
    	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		//var_dump($_POST);
		$usuario = $_POST["usuario"];
		$clave = $_POST["clave"];
		$sql = "Select correo, admin, accesos from usuarios where correo = :mail".
		" and clave=aes_encrypt(:password,'upc')";
		//echo $sql;
		try{
			$stmt=$pdo->prepare($sql);
			$stmt->execute(array(
							':mail'=>$usuario,
							':password'=>$clave
							));	
		}catch(Exception $ex){
			//echo("Excepcion: ".$ex->getMessage());
			header('Loacation:../index.html');
			return;
		}
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$admin = $row['admin'];
			/*Incrementamos el contador de accesos*/
			$accesos = $row['accesos']+1;
			$sql = "update usuarios set accesos=:acceso where correo=:mail";
			$stmt=$pdo->prepare($sql);
			$stmt->execute(array(
							':acceso'=>$accesos,
							':mail'=>$usuario,
							));
			session_start();
			$_SESSION['correo']=$usuario;
			$_SESSION['admin']=$admin;
			$_SESSION['hora_ingreso']=date("Y-n-j H:i:s");
			if($admin=='S'){
				header("Location:administrador/menuadmin.php");
				return;
			}
			else if($admin=='N'){
				header("Location:cliente/menucliente.php");
				return;
			}

		}
		else{
			/*Clave o usuario errados*/
			echo "<script language=javascript>
			alert('Usuario o clave errados. Por favor, verifique sus datos.')
			self.location='../index.html'</script>";
		}
		
	}



?>