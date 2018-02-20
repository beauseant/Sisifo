<?php

	require_once("../classes/iterator/class.RolIterator.php");
	
	$roli = new RolIterator();
	echo "Actual: ";
	echo "<SELECT name=\"rolant\">";
	
		while ( !$roli -> EOF() ) {
		
			echo ( $roli -> fetch () );	
		
		}
		
	echo "</SELECT>";
	
	$roli = new RolIterator();
	echo "  Nuevo: ";
	echo "<SELECT name=\"rolnuevo\">";
	
		while ( !$roli -> EOF() ) {
		
			echo ( $roli -> fetch () );	
		
		}
		
	echo "</SELECT>";
	
	
?>
