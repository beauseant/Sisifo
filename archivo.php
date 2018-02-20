<?php 

    session_start();

   
    require_once ("lib.php");
    require_once ("classes/class.SisifoArchivo.php");
    require_once ("classes/class.SisifoIncidencia.php");
    
    
    include("header.php");

    
    
     if(isLoggedIn()) {
		$uid = getUID($_SESSION['login']);
     }else {
     	echo"Ha probado a <A href=\"logout.php\">registrarse</A>?";
	exit();
     }
     include ("menu_opc.php");	
     include ("menu2.php");
   		
		
     
		$sisifoConf  = new Configuracion ( $_SESSION ['fichero'] );		
		$conf = $sisifoConf -> getSisifoConf();
		$SisifoArchivo = new SisifoArchivo($y, $m, $d, $uid);
		
		$incidencias = $SisifoArchivo -> dame ( );
		
		$template = $conf -> getTemplate();
		
		echo ' <div class="big">{ Incidencias correspondientes al ' . $y . '/' . $m . '/' . $d  . ' }</div>';
		
		if ( $incidencias ) {
			foreach ($incidencias as $i) {	
				$line = aplicar_temp(stripslashes( $template ),&$i, &$SisifoInfo);	
				//echo ereg_replace("\n","<br>",$line);
				echo $line;
					
			}
		}else {
			echo "<br><br><br><center>No existe ninguna incidencia en esa fecha.</center>";
		}     
	echo '</div>';
	
	include("footer.php");
?>
