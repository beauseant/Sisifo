<?PHP
session_start();		
	require("../lib.php");
	include ("../header.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoInciAudio.php");
        require_once("../classes/class.SisifoUpload.php");

	
	

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$incidencia = new SisifoInciAudio ( false, true );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}		
	

	$sisifoConf     = new Configuracion ( $_SESSION ['fichero'] );



	$uploaddir 		= $sisifoConf -> getRutaTmp ();
	$uploadfile 		= $uploaddir . cleanQuery ( basename($_FILES['userfile']['name']) );

	$desc_breve 		= cleanQuery ( $_REQUEST['desc_breve'] );
        $desc_larga 		= cleanQuery ( $_REQUEST['desc_larga'] );
        $cc                     = cleanQuery ( $_REQUEST['cc'] );




        $identificador = $incidencia -> insertar ( $desc_breve, $desc_larga, $cc );

        $cadena = "<a href=\"audio.php\">::enviar otra incidencia de audio | </a>";
        include ("menu_gen2.php");


	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	        // echo "File is valid, and was successfully uploaded.\n";

                $size = $_FILES['userfile']['size'];
                $type = $_FILES['userfile']['type'];
                $name = cleanQuery ( $_REQUEST ['name'] );
		if ( $name == "" ) {
			$name = cleanQuery ( basename ( $_FILES['userfile']['name'] ) );
		} 
		
		$size = file_size ( $size );
		$fichero = new SisifoUpload ();
        	$fichero -> insertar ( $identificador, $uploadfile, $size, $name, $type );
	//Si hemos encontrado un error al subir un fichero puede ser que sea porque el usuario, simplemente, no ha querido adjuntar un fichero
	//En ese caso simplemente se inserta la incidencia pero sin adjuntar nada. No damos error.
	}else   { 
		if ( $_FILES['userfile']['name'] ) {
			echo 'Error subiendo el archivo o este ocupa demasiado ';   
			echo '<A href="https://www.tsc.uc3m.es/incidencias/enviar_incidencias/otras.php">Volver</A>';
			exit ();
		}
	}
	
	
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
