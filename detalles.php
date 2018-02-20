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
require_once ("classes/class.SisifoInciAudio.php");




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
                case "AUDIO";
                        $Incidencia = new SisifoInciAudio ( $pid );
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
				Detalles de la incidencia:
			</DIV>
				<?PHP
					echo  '<TABLE  BORDER="0">';
						echo $Incidencia -> toStr();
					echo '</TABLE>';
				?>

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
