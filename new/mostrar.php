<?php
session_start(); 

    echo '<DIV CLASS="informacion"> Conectado como <b>' . $_SESSION ['login'] . '</b> desde <b>' .
    	 $_SESSION['myip'] . '</b>.</DIV>';
    require_once("classes/class.SisifoIncidencia.php");
    require_once("classes/class.SisifoArchivo.php");

    
    

    $sisifoConf  = new Configuracion ( "sisifo.xml" );
    
    include("header.php");


      
     if(isLoggedIn()) {
		$uid = getUID($_SESSION['login']);
     }else {
     	echo"Ha probado a <A href=\"logout.php\">registrarse</A>?";
	exit();
     }
  
?>
<?php

	include ("menu_opc.php");

	include ("menu2.php");
	

	$SisifoInfo = $sisifoConf -> getSisifoConf ();
	$SisifoArchivo = new SisifoArchivo();
	
	
	
	$limit = $SisifoInfo -> getLimit();
	
	//comprobar si esto está correcto
	$estadoinci = $_REQUEST['estadoinci'];
	
	
	echo '<div class="big">';
	
	//echo '-----------------' . $estadoinci;
	
	if ( (! isset ($estadoinci) ) || ($estadoinci == "") ) {
		echo '
			<form action="mostrar.php" method=POST>
			 Mostrando incidencias de cualquier tipo
		';
		
		echo lista_estados_inci ();
		
		
			echo "
			<a href=\"javascript: abrirAyuda('" . $_SESSION ['base_url'] . "/','208')\">
				<img src=\"Documentos/Imagenes/icon_help.png\" border=0 
				title=\"Filtro de incidencias\"
				alt=\"Ayuda\"></img></a>	</form>	";

		echo ' <div class="big">{ Listado de las ultimas ' . $limit . ' incidencias enviadas al sistema }</div>';
			
	
	} else {
		echo "
			<form action=\"mostrar.php\" method=POST>
			[ Filtro de incidencias activado]";
			
		//$arrayinci = lista_estados_inci ();
		//echo $arrayinci;
		echo lista_estados_inci ();
		echo "
			<a href=\"javascript: abrirAyuda('" . $_SESSION ['base_url'] . "/','208')\">
				<img src=\"Documentos/Imagenes/icon_help.png\" border=0 
				title=\"Filtro de incidencias\"
				alt=\"Ayuda\"></img></a></form>	
			<br><br>			
		";
		
		echo ' <div class="big">{ Listado de las ultimas ' . $limit . ' incidencias }</div>';
	
	}
	
	echo '</div>';
	
	
	
	$incidencias = $SisifoArchivo->getLastInci ( $limit, $estadoinci );
	
	$template = $SisifoInfo -> getTemplate();
	
	
	if ( $incidencias ) {
		foreach ($incidencias as $i) {	
			$line = aplicar_temp (stripslashes( $template ),&$i, &$SisifoInfo);
			echo $line;
				
		}
	}else {		
		echo '<center>Usted aun no ha enviado ninguna incidencia al sistema</center>';
	}
	
	echo "
		<p><br></p>\n
		</div>
	";
	include ("footer.php");
				

?>
