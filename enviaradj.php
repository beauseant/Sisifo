<?PHP
session_start();		
	require("lib.php");
	include ("header.php");
        require_once("classes/class.SisifoUpload.php");
    	require_once("classes/mensajes/class.SisifoArchivoMensaje.php");
    	require_once ("classes/mandarcorreo/class.Sisifocorreo.php");	
	

	$uid = getUID($_SESSION['login']);	
	
	if( ($uid != 0 ) ) {		
		$a = 0;
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}		
	

	$sisifoConf     = new Configuracion ( $_SESSION ['fichero'] );



	$uploaddir = $sisifoConf -> getRutaTmp ();
	$uploadfile = $uploaddir . cleanQuery ( basename($_FILES['userfile']['name']) );


        $identificador	= cleanQuery ( $_REQUEST['idinci'] ); 

        include ("menu_gen2.php");


        $maxSize = 9000000;
	$uploadSize = $_FILES['userfile']['size'];
	

	if ( ($uploadSize<$maxSize) && (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) ) {
	        // echo "File is valid, and was successfully uploaded.\n";

                $size = $_FILES['userfile']['size'];
                $type = $_FILES['userfile']['type'];
                $name = cleanQuery ( $_REQUEST ['name'] ) . " -" . cleanQuery ( basename ( $_FILES['userfile']['name'] ) ) . "-";
		if ( $name == "" ) {
			$name =  cleanQuery ( basename ( $_FILES['userfile']['name'] ) ) ;
		} 

                $size = file_size ( $size );


		$fichero = new SisifoUpload ();
        	$fichero -> insertar ( $identificador, $uploadfile, $size, $name, $type );


        	$de = $_SESSION['uid'];
        	$a = "0";
        	$insertar = true;
		$texto = "Nuevo fichero adjuntado a la incidencia $identificador."; 
        	$mensaje = new SisifoMensaje ( $identificador, $de, $a, "", $texto, $insertar );
        
        	//$subject = "Mensaje de la incidencia ". $Incidencia ->getId() . " (" . $Incidencia ->getDescBreve() . ")";

        	$mymail = new Sisifocorreo ( $_SESSION['mail'], $inci_mail, "pepe", "luis" ); 

        	$mymail -> enviar(); 



	}
	//Si hemos encontrado un error al subir un fichero puede ser que sea porque el usuario, simplemente, no ha querido adjuntar un fichero
	//En ese caso simplemente se inserta la incidencia pero sin adjuntar nada. No damos error.
	else   { 
		if ( $_FILES['userfile']['name'] ) {
			echo 'Error subiendo el archivo o este ocupa demasiado ';   
			echo '<A href="mostrar.php">Volver</A>';
			exit ();
		}
	}
	
	
?>
</DIV>
		<DIV CLASS="blogbody">
			<DIV CLASS="date">
				"El fichero ha sido adjuntado correctamente"
			</DIV>
			<?php echo "Adjuntado $identificador, $uploadfile, $size, $name, $type"; ?>
		</DIV>
                        <DIV CLASS="date">
                                <CENTER>
                                         <A HREF="mostrar.php">::volver::</a> 
                                </CENTER>
                        </DIV>

	</DIV>

<?PHP
include ("../footer.php");
?>
