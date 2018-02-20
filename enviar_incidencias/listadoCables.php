<?php

	require_once("../classes/iterator/class.CableIterator.php");
	
	$cablei = new TipoCableIterator();
	
	echo "<SELECT name=\"tipo\">";
	
		while ( !$cablei -> EOF() ) {
		
			echo ( $cablei -> fetch () );	
		
		}
		
	echo "</SELECT>";
	
	
?>
