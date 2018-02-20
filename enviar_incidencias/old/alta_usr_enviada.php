<?PHP
session_start();		
	require("../lib.php");
	include ("../header.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoInciAltaUsr.php");
	require_once ("../classes/autenticar/class.SisifoAutenticador.php");
	
	
	$cadena = "<a href=\"alta_usr.php\">::enviar nueva alta usuario | </a>";
	include ("menu_gen2.php");
	
	$nombre 	= cleanQuery ( $_REQUEST['nombre'] );
	$apellido 	= cleanQuery ( $_REQUEST['apellido'] );
	$login_s 	= cleanQuery ( $_REQUEST['login_s'] );
	$correo 	= cleanQuery ( $_REQUEST['correo'] );
	$rol 		= cleanQuery ( $_REQUEST['rol'] );
	$desc_larga 	= cleanQuery ( $_REQUEST['desc_larga'] ) ;
	$cc		= cleanQuery ( $_REQUEST['cc'] ) ;


	if ( $login_s ) {
		$validacion = new SisifoAutenticadorLdap ( "" , "" );
		if ( $validacion -> buscar ( $login_s ) ) {
			echo 'El login sugerido para el nuevo usuario, ' . $login_s . 
			', ya se encuentra registrado.<a href="javascript:history.back()">
			 Volver.</a> ';
			exit ();
		}
		
	}
		

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$incidencia = new SisifoInciAltaUsr ( false, true );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}		

	if ( $desc_larga == " " ) {
		$desc_larga = "Alta del usuario: " . $nombre . " " . $apellido . " (". $rol .")";
	} 

	//Estos ser� puestos por el administrador cuando resuelva la incidencia:
	$id_usr = "";
	$passwd = "";
	$identificador = $incidencia -> insertar ( "Alta usuario", $desc_larga, $login_s, $correo, $nombre, $apellido, $rol, $cc );
		
?>


	</DIV>
		<DIV CLASS="blogbody">
			<DIV CLASS="date">
				"La incidencia alta de un usuario ha sido enviada a Sisifo con los siguientes datos:"
			</DIV>			
			<BR><BR>		
			<TABLE>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Nombre:</B></TD>
					<TD bgcolor = white> <?PHP echo $nombre ?> </td>
				</TR>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Apellido:</B></TD>
					<TD bgcolor = white> <?PHP echo $apellido ?> </td>
				</TR>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Rol:</B></TD>
					<TD bgcolor = white> <?PHP echo $rol ?> </td>
				</TR>
			</TABLE>			
			<B> La incidencia ha sido generada con el identificador  <?PHP echo ($identificador); ?>. Guardelo para 
				futuras consultas o reclamaciones. Muchas gracias. </B>
			<BR><BR>
		</DIV>
	</DIV>

<?PHP
include ("../footer.php");
?>
