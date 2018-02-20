<?PHP
session_start(); 

include ("lib.php");
include ("header.php");
require_once ("classes/class.SisifoInciHard.php");
require_once ("classes/class.SisifoInciAltaUsr.php");
require_once ("classes/class.SisifoInciBajaUsr.php");
require_once ("classes/class.SisifoInciSoft.php");
require_once ("classes/class.SisifoInciLlave.php");
require_once ("classes/class.SisifoCambioRol.php");
require_once ("classes/class.SisifoInciOtras.php");
require_once ("classes/class.SisifoInciMaquina.php");
require_once ("classes/class.SisifoInciPedirCable.php");
require_once ("classes/class.SisifoInciCluster.php");
require_once ("classes/class.SisifoInciRFDocencia.php");
require_once ("classes/class.SisifoInciRFInvestigacion.php");




$pid = $_REQUEST['pid'];
$tipo_incidencia = $_REQUEST['tipo_incidencia'];

	switch($tipo_incidencia) {
                case "HARDWARE":
			$Incidencia = new SisifoInciHard ( $pid );
			break;
                case "SOFTWARE":
			$Incidencia = new SisifoInciSoft ( $pid );
			break;
		case "ALTAS USUARIO":
			$Incidencia = new SisifoInciAltaUsr ( $pid );
			break;
		case "BAJAS USUARIO":
			$Incidencia = new SisifoInciBajaUsr ( $pid );
			break;
		case "LLAVES";
			$Incidencia = new SisifoInciLlave ( $pid );
			break;
		case "CAMBIO ROL";
			$Incidencia = new SisifoCambioRol ( $pid );
			break;
		case "OTRAS";
			$Incidencia = new SisifoInciOtras ( $pid );
			break;			
		case "ALTA MAQUINA";
			$Incidencia = new SisifoInciMaquina ( $pid );
			break;			
		case "CABLES";
			$Incidencia = new SisifoInciPedirCable ( $pid );
			break;
		case "CLUSTER";
			$Incidencia = new SisifoInciCluster ( $pid );
			break;
		case "RF DOCENCIA";
			$Incidencia = new SisifoInciRFDocencia ( $pid );
			break;
                case "RF INVESTIGACION";
                        $Incidencia = new SisifoInciRFInvestigacion ( $pid );
                        break;

		default:
			echo "Imposible mostrar la incidencia...";
			exit();			
			break;	
	
	}
	//SisifoInciLlave

	//$Incidencia = new SisifoIncidencia ( $pid );
	
	//Para que pueda ver los detalles de una incidencia el usuario:
	//	Debe estar autenticado en la sesi�.
	//	El user id debe ser el mismo que el de la incidencia.

	
	$inci_uid = $Incidencia -> getIdUsuario();
	
	$uid = getUID($_SESSION['login']);
	

	if( isLoggedIn()  ) {
		if ($inci_uid != $uid )  {		
			echo "El usuario " . getUID($_SESSION['login']) . " No tiene permiso para ver esa incidencia....";
			exit();
		}
	}else{
		echo "No tiene permiso para ver...";
		exit();
	}
?>
<DIV CLASS="blogbody">
			<DIV CLASS="date">
				Adjuntar fichero a la incidencia:
			</DIV>
                        <FORM NAME=frmrf ACTION="enviaradj.php" METHOD="POST" enctype="multipart/form-data">
                                <TABLE CELLPADDING="15px" ALIGN="center">
                                        <TR class="celdaoscura">
                                                <TD> Adjuntar fichero (hasta 8 megas): </TD>
                                                <TD class = "celdaclara">
                                                                <input type="hidden" name="MAX_FILE_SIZE" value="9000000" />
                                                                <input type="hidden" name="idinci" value="<?php echo $pid; ?>" />
                                                                 descripci&oacute;n: <input type="text" name="name" size="25" length="25" value="">
                                                                fichero: <input name="userfile" type="file" size="25"/>
                                                       
                                                </TD>
                                        </TR>
                                </TABLE>
                                <DIV ALIGN=RIGHT>
                                        <INPUT NAME="Enviar" VALUE="adjuntar" TYPE="SUBMIT" >
                                </DIV>
                                </FORM></div> 
			<DIV CLASS="date">
				<CENTER>
					 <A HREF="mostrar.php">::volver::</a> 
				</CENTER>
			</DIV>
		</DIV>

<?PHP
	echo "<br><br>";
	include ("footer.php");
?>
