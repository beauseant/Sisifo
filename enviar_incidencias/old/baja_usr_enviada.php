<?PHP
session_start();		
	require("../lib.php");
	include ("../header.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoInciBajaUsr.php");
	

	
	$cadena = "<a href=\"baja_usr.php\">::enviar nueva baja de usuario | </a>";
	include ("menu_gen2.php");
	
	$nombre 	= cleanQuery ( $_REQUEST['nombre'] ) ;
	$apellido 	= cleanQuery ( $_REQUEST['apellido'] ) ;
	$login_usr 	= cleanQuery ( $_REQUEST['login_usr'] );
	$correo 	= cleanQuery ( $_REQUEST['correo'] );
	$rol 		= cleanQuery ( $_REQUEST['rol'] );
	$desc_larga 	= cleanQuery ( $_REQUEST['desc_larga'] );
        $cc             = cleanQuery ( $_REQUEST['cc'] ) ;


	if ( $login_usr ) {
		$validacion = new SisifoAutenticadorLdap ( "" , "" );
		if ( ! ( $validacion -> buscar ( $login_usr ) ) ) {
			echo 'El login sugerido para el nuevo usuario, ' . $login_usr . 
			',no existe en el sistema, por lo que no puede darse de baja.
			<a href="javascript:history.back()">
			 Volver.</a> ';
			exit ();
		}
		
	}
	

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$incidencia = new SisifoInciBajaUsr ( false, true );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}		

	if ( $desc_larga == " " ) {
		$desc_larga = "Baja del usuario: " . $nombre . " " . $apellido . " (". $login_usr .")";
	} 

	//Estos ser� puestos por el administrador cuando resuelva la incidencia:
	$id_usr = "";
	$identificador = $incidencia -> insertar ( "Baja usuario", $desc_larga, $login_usr,
		 $correo, $id_usr, $nombre, $apellido, $rol, $cc );
	
	
?>
</DIV>
		<DIV CLASS="blogbody">
			<DIV CLASS="date">
				"La incidencia baja de un usuario ha sido enviada a S�ifo con los siguientes datos:"
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
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Login:</B></TD>
					<TD bgcolor = white> <?PHP echo $login_usr ?> </td>
				</TR>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Rol:</B></TD>
					<TD bgcolor = white> <?PHP echo $rol ?> </td>
				</TR>
				
			</TABLE>			
			<B> La incidencia ha sido generada con el identificador  <?PHP echo ($identificador); ?>. Guardelo para 
				futuras consultas o reclamaciones. Muchas gracias. </B>
			<BR>
		</DIV>
	</DIV>

<?PHP
include ("../footer.php");
?>
