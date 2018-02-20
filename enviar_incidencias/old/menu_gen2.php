<?php 


	
		$baseurl = $_SESSION['base_url'];;
		echo ('
			<div class="menu_prin">
				<a href="' . $baseurl . '/mostrar.php">::inicio | </a> 
			');	
		echo $cadena;		
		echo ( '
				<a href="' . $baseurl . '/logout.php">::salir</a>
			</div>
		');



?>		