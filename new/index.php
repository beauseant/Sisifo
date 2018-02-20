<?PHP
session_start();


require("lib.php");

$sisifoConf  = new Configuracion ("sisifo.xml" );
$sisifoInfo = $sisifoConf  -> getSisifoConf ();


$_SESSION ['base_url'] = $sisifoInfo  -> getBaseurl();
$_SESSION ['fichero'] = $sisifoInfo  -> getBasepath() . "/sisifo.xml";

if(($_REQUEST['act'] == "login") && ($_REQUEST['ulogin'] != "")) {

 	$validacion = new SisifoAutenticadorLdap ( $_REQUEST['ulogin'] , 
		$_REQUEST['password'] );
	//echo $validacion -> valida();
	//exit();
	
	//try{
	if (  $validacion -> valida() ) {
		$validacion -> valida() ;
		session_register("login");
		$_SESSION['login'] = $_REQUEST['ulogin'];
		session_register("myip");
		$_SESSION['myip'] = $_SERVER['REMOTE_ADDR'];
		//echo ( '<a href="mostrar.php">ir </a>');exit();
		header("Location: mostrar.php");
    } 
	else {
	//catch (Exception $e){
		//echo "hasta aquí bien";
		//exit();
		header("Location: index.php?act=bad");
   }

} else {
	require ("headerini.php");
	require ("menu_index.php");

	echo ' 
		<DIV CLASS="leyenda">"El acceso a los ordenadores y a todo lo que te pueda ense&ntilde;ar algo sobre como funciona el mundo debe ser ilimitado. Toda la informaci&oacute;n debe ser libre. Desconf&iacute;a de la autoridad, promueve la descentralizaci&oacute;n; los hackers deber&iacute;an ser juzgados por su habilidad, no por su edad, nivel, raza o posici&oacute;n. Puedes crear arte y belleza con tu ordenador. Los ordenadores pueden cambiar tu vida a mejor."  <I>[ S. Levy ]</I></DIV><BR><BR>';

	
	if($_REQUEST['act'] == "bad") {
		print "<b>Error: Los datos introducidos no son correctos. </b><p>\n";

	}
	print_login();

	include("footer.php");

}
?>
