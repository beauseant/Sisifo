<?php 

require_once ("classSisifoAnotacion.php");

class SisifoArchivoAnotacion {
    
	var $id_incidencia;

	function SisifoArchivoAnotacion ( $id ) {
		
		$this -> id_incidencia = $id;	
	
	}
	
	function buscar ( ) {
		global $sisifoConf;
	
		$db = $sisifoConf -> getBd();

		
			$sql = "SELECT * FROM anotacion WHERE id_incidencia =" . $this -> id_incidencia . ";";
			
			$rs = $db -> execute ( $sql );
			
			$webanotacion = array();
			while (!$rs->EOF) {
				$anotacion = new SisifoAnotacion ( 
					$rs -> fields ['id_incidencia'],$rs -> fields ['id_usuario'], 
					$rs -> fields ['fecha'], $rs -> fields ['texto']  );
				$webanotacion[] = $anotacion;
				$rs->MoveNext();
			}
			//Hab� mensajes para esa incidencia??????
			if ( array_count ( $webanotacion ) == 0 ) {
				return array();
			}else {
				return $webanotacion;
			}									
	
	}

}	
