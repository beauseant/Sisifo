<?php 

require_once("../classes/class.SisifoFrases.php");

	
		$baseurl = $_SESSION['base_url'];;
		echo ('
			<div class="menu_prin">
				<a href="' . $baseurl . '/mostrar.php">::inicio | </a> 
			');			
		echo ( '
				<a href="' . $baseurl . '/logout.php">::salir</a>
			</div>
		');


	$frase = new SisifoFrases ();
	echo '
		<DIV class="rotulo_frase">' . $frase -> dameFrase () . '</DIV>';
		
		
?>		