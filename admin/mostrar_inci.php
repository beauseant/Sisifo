<?PHP
session_start(); 

include ("../lib.php");
require_once ("../classes/class.SisifoInciHard.php");
require_once ("../classes/class.SisifoInciAltaUsr.php");
require_once ("../classes/class.SisifoInciBajaUsr.php");
require_once ("../classes/class.SisifoInciSoft.php");
require_once ("../classes/class.SisifoInciLlave.php");
require_once ("../classes/class.SisifoCambioRol.php");
require_once ("../classes/class.SisifoInciOtras.php");
require_once ("../classes/class.SisifoInciMaquina.php");
require_once ("../classes/class.SisifoInciPedirCable.php");
require_once ("../classes/iterator/EstadoInciIterator.php");
require_once ("../classes/class.SisifoInciCluster.php");
require_once ("../classes/class.SisifoInciRFDocencia.php");
require_once ("../classes/class.SisifoInciRFInvestigacion.php");
require_once ("../classes/class.SisifoInciAudio.php");




include ("headerpeque.php");	
include ("menu_inci.php");
	
	$uid = getUID($_SESSION['login']);
	

	if( ($uid == 0 ) ) {
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}		

     	if (!  esAdmin() ) {
          	echo"Debe ser administrador para ver esta pagina";
		exit();
     	}

        // extract($_REQUEST);extract($_REQUEST);
	extract($_REQUEST);
	// $id = $_REQUEST['id'];
	
	$id = trim ($id);
	
	$incidencia_padre = new SisifoIncidencia ( $id );
	$tipo_incidencia  = $incidencia_padre -> getTipo();

	//Se ha cambiado el tipo de la incidencia, y hay que actualizarlo, ademas de cambiar la hora:
	
	$cambiar = $_REQUEST['cambiar'];
	
	if ( $cambiar ) {
		$estadoinci = $_REQUEST['estadoinci'];
		$incidencia_padre -> setEstado ( $estadoinci,  $uid );
	}

	switch($tipo_incidencia) {
                case "HARDWARE":
			$Incidencia = new SisifoInciHard ( $id );
			break;
                case "SOFTWARE":
			$Incidencia = new SisifoInciSoft ( $id );
			break;
		case "ALTAS USUARIO":
			$Incidencia = new SisifoInciAltaUsr ( $id );
			break;
		case "BAJAS USUARIO":
			$Incidencia = new SisifoInciBajaUsr ( $id );
			break;
		case "LLAVES";
			$Incidencia = new SisifoInciLlave ( $id );
			break;
		case "CAMBIO ROL";
			$Incidencia = new SisifoCambioRol ( $id );
			break;
		case "OTRAS";
			$Incidencia = new SisifoInciOtras ( $id );
			break;			
		case "ALTA MAQUINA";
			$Incidencia = new SisifoInciMaquina ( $id );
			break;			
               case "CABLES";
                        $Incidencia = new SisifoInciPedirCable ( $id );
                        break;
	       case "CLUSTER";
	       		$Incidencia = new SisifoInciCluster ( $id );
			break;
	       case "RF DOCENCIA";
			$Incidencia = new SisifoInciRFDocencia ( $id );
			break;
               case "RF INVESTIGACION";
                        $Incidencia = new SisifoInciRFInvestigacion ( $id );
                        break;
               case "AUDIO";
                        $Incidencia = new SisifoInciAudio ( $id );
                        break;
		default:
			echo "Imposible mostrar la incidencia...";
			exit();			
			break;	
	
	}

?>
<div class="blogbody">

	<table cellpadding=0 cellspacing=0 border=0 align="center">
		<tr>
			<td>
				<table cellpadding=5 cellspacing=10 border=0 align="center">
					<tr>
						<td bgColor="#cccccc" style="border:1px solid #999999;"
							colspan="2" align="center">
								<b>Detalles de la incidencia <?php echo $id; ?></b>
						</td>
						<td>
							<?php echo $Incidencia -> toStr(); ?>
							<tr>
								<td class ="celdagrisclara">
									Estado:
								</td>
								<td>
									<form NAME=frm_camb ACTION="mostrar_inci.php" METHOD="POST">
									<input name="id" value="<?php echo $id;?> " type=hidden>
									<input name="cambiar" value="1" type=hidden>
									<?php
									  echo '<B> ' .
									 $incidencia_padre -> getEstado(). '</B>
									cambiar a:' . lista_estados_inci_sin();
								?>
									<a href="javascript:document.frm_camb.submit();">
									<img src="../Documentos/Imagenes/ver.gif" border=0 title="Cambiar" alt="Cambiar"></img></a>
									</form>
								</td>
							</tr>
						</td>
					</tr>
					<tr>
						<td bgColor="#cccccc" style="border:1px solid #999999;"
							colspan="2" align="center" >
							<div class="small">
<?php echo "[ <a href=\"mensajeadmin.php?pid=" . $incidencia_padre -> getId() . "\"><img alt=\"mensajes\" title=\"mensajes\" src=\"../Documentos/Imagenes/anotacion.gif\" border=0></img>(".  $incidencia_padre -> getNumMens(); ?>) Mensajes</a>

<?php echo " | <a href=\"anotaadmin.php?pid=" . $incidencia_padre -> getId() . "\"><img alt=\"detalles\" title=\"detalles\" src=\"../Documentos/Imagenes/comentario.gif\" border=0></img>(".  $incidencia_padre -> getNumAnot(); ?>) Anotaciones </a>]

							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

</div>
</a>  ]
