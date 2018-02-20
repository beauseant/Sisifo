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
	
	
	
	if (isset($_GET["page"])) { $page  = cleanQuery ($_GET["page"]); } else { $page=1; }; 

	$start_from = ($page-1) * $limit; 

	
	$incidencias = $SisifoArchivo->getLastInci ( $limit, $estadoinci, $start_from );
	
	$template = $SisifoInfo -> getTemplate();
	
	
	if ( $incidencias ) {
		foreach ($incidencias as $i) {	
			$line = aplicar_temp (stripslashes( $template ),$i, $SisifoInfo);
			echo $line;
				
		}
	}else {		
		echo '<center>Usted aun no ha enviado ninguna incidencia al sistema</center>';
	}
	
	echo "
		<p><br></p>\n
	";

	$total_records = $SisifoArchivo->getNumInci ($estadoinci); 
	$total_pages = ceil($total_records / $limit); 

	echo ('<div class="pagination">');
	echo ('<span class="label">Incidencias:</span>');
	 
	for ($i=1; $i<=$total_pages; $i++) { 
	    if ( $page == $i ) {
		echo '<span class="current"><a href="mostrar.php?page='.$i.'">'.$i.'</a> </span>';
	    }else {
            	echo '<a href="mostrar.php?page='.$i.'">'.$i.'</a> '; 
	    }
	}; 
	echo ("</div>");
	

?>
<br><br><br>
<?php

	include ("footer.php");

				

?>
