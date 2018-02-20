<?PHP
session_start();		
	require("../lib.php");
	include ("../header.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoInciRFDocencia.php");
        require_once("../classes/class.SisifoUpload.php");

	
	

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$incidencia = new SisifoInciRFDocencia ( false, true );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}		
	

	$sisifoConf     = new Configuracion ( $_SESSION ['fichero'] );



	$uploaddir = $sisifoConf -> getRutaTmp ();
	$uploadfile = $uploaddir . cleanQuery ( basename($_FILES['userfile']['name']) );


	$nombrealumnos 	= cleanQuery ( $_REQUEST['nombrealumnos'] ); 
	$descripcion 	= cleanQuery ( $_REQUEST['descripcion'] );
        $tipotrabajo	= cleanQuery ( $_REQUEST['tipo'] ); 
        $cc             = cleanQuery ( $_REQUEST['cc'] );


        $identificador = $incidencia -> insertar ( $tipotrabajo, $nombrealumnos, $descripcion, $cc  );

        $cadena = "<a href=\"rfdocencia.php\">::enviar otra incidencia | </a>";
        include ("menu_gen2.php");


        $maxSize = 9000000;
        $uploadSize = $_FILES['userfile']['size'];


        if ( ($uploadSize<$maxSize) && (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) ) {
	        // echo "File is valid, and was successfully uploaded.\n";

                $size = $_FILES['userfile']['size'];
                $type = $_FILES['userfile']['type'];

                $name = cleanQuery ( $_REQUEST ['name'] ) . "_" . cleanQuery ( basename ( $_FILES['userfile']['name'] ) ) ;

                $size = file_size ( $size );


		$fichero = new SisifoUpload ();
        	$fichero -> insertar ( $identificador, $uploadfile, $size, $name, $type );
	}
	//Si hemos encontrado un error al subir un fichero puede ser que sea porque el usuario, simplemente, no ha querido adjuntar un fichero
	//En ese caso simplemente se inserta la incidencia pero sin adjuntar nada. No damos error.
	else   { 
		if ( $_FILES['userfile']['name'] ) {
			echo 'Error subiendo el archivo o este ocupa demasiado ';   
			echo '<A href="https://www.tsc.uc3m.es/incidencias/enviar_incidencias/rfdocencia.php">Volver</A>';
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
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Descripci&oacute;n:</B></TD>
					<TD bgcolor = white> <?PHP echo $descripcion ?> </td>
				</TR>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Nombre de los alumnos:</B></TD>
					<TD bgcolor = white> 	
						<?PHP
							echo $nombrealumnos; 
						?>
					</TD>
				</TR>
				<TR>
					<TD bgColor="#dddddd" style="border:1px solid #999999;"><B>Tipo de trabajo:</B></TD>
					<TD bgcolor = white> 
                                        	<?PHP
                                                                echo $tipotrabajo;
                                        	?>
					</TD>
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
