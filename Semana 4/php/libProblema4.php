<?php
	class copa_america{
		private $equipos;
		public function __construct($equipos){
			$this->equipos = $equipos;
			foreach($this->equipos as $x=>$var){
				if($x!="pais"){
					$var = 0;
				}
			}
		}

		public function jugar(){
			/*Fecha 1
			equipos[0] vs equipos[1] Brasil-Colombia
			equipos[2] vs equipos[3] Peru-Venezuela
			equipos[4] vs equipos[5] Ecuador-Qatar
			*/
			$games[]=array(0,1,2,3,4,5);
			/*Fecha 2
			equipos[0] vs equipos[2] Brasil-Peru
			equipos[1] vs equipos[4] Colombia-Ecuador
			equipos[3] vs equipos[5] Venezuela-Qatar
			*/
			$games[]=array(0,2,1,4,3,5);
			/*Fecha 3
			equipos[0] vs equipos[3] Brasil-Venezuela
			equipos[1] vs equipos[5] Colombia-Qatar
			equipos[2] vs equipos[4] Peru-Ecuador
			*/
			$games[]=array(0,3,1,5,2,4);
			/*Fecha 4
			equipos[0] vs equipos[4] Brasil-Ecuador
			equipos[1] vs equipos[3] Colombia-Venezuela
			equipos[2] vs equipos[5] Perú-Qatar
			*/
			$games[]=array(0,4,1,3,2,5);
			/*Fecha 5
			equipos[0] vs equipos[5] Brasil-Qatar
			equipos[1] vs equipos[2] Colombia-Perú
			equipos[3] vs equipos[4] Venezuela-Ecuador
			*/
			$games[]=array(0,5,1,2,3,4);
			$score = array("pais1"=>0,"pais2"=>0);
			
			$equipos = $this->equipos;	
			for($j=0;$j<5;$j++)
			{		
				$partidos=$games[$j];
				//var_dump($partidos);
				for($i=0;$i<6;$i+=2)
				{
					$score["pais1"]=rand(0,10);
					$score["pais2"]=rand(0,10);
					$equipos[$partidos[$i]]["GF"]+=$score["pais1"];
					$equipos[$partidos[$i]]["GC"]+=$score["pais2"];
					$equipos[$partidos[$i+1]]["GF"]+=$score["pais2"];
					$equipos[$partidos[$i+1]]["GC"]+=$score["pais1"];

					if($score["pais1"]>$score["pais2"]){
						$equipos[$partidos[$i]]["PG"]+=1;$equipos[$partidos[$i]]["PTS"]+=3;$equipos[$partidos[$i+1]]["PP"]+=1;
					}
					else if($score["pais1"]==$score["pais2"]){
						$equipos[$partidos[$i]]["PE"]+=1;$equipos[$partidos[$i]]["PTS"]+=1;$equipos[$partidos[$i+1]]["PE"]+=1;$equipos[$partidos[$i+1]]["PTS"]+=1;	
					}
					else{
						$equipos[$partidos[$i+1]]["PG"]+=1;$equipos[$partidos[$i+1]]["PTS"]+=3;$equipos[$partidos[$i]]["PP"]+=1;
					}
					$equipos[$partidos[$i]]["PJ"]+=1;$equipos[$partidos[$i+1]]["PJ"]+=1;
					$equipos[$partidos[$i]]["DIF"]=$equipos[$partidos[$i]]["GF"]-$equipos[$partidos[$i]]["GC"];
					$equipos[$partidos[$i+1]]["DIF"]=$equipos[$partidos[$i+1]]["GF"]-$equipos[$partidos[$i+1]]["GC"];
											
				}
			}
			return $equipos;
		}

		public function ordenar($equipos){
			foreach($equipos as $i=>$key){
				$ptos[$i]=$key['PTS'];
				$dif[$i]=$key['DIF'];
			}
			array_multisort($ptos, SORT_DESC, $dif, SORT_DESC,   $equipos);

			return $equipos;
		}


		
	}



?>