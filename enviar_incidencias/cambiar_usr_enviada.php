<?PHP
session_start();		
	require("../lib.php");
	include ("../header.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoCambioRol.php");
	

	
	$cadena = "<a href=\"cambia_usr.php\">::enviar nueva cambio de status | </a>";
	include ("menu_gen2.php");
	
	$nombre 		= cleanQuery ( $_REQUEST['nombre'] );
	$apellido 		= cleanQuery ( $_REQUEST['apellido'] );
	$loginu 		= cleanQuery ( $_REQUEST['loginu'] );
	$rolant 		= cleanQuery ( $_REQUEST['rolant'] );
	$rolnuevo 		= cleanQuery ( $_REQUEST['rolnuevo'] );
        $cc             	= cleanQuery ( $_REQUEST['cc'] );


	if ( $login ) {
		$validacion = new SisifoAutenticadorLdap ( "" , "" );
		if ( ! ( $validacion -> buscar ( $loginu ) ) ) {
			echo 'El login sugerido para el nuevo usuario, ' . $loginu . 
			',no existe en el sistema, por lo que no puede cambiar de status.
			<a href="javascript:history.back()">
			 Volver.</a> ';
			exit ();
		}
	}
	

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$incidencia = new SisifoCambioRol ( false, true );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}		
		
	$desc_larga = $nombre . " " . $apellido . "-" . $loginu ."-";
	$identificador = $incidencia -> insertar ( "Cambio rol", $desc_larga,
		 $loginu, $rolant, $rolnuevo, $nombre, $apellido, $cc );

		 
?>
</DIV>
		<DIV CLASS="blogbody">
			<DIV CLASS="date">
				"La incidencia cambiar status ha sido enviada a S&iacute;ifo con los siguientes datos:"
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
					<TD bgcolor = white> <?PHP echo $loginu ?> </td>
				</TR>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Rol:</B></TD>
					<TD bgcolor = white> <?PHP echo $rolant ?> </td>
				</TR>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Rol:</B></TD>
					<TD bgcolor = white> <?PHP echo $rolnuevo ?> </td>
				</TR>
                                <TR>
                                        <TD bgColor="#dddddd" style="border:1px solid #999999;"> <b>Con copia a:</b> </TD>
                                        <TD bgcolor = white> <?PHP echo $cc ?> </td>
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
		 	
