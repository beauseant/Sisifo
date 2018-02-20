<?php 
session_start();

   
    require_once("lib.php");
    require_once("classes/mensajes/class.SisifoArchivoMensaje.php");
    require_once ("config.php");
    //require_once ("classes/mandarcorreo/class.Sisifopgp.php");
    require_once ("classes/mandarcorreo/class.Sisifocorreo.php");
    require_once ("classes/class.SisifoIncidencia.php");
    
    
    
    
    
    include("header.php");

        //echo $_SESSION['login'];
	//echo $_SESSION['ip'];
	
	global $sisifoConf;
	
       
     if(isLoggedIn()) {
		$uid = getUID($_SESSION['login']);
     }else {
     	echo"Ha probado a <A href=\"logout.php\">registrarse</A>?";
	exit();
     }  
	
	$pid = $_REQUEST['pid'];
	$texto = $_REQUEST['texto']; 
	
     $Incidencia = new SisifoIncidencia ( $pid );
	
       
     $sisifoConf  = new Configuracion ( $_SESSION ['fichero'] );
     $inci_mail = $sisifoConf -> getIncimail();
       
     
     $auten = new SisifoAutenticadorLdap ("", "");
     if ( $Incidencia -> getIdUsuario() !=  $uid ) {
     	echo "No tiene permiso para ver esa incidencia....";
	exit();
     }
	 
     if ( isSet ( $texto ) &&  ( $texto != "" ) ) {
     	$de = $_SESSION['uid'];
	$a = "0";
     	$insertar = true;
	$mensaje = new SisifoMensaje ( $pid, $de, $a, "", $texto, $insertar );
	
	$subject = "Mensaje de la incidencia ". $Incidencia ->getId() . " (" . $Incidencia ->getDescBreve() . ")";

	$mymail = new Sisifocorreo ( $_SESSION['mail'], $inci_mail, $subject,$texto ); 

	$mymail -> enviar();	
		
	
     }
     
     
     echo '
	<DIV CLASS="blogbody">
			<DIV CLASS="date">
				Mensajes de la incidencia:
			</DIV>
	';
     
     	$lista_mensajes = new SisifoArchivoMensaje ( $pid );
     
        $mensajes = $lista_mensajes -> buscar() ;
	
	if ( $mensajes ) {
		echo '
			<table>
		';
		
		foreach ($mensajes as $i) {

			if ( $i -> getDe() == 0 ) {
				$de = $inci_mail;
			} else {
				$de =  $auten -> getLogin ( $i -> getDe() );
			}

			if ( $i -> getA() == 0 ) {
				$a = $inci_mail;
			} else {
				$a =  $auten -> getLogin ( $i -> getA() );
			}

			echo '
				<tr width="850">
					<td bgColor="#dddddd" style="border:1px solid #999999;"
				   		align="right" valign="top">
							<b>De</b> ' .$de . 
							'<b> a </b>'. $a.'<p>' . $i -> getfecha() . '
					</td>				
					<td bgcolor="#eeeeee"> ' . nl2br ($i -> gettexto() ) . ' </td>
				</tr>
			';
		}
		echo "	</table>";
	}else {
		echo "No existen mensajes";
	}     

?>
<br><br><br>

<form method=POST action="mensaje.php<?PHP echo "?pid=" . $pid  ?>">
	<input type=hidden name=blogid value="1">
	<input type=hidden name=eid value="182">
	<input type=hidden name=tem value="">
	<input type=hidden name=op value="add">

	<table>
		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" colspan="2">
			<b>Introduzca el mensaje a enviar:</b>
		</td></tr>
		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" valign="top" align="right">			
			<b>A:</b></td>
			<td bgColor="#dddddd" style="border:1px solid #999999;" valign="top">
			 <?php echo "Sistema de gesti&oacute;n de incidencias -" . $inci_mail . "-"; ?>
		</td></tr>
		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" valign="top" align="right">
			<b>De:</b></td>
			<td  bgColor="#dddddd" style="border:1px solid #999999;" valign="top"> 
				<?php echo $_SESSION ['gecos'] . " -" . $_SESSION ['mail'] . "-"; ?>
		</td></tr> 
		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" valign="top" align="right">
			<b>Mensaje:</b></td>
			<td><textarea name="texto" rows="10" cols="60" wrap="physical"></textarea></td></tr>
	</table>
	<input class="search" type="submit" value="Enviar el mensaje">
</form>
				<DIV CLASS="date">
					<CENTER>
						 <A HREF="mostrar.php">::men&uacute; principal::</a> 
					</CENTER>
				</DIV>


				
</div>

<?PHP
	echo "<br><br>";
	include ("footer.php");
?>
