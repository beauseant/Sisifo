<?PHP
session_start();		
	require("../lib.php");
	include ("../header.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoInciCluster.php");
	
	

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$incidencia = new SisifoInciCluster ( false, true );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}		
	
	$desc_breve = cleanQuery ( $_REQUEST['desc_breve'] );
	$desc_larga = cleanQuery ( $_REQUEST['desc_larga'] );
        $cc         = cleanQuery ( $_REQUEST['cc'] );

	
	$identificador = $incidencia -> insertar ( $desc_breve, $desc_larga, $cc );
	
	
	$cadena = "<a href=\"cluster.php\">::enviar otra incidencia | </a>";
	include ("menu_gen2.php");
	
	
?>
</DIV>
		<DIV CLASS="blogbody">
			<DIV CLASS="date">
				"La incidencia ha sido enviada a S&iacute;sifo con los siguientes datos:"
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
