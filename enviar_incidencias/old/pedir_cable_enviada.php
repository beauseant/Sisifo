<?PHP
session_start();		
	require("../lib.php");
	include ("../header.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoInciPedirCable.php");
	

	
	$cadena = "<a href=\"pedir_cable.php\">::enviar nueva incidencia | </a>";
	include ("menu_gen2.php");

	

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$incidencia = new SisifoInciPedirCable ( false, true );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}		
	
	$cantidad 		= cleanQuery ( $_REQUEST['cantidad'] );
	$tipo 			= cleanQuery ( $_REQUEST['tipo'] );
	$desc_larga 		= cleanQuery ( $_REQUEST['desc_larga'] );
        $cc                     = cleanQuery ( $_REQUEST['cc'] );

		
	$identificador = $incidencia -> insertar ( "Peticion de cable", $desc_larga,
		   $cantidad, $tipo, $cc );

		 
?>
</DIV>
		<DIV CLASS="blogbody">
			<DIV CLASS="date">
				"La incidencia ha sido enviada a S&iacute;ifo con los siguientes datos:"
			</DIV>			
			<BR><BR>		
			<TABLE>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Tipo:</B></TD>
					<TD bgcolor = white> <?PHP echo "Peticion de cables" ?> </td>
				</TR>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Cantidad:</B></TD>
					<TD bgcolor = white> <?PHP echo $cantidad ?> </td>
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
		 	
