<?php
	class crear_profesor{
		public $docente;
		public $pdo;
  	
		public function __construct($docente){
			$this->docente = $docente;
			$this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=horarios','root','');
  			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		}

		public function verificar_datos(){
			/*Se tiene que verificar que:
			1. No falten datos.
			2. El correo tenga formato de email.
			3. El mínimo de horas sea menor al máximo de horas.*/
			$cont = 0;
			foreach($this->docente as $i=>$val){
				if(empty($val)){
					$cont++;
					if($i=='horas_min')/*Porque puede ser cero*/
						$cont--;
				}	
			}
			if($cont>0) //=>Hay datos vacíos*/
				$cont = false;
			else
				$cont = true; /*No hay datos vacíos*/
			$email = 0;					
			if(strpos($this->docente['email'], '@') !== false) {
				$email =true;	/*Correo OK*/
			}	
			else
				$email =false;	
			$horas = 0;
			if($this->docente['horas_max']<$this->docente['horas_min'])
				$horas = false;	
			else
				$horas = true;	/*Horas OK*/
			$respuesta = array("vacios"=>$cont,"email"=>$email,"horas"=>$horas);
			return $respuesta;
		}

		

		public function verificar_codigo(){
			$sql = "Select * from docentes where iddocente = :codigo";
			try{
				$stmt=$this->pdo->prepare($sql);
				$stmt->execute(array(
							':codigo'=>$this->docente['codigo']
							));	
			}catch(Exception $ex){
				return false;
			}
			if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				return false;	//Ya existe el código	
			}
			else{
				return true;
			}
			
		}

		public function insertar_docente(){
			$sql = "insert into docentes (iddocente,nombre,apellidop,apellidom,carrera,contrato, habilitado, horas_min,horas_max, correo) values(:codigo,:nombre,:apellidop,:apellidom,:carrera,:contrato,:habil,:min,:max,:correo)";
			switch($this->docente['carrera']){
				case 'electronica':
					$this->docente['carrera']="Ing. Electronica";
				break;
				case 'mecatronica':
					$this->docente['carrera']="Ing. Mecatronica";
				break;
				case 'industrial':
					$this->docente['carrera']="Ing. Industrial";
				break;
				case 'sistemas':
					$this->docente['carrera']="Ing. de Sistemas";
				break;
				case 'redes_epe':
					$this->docente['carrera']="Ing. Redes EPE";
				break;
				case 'ciencias':
					$this->docente['carrera']="Ciencias";
				break;
				case 'otro':
					$this->docente['carrera']="Otra carrera";
				break;
			}
			
			try{
				$stmt=$this->pdo->prepare($sql);
				$stmt->execute(array(
							':codigo'=>$this->docente['codigo'],
							':nombre'=>$this->docente['nombre'],
							':apellidop'=>$this->docente['apellidop'],
							':apellidom'=>$this->docente['apellidom'],
							':carrera'=>$this->docente['carrera'],
							':contrato'=>$this->docente['contrato'],
							':habil'=>$this->docente['habil'],
							':min'=>$this->docente['horas_min'],
							':max'=>$this->docente['horas_max'],
							':correo'=>$this->docente['email']
							));	
			}catch(Exception $ex){
				return false;
			}
  			if($stmt)
  				return true;
  			else
  				return false;
		}
	}

	class crear_disponibilidad{
		private $pdo;

		public function __construct(){
			$this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=horarios','root','');
  			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		}

		public function lista_docente(){
			$sql = "SELECT iddocente, nombre, apellidop FROM docentes ORDER BY apellidop ASC";
			try{
				$stmt=$this->pdo->prepare($sql);
				$stmt->execute();
			}catch (Exception $ex){
				return false;
			}
			$docentes=array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$docentes[]=array('iddocente'=>$row['iddocente'],'nombre'=>$row['nombre'],'apellidop'=>$row['apellidop']);
				
			}
			return $docentes;
		}

		

	}

	class laboratorios{
		private $pdo;

		public function __construct(){
			$this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=horarios','root','');
  			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		}

		public function mis_laboratorios(){
			$sql = "SELECT nombre FROM laboratorios";
			try{
				$stmt=$this->pdo->prepare($sql);
				$stmt->execute();
			}catch (Exception $ex){
				return false;
			}
			$laboratorios=array();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$laboratorios[]=array('laboratorio'=>$row['nombre']);
				
			}
			return $laboratorios;
		}
	}

	class crear_seccion{
		private $pdo;

		public function __construct(){
			$this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=horarios','root','');
  			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		}

		public function horas_curso($codigo){
			$sql = "SELECT teoria,practica,laboratorio,grupos FROM cursos where codcurso = :codigo";
			try{
				$stmt=$this->pdo->prepare($sql);
				$stmt->execute(array(
							':codigo'=>$codigo
						));
			}catch (Exception $ex){
				return false;
			}
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		}

	}
?>