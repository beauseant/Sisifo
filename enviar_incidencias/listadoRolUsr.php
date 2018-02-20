<?php

	require_once("../classes/iterator/class.RolIterator.php");
	
	$roli = new RolIterator();
	
	echo "<SELECT name=\"rol\">";
	
		while ( !$roli -> EOF() ) {
		
			echo ( $roli -> fetch () );	
		
		}
		
	echo "</SELECT>";
	
	
?>
