<?php 

	require_once("classes/class.SisifoFrases.php");

	
		$baseurl = $_SESSION['base_url'];;
		echo ('
			<div class="menu_prin">
				<a href="' . $baseurl . '/mostrar.php">::inicio | </a> 
				<a href="' . $baseurl . '/clave_pub.php">::clave publica | </a>
				<a href="' . $baseurl . '/estadisticas/estadisticas.php">::estadisticas | </a>
				<a href="' . $baseurl . '/DocTSC/index.php">::Documentos | </a>	
			');
			
		if ( esAdmin () ) {
			echo ('
				<a href="' . $baseurl . '/admin/index.php">::administrar |</a>
				');
		}
		echo ( '
				<a href="' . $baseurl . '/logout.php">::salir</a>
			</div>
		');
		
	//$frase = new SisifoFrases ();
	//echo '
	//	<DIV class="rotulo_frase">' . $frase -> dameFrase () . '</DIV>';
?>		
