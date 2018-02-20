<?PHP
session_start();		
	require("../lib.php");
	include ("../header.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoInciMaquina.php");
	
	

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$incidencia = new SisifoInciMaquina ( false, true );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}
	
	$nombre = cleanQuery ( $_REQUEST['nombre'] );
	$labo = cleanQuery ( $_REQUEST['labo'] );
	$desc_larga = cleanQuery ( $_REQUEST['desc_larga'] );

	$desc_breve = "Alta de una maquina en el sistema:";
	$identificador = $incidencia -> insertar ( $desc_breve, $desc_larga, $nombre, $labo );
	
	
	$cadena = "<a href=\"nueva_maq.php\">::enviar otra alta | </a>";
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
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Nombre:</B></TD>
					<TD bgcolor = white> <?PHP echo $nombre ?> </td>
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
