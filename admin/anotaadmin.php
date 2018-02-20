<?php
session_start();

   
    require_once("../lib.php");
    require_once("../classes/anotaciones/class.SisifoArchivoAnotacion.php");
    require_once ("../classes/class.SisifoIncidencia.php");
    require_once ("../classes/autenticar/class.SisifoAutenticador.php");
    
    
    
    
    
    include("headerpeque.php");


	
	
       
     if(isLoggedIn()) {
		$uid = getUID($_SESSION['login']);
     }else {
     	echo"Ha probado a <A href=\"logout.php\">registrarse</A>?";
	exit();
     }  

     	if (!  esAdmin() ) {
          	echo"Debe ser administrador para ver esta pagina";
		exit();
     	}

	$pid = $_REQUEST['pid'];
	$texto = $_REQUEST['texto'];
	//echo "<------------------------>" . $pid; exit();
	
     $Incidencia = new SisifoIncidencia ( $pid );

     $auten = new SisifoAutenticadorLdap ("", "");
     $login_usr = $auten -> getLogin ( $uid );



     $sisifoConf  = new Configuracion ( $_SESSION ['fichero'] );
     $inci_mail = $sisifoConf -> getIncimail();

     $retroceso=1;

     if ( isSet ( $texto ) &&  ( $texto != "" ) ) {
     	$de = $uid;
	$a = $Incidencia -> getIdUsuario ();
     	$insertar = true;
	$anotacion = new SisifoAnotacion ( $pid, $de, "", $texto, $insertar );

	$retroceso = 2;

     }
     
	include ("menu_mensaje.php");    
 
     echo '
	<DIV CLASS="blogbody">
			<DIV CLASS="date">
				Anotaciones de la incidencia:
			</DIV>
	';
     
     	$lista_anota = new SisifoArchivoAnotacion ( $pid );
     
	$anotaciones = $lista_anota -> buscar() ;
	
	if ( $anotaciones ) {
		echo '
			<table>
		';

		$auten = new SisifoAutenticadorLdap ("", "");		
		foreach ($anotaciones  as $i) {	
     			$login_usr = $auten -> getLogin ( $i -> getusuario() );
			echo '
				<tr width="850">
					<td bgColor="#dddddd" style="border:1px solid #999999;"
				   		align="right" valign="top">'. 
							'<b> De </b>'. $login_usr .'<p>' . $i -> getfecha() . '
					</td>				
					<td bgcolor="#eeeeee"> ' . nl2br ($i -> gettexto() ) . ' </td>
				</tr>
			';
		}
		echo "	</table>";
	}else {
		echo "No existen anotaciones";
	}     

?>
<br><br><br>

<form method=POST action="anotaadmin.php<?PHP echo "?pid=" . $pid  ?>">
	<input type=hidden name=blogid value="1">
	<input type=hidden name=eid value="182">
	<input type=hidden name=tem value="">
	<input type=hidden name=op value="add">

	<table>
		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" colspan="2">
			<b>Introduzca la anotacion privada:</b>
		</td></tr>
		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" valign="top" align="right">
			<b>Anotacion de:</b></td>
			<td  bgColor="#dddddd" style="border:1px solid #999999;" valign="top"> 
				<?php echo $_SESSION['login'];; ?>
		</td></tr> 
		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" valign="top" align="right">
			<b>Mensaje:</b></td>
			<td><textarea name="texto" rows="10" cols="60" wrap="physical"></textarea></td></tr>
	</table>
	<input class="search" type="submit" value="Guardar">
</form>


				
</div>

