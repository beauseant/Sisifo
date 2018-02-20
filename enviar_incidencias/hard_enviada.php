<?PHP
session_start();		
	require("../lib.php");
	include ("../header.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoInciHard.php");
	
	

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$incidencia = new SisifoInciHard ( false, true );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}
	
	
	$desc_larga 	= cleanQuery ( $_REQUEST['desc_larga'] );
	$desc_breve 	= cleanQuery ( $_REQUEST['desc_breve'] );
	$tipo_hard 	= cleanQuery ( $_REQUEST['tipo_hard'] );
	$nom_maquina 	= cleanQuery ( $_REQUEST['nom_maquina'] );
	$id_maq 	= cleanQuery ( $_REQUEST['id_maq'] );
	$labo_maq 	= cleanQuery ( $_REQUEST['labo_maq'] );
	$cc		= cleanQuery ( $_REQUEST['cc'] );	
	


	//Comprobamos si se trata de una maquina que no se encuentra en la lista:
	if ( ! $id_maq || $id_maq == " ") {
		$maquina = new SisifoMaquina ( "", true );
		$id_maq = $maquina -> insertar ( $nom_maquina,gethost ($nom_maquina),$labo_maq );

	};
		
	$identificador = $incidencia -> insertar ( $desc_breve, $desc_larga, $tipo_hard, $id_maq, $cc );

	$incidencia = new SisifoInciHard ( $identificador );
	
	$cadena = "<a href=\"hardware.php\">::enviar nueva incidencia hardware | </a>";
	include ("menu_gen2.php");

?>
</DIV>
		<DIV CLASS="blogbody">
			<DIV CLASS="date">
				"La incidencia hardware ha sido enviada a S&iacute;sifo con los siguientes datos:"
			</DIV>
			<TABLE>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Tipo:</B></TD>
					<TD bgcolor = white> <?PHP echo $incidencia -> getTipo(); ?> </td>
				</TR>
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
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>M&aacute;quina:</B></TD>
					<TD bgcolor = white> <?PHP echo $lst_maquina ?> </td>
				</TR>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"> <b>Con copia a:</b> </TD>
					<TD bgcolor = white> <?PHP echo $cc ?> </td>
			</TABLE>
			<BR><BR>
			<B> La incidencia ha sido generada con el identificador  <?PHP echo ($identificador); ?>. Guardelo para 
				futuras consultas o reclamaciones. Muchas gracias. </B>
		</DIV>
	</DIV>

<?PHP
include ("../footer.php");
?>
