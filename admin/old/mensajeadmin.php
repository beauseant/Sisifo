<?php
session_start();

   
    require_once("../lib.php");
    require_once("../classes/mensajes/class.SisifoArchivoMensaje.php");
    require_once ("../classes/mandarcorreo/class.Sisifocorreo.php");
    require_once ("../classes/class.SisifoIncidencia.php");
    require_once ("../classes/autenticar/class.SisifoAutenticador.php");
    
    
    
    
    
    include("headerpeque.php");

	
	
       
     if(isLoggedIn()) {
		$uid = getUID($_SESSION['login']);
     }else {
     	echo"Ha probado a <A href=\"logout.php\">registrarse</A>?";
	exit();
     }  

     	if (!  esAdmin() ) {
          	echo"Debe ser administrador para ver esta pagina";
		exit();
     	}

	$pid = $_REQUEST['pid'];
	$texto = $_REQUEST['texto'];

     $Incidencia = new SisifoIncidencia ( $pid );
     $cc             = $Incidencia -> getCC();


     $auten = new SisifoAutenticadorLdap ("", "");
     $login_usr = $auten -> getLogin ( $Incidencia -> getIdUsuario () );


     $sisifoConf  = new Configuracion ( $_SESSION ['fichero'] );
     $inci_mail = $sisifoConf -> getIncimail();

     $retroceso=1;

     if ( isSet ( $texto ) &&  ( $texto != "" ) ) {


        /****************************** */
        /* PARTE PARA ADJUNTAR ARCHIVOS */
        /****************************** */

        //$sisifoConf     = new Configuracion ( $_SESSION ['fichero'] );

        $uploaddir = $sisifoConf -> getRutaTmp ();
        $uploadfile = $uploaddir . cleanQuery ( basename($_FILES['userfile']['name']) );

        $identificador  = cleanQuery ( $pid );

        $maxSize = 9000000;
        $uploadSize = $_FILES['userfile']['size'];

	//echo "userfile " .  $_FILES['userfile']['tmp_name'] . " uploadfile" . $uploadfile;

        if ( ($uploadSize<$maxSize) && (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) ) {
                //echo "File is valid, and was successfully uploaded.\n";
                $size = $_FILES['userfile']['size'];
                $type = $_FILES['userfile']['type'];
                //en este caso el ficheor siempre estara vacio al no ser un campo del formulario, se coge el nombre del fichero
                //$name = cleanQuery ( $_REQUEST ['name'] ) . " " . cleanQuery ( basename ( $_FILES['userfile']['name'] ) );
                //if ( $name == "" ) {
                        $name =  cleanQuery ( basename ( $_FILES['userfile']['name'] ) ) ;
                //}

                $size = file_size ( $size );


                $fichero = new SisifoUpload ();
                $fichero -> insertar ( $identificador, $uploadfile, $size, $name, $type );

                $ficheroadjunto = true;

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



     	$de 		= "0";
	$a 		= $Incidencia -> getIdUsuario ();
     	$insertar 	= true;

        if ( $ficheroadjunto ) {
                $texto = $texto . "\n\n\n ---- \n \nLa incidencia contiene un fichero adjunto llamado $name que ocupa $size";
        }


	$mensaje = new SisifoMensaje ( $pid, $de, $a, "", $texto, $insertar );
	
	
	$subject = "Mensaje de la incidencia ". $Incidencia ->getId() . " (" . $Incidencia ->getDescBreve() . ")";
	
	$mymail = new Sisifocorreo ( "noreply@tsc.uc3m.es", $login_usr, $cc, $subject,$texto ); 

	$mymail -> enviar();	
		
	$retroceso=2;	
     }
     
        include ("menu_mensaje.php");

 
     echo '
	<DIV CLASS="blogbody">
			<DIV CLASS="date">
				Mensajes de la incidencia:
			</DIV>
	';
     
     	$lista_mensajes = new SisifoArchivoMensaje ( $pid );
     
        $mensajes = $lista_mensajes -> buscar() ;
	
	if ( $mensajes ) {
		echo '
			<table>
		';
		
		foreach ($mensajes as $i) {
			if ( $i -> getDe() == 0 ) {
				$de = $inci_mail;
			} else {
				$de =  $auten -> getLogin ( $i -> getDe() );
			}
			
			if ( $i -> getA() == 0 ) {
				$a = $inci_mail;
			} else {
				$a =  $auten -> getLogin ( $i -> getA() );
			}
			echo '
				<tr width="850">
					<td bgColor="#dddddd" style="border:1px solid #999999;"
				   		align="right" valign="top">
							<b>De</b> ' . $de . '<br> <b>CC:</b>' . $cc . '<br>'. 
							'<b> a </b>'. $a .'<p>' . $i -> getfecha() . '
					</td>				
					<td bgcolor="#eeeeee"> ' . nl2br ($i -> gettexto() ) . ' </td>
				</tr>
			';
		}
		echo "	</table>";
	}else {
		echo "No existen mensajes";
	}     

?>
<br><br><br>

<form method=POST action="mensajeadmin.php<?PHP echo "?pid=" . $pid  ?>"enctype="multipart/form-data">
	<input type=hidden name=blogid value="1">
	<input type=hidden name=eid value="182">
	<input type=hidden name=tem value="">
	<input type=hidden name=op value="add">

	<table>
		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" colspan="2">
			<b>Introduzca el mensaje a enviar:</b>
		</td></tr>
		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" valign="top" align="right">
			<b>A:</b></td>
			<td  bgColor="#dddddd" style="border:1px solid #999999;" valign="top"> 
				<?php echo $login_usr; ?>
		</td></tr> 
		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" valign="top" align="right">			
			<b>De:</b></td>
			<td bgColor="#dddddd" style="border:1px solid #999999;" valign="top">
			 <?php echo "Sistema de gesti&oacute;n de incidencias -" . $inci_mail . "-"; ?>
		</td></tr>
                <tr><td bgColor="#dddddd" style="border:1px solid #999999;" valign="top" align="right">
                        <b>CC:</b></td>
                        <td bgColor="#dddddd" style="border:1px solid #999999;" valign="top">
                         <?php echo $cc; ?>
                </td></tr>

		<tr><td bgColor="#dddddd" style="border:1px solid #999999;" valign="top" align="right">
			<b>Mensaje:</b></td>
			<td><textarea name="texto" rows="10" cols="60" wrap="physical"></textarea></td></tr>
               <tr><td bgColor="#dddddd" style="border:1px solid #999999;" valign="top" align="right">
                        <b>Adjuntar archivo:</b></td>
                        <td>
                            <input type="hidden" name="MAX_FILE_SIZE" value="9000000" />
                            <input type="hidden" name="idinci" value="<?php echo $pid; ?>" />
                            <input name="userfile" type="file" size="25"/>
                        </td>
                </tr>

	</table>
	<input class="search" type="submit" value="Enviar el mensaje">
</form>


				
</div>

