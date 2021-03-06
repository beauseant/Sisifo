<?php

require_once ("class.SimpleIterator.php");

class RolIterator extends SimpleIterator {
    
    var $resultSet;
    
    var $sisifoConf;
    
    function RolIterator () {  
    
    	$this -> sisifoConf  = new Configuracion ( $_SESSION ['fichero'] );

		$db = $this -> sisifoConf -> getBd();

		$consultaSQL = "SELECT * FROM rol";
		//$this -> resultSet  = $db -> SelectLimit ( $consultaSQL, $nrows, $offset );
		$this -> resultSet  = $db -> Execute ( $consultaSQL );
		$posActual = 0;
    }
    
    function EOF () {
	
	return ( $this -> resultSet -> EOF );
    
    }
    
    function fetch () {    
	if  ( ! ($this -> EOF ()) ) {
		$resultado = '<OPTION value="' . $this -> resultSet -> fields ['id'] . '">' . 
			$this -> resultSet -> fields ['rolact'];
		$this -> resultSet -> MoveNext();
    	} 
	
	return $resultado;
    }
    
    function size() {
        return ( $this -> resultSet -> rowCount() );
    }

}
?>
