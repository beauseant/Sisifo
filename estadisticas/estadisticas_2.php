<?PHP
session_start(); 

require("../lib.php");
//require ( "phplot/PHPlot.php" );
include ("../header.php");
include ("../enviar_incidencias/menu_gen.php");


	$uid = getUID($_SESSION['login']);	
	
	if( ($uid == 0 ) ) {		
		echo 'El usuario no ha sido registrado en el sistema. Por favor <A
		 href="../logout.php">registrese</A>  en el sistema';
		exit();
	}	

include ("../classes/class.SisifoEstadisticas.php");

$usuario = $_REQUEST['usuario_opc'];
$year = $_REQUEST['year_opc'];

if ($usuario == 1) {
	$uidd = $uid;
}else {
	$uidd = -1;
}




$stats = new SisifoEstadisticas ();

echo "<h1>Incidencia by year </h1>";

$numyears =  ($stats -> listaYears () );
sort ($numyears);
foreach ( $numyears as $y) {
	$incidencias = $stats -> getNumIncis ( $y );
	echo "$y,$incidencias <br>";
}


$arr = array(12,33,23,4,20,124,4,2); 
print stats_absolute_deviation (  $arr );

if ( !isset($year)) {

	$year = 2014;
}




$stats -> estadisEstadoCompleta ( $year, $uidd  );
$_SESSION['datos_stats'] = $stats -> getData();

$stats -> estadisTipoCompleta ( $year, $uidd  );
$_SESSION['datos_stats2'] = $stats -> getData();

$stats -> estadisTipoResumen ( $year, $uidd  );
$_SESSION['datos_stats3'] = $stats -> getData();

//$stats -> estadisEstadoResumen ( $year, $uidd  );
$stats -> estadisEstadoResumen ( $year, $uidd  );
$_SESSION['datos_stats4'] = $stats -> getData();

$_SESSION['colores'] = array( 
	array(155,122,220) ,
	array(155,220,122),
	array(220,155,122), 
	array(222,220,195), 
	array(222,155,220),
	array(155,220,222),
	array(225,225,0),
	array(222,222,255),
	array(155,155,0),
        array(0,155,0),
        array(0,55,0),
        array(135,100,2),

  );

  

?>
<DIV CLASS="blogbody">	

		<FIELDSET>
                        <LEGEND><B> [ Incidencias cerradas por cada administrador ]</B></LEGEND>

			<?PHP echo $stats -> estadisResoluc ();?>
		</FIELDSET>

	<DIV CLASS="estadisticas_opc">	
			<FORM NAME=frm_est1 ACTION="estadisticas.php" METHOD="POST"> 
				Mostrar s&oacute;lo las incidencias que me pertenezcan:
				<INPUT TYPE=CHECKBOX NAME="usuario_opc" VALUE="1"
				<?PHP if ( $usuario ) { echo "CHECKED";} ?>">
				<BR><BR>Filtrar incidencias del a&ntilde;o:
				<SELECT NAME="year_opc">
					<OPTION>2006</OPTION>
					<OPTION>2005</OPTION>
					<OPTION>2007</OPTION>
                                        <OPTION>2008</OPTION>
					<OPTION>2009</OPTION>
					<OPTION>2010</OPTION>
					<OPTION>2011</OPTION>
                                        <OPTION>2012</OPTION>
                                        <OPTION>2013</OPTION>
					<OPTION SELECTED>2014</OPTION>
				</SELECT><BR><BR>
				<DIV ALIGN="RIGHT">
					<INPUT NAME="Enviar" VALUE="Mostrar"
					TYPE=SUBMIT
				</DIV>
			</FORM>
		</DIV>

		
		<FIELDSET>
         		<LEGEND><B> [ Estadisticas totales ]</B></LEGEND>
			<BR><BR>
			<DIV class="estadisticas">
				<IMG SRC="estadisTipoResumen.php"></IMG>
				<BR>
				<BR>
				<IMG SRC="estadisEstadoResumen.php"></IMG>
				<BR>
				<BR>
			</DIV>
		</FIELDSET>


		<FIELDSET>
         		<LEGEND><B> [ Estadisticas mensuales ]</B></LEGEND>
			<BR><BR>
			<DIV class="estadisticas">

				<IMG SRC="CompletaEstado.php"></IMG>
				<BR>
				<BR>
				<IMG SRC="CompletaTipo.php"></IMG>
			</DIV>
		</FIELDSET>
		</DIV>
	</DIV>

<?PHP

	echo "<BR><BR>";
	include ("../footer.php");

?>
