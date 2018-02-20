<?PHP
session_start();		

	require("../lib.php");
	include ("../header.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoInciLlave.php");
	

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$incidencia = new SisifoInciLlave ( false, true );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}
	
	$laboratorio 		= cleanQuery ( $_REQUEST['laboratorio'] );
	$estado 		= cleanQuery ( $_REQUEST['estado'] );
	$desc_larga 		= cleanQuery ( $_REQUEST['desc_larga'] );
        $cc                     = cleanQuery ( $_REQUEST['cc'] );


	if ( $desc_larga == " " ) {
		$desc_larga = "Copia llave: " . $laboratorio . " (". $estado .")";
	} else {
		$desc_larga = $desc_larga . "-" . "Copia llave del: " . $laboratorio . "-";
	}

	$desc_breve = "Llave";
	$identificador = $incidencia -> insertar ( $desc_breve, $desc_larga, $estado, $laboratorio, $cc );
	
	$cadena = "<a href=\"llaves.php\">::enviar nueva incidencia sobre llaves | </a>";
	include ("menu_gen2.php");
	
	
?>
</DIV>
		<DIV CLASS="blogbody">
			<DIV CLASS="date">
				"La incidencia sobre la copia de llaves ha sido enviada a S&iacute;sifo con los siguientes datos:"
			</DIV>
			<TABLE>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Descripci&oacute;n breve:</B></TD>
					<TD bgcolor = white> <?PHP echo $desc_breve ?> </td>
				</TR>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Descripci&oacute;n larga:</B></TD>
					<?PHP
						echo ('
							<TD bgcolor = white> ' .
								nl2br ($desc_larga) 
							.'</TD>
						    ');
					?>
				</TR>
                                <TR>
                                        <TD bgColor="#dddddd" style="border:1px solid #999999;"> <b>Con copia a:</b> </TD>
                                        <TD bgcolor = white> <?PHP echo $cc ?> </td>
                                </TR>

			</TABLE>
			<BR><BR>
			<B> La incidencia ha sido generada con el identificador  <?PHP echo ($identificador); ?>. Guardelo para 
				futuras consultas o reclamaciones. Muchas gracias. </B>
			<BR>
		</DIV>
	</DIV>

<?PHP
include ("../footer.php");
?>
