<?php
session_start();

   
    require_once("../lib.php");
    require_once("../classes/class.SisifoIncidencia.php");
    require_once ("../classes/iterator/class.IncidenciaIterator.php");
    require_once ("../classes/iterator/class.TipoIncidenciaIterator.php");
    require_once ("../classes/iterator/class.EstadoIncidenciaIterator.php");
    require_once ("../classes/autenticar/class.SisifoAutenticador.php");
    require_once("libAdmin.php");




    
    	include("../header.php");

 

	include ("menu_opc.php");
	
	$uid = getUID($_SESSION['login']);	
	
	$sisifoConf  = new Configuracion ( $_SESSION ['fichero'] );
	
	$SisifoInfo = $sisifoConf -> getSisifoConf ();	
	$limit_admin = $SisifoInfo -> getLimitAdmin();
	
	$estado = $_REQUEST['estado'];
	$tipo = $_REQUEST['tipo'];
	$posInicio = $_REQUEST['posInicio'];
	//$ordenfecha = $_REQUEST['ordenfecha'];
	
	if ( ! isset($estado) || ($estado == "") ) {
		$estado = 3;
	}
	
	if ((!isset($posInicio)) || ($posInicio == ""))  {		
		 $posInicio = 0;
	}

	
	
	if ( (!isset($ordenfecha)) || ($ordenfecha == "")) {
		$ordenfecha = $_REQUEST['ordenfecha'];
	}
	
	if ( $ordenfecha == "DESC") {
		$fichero_img = "sortdesc.png";
		$ordenfecha = "DESC";
		
	}else if( $ordenfecha == "ASC") {
		$fichero_img = "sortasc.png";
		$ordenfecha = "ASC";
		
	}
	else {
		$fichero_img = "sortdesc.png";
		$ordenfecha = "DESC";
		
	}
	
	
	

	$sql = sacarCadenaSQL ( $tipo, $estado, $ordenfecha );
	$_SESSION ['incidencias_totales'] = sacarNumInci ( $sql );
	
	if( ($uid != 0 ) ) {
		$iterator = new IncidenciaIterator ( $sql,
			 $limit_admin, $posInicio  );
	}else{
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}		

     	if (!  esAdmin() ) {
          	echo"Debe ser administrador para ver esta pagina";
		exit();
     	}

	$validacion = new SisifoAutenticadorLdap ( "","");

?>
<div class="blogbody">

<table cellpadding=0 cellspacing=0 border=0 align="center">
 
	<tr valign="top">		
		<td style="padding-top:4;padding-right:4px;">
			<form name="opciones" action="index.php" method=POST>
				<input type="hidden" name="id">
				<input type="hidden" name="posInicio">
				<input type="hidden" name="ordenfecha">
				<table>
					<tr>
						<td bgColor="#dddddd" style="border:1px solid #999999;">
							<b>Mostrar incidencias </b>
						</td>
						<td>
							<select name=estado>
								<option value="-1" SELECTED>todas
								<?php
									mostrarEstadosInci ($estado);
								?>
							</select>
						</td>
						<td>
							<select name=tipo>
								<option value="-1">todas
								<?php
									mostrarTiposInci ( $tipo );
								?>
							</select>
						</td>	
						<td>
							<input class=search type=submit value="Mostrar">					
						</td>
							
					</tr>
				</table>
		</form>
<?php	
		include ("pintarTablaInci.php");	
?>
</div>	

<?php		
	
	include ("../footer.php");
				
?>