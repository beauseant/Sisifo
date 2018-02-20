<?php 
    	session_start();
	
	require("../lib.php");
	require_once("../classes/class.SisifoIncidencia.php");
	require_once("../classes/class.SisifoInciAltaUsr.php");
	require_once ("../classes/autenticar/class.SisifoAutenticador.php");

	$baseurl = $_SESSION['base_url'];
	if ( $login_s ) {
		$login_s = trim ( $login_s );
		$validacion = new SisifoAutenticadorLdap ( "" , "" );
		if ( $validacion -> buscar ( $login_s ) ) {
			$texto = 'El login sugerido para el nuevo usuario, ' . $login_s . 
			', ya se encuentra registrado. ';
		}else {
			$texto = 'El login sugerido , ' . $login_s . ',no se encuentra
			  registrado en el sistema.';
		}		
	}else {
		$texto = 'Introduzca el login a buscar en la caja de texto:';
	}
		
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>:::: Busqueda de usuarios ::::</title>

<script language="javascript" type="text/javascript" src="<?=$baseurl?>/sisifo.js"></script>

<link rel="alternate" type="text/xml" title="RSS" href="<?=$baseurl?>/rss2.php" />
<link rel="pingback" href="<?=$baseurl?>/api.php" />
<link rel="stylesheet" href="<?=$baseurl?>/sisifo.css" type="text/css" />
</head> 
<body>
	<div class="ayuda">
		
		<div class="big">
				[ Comprobacion: ]<br><br>
		</div>
		
		
		
	<?PHP echo $texto;?><br><br>
	<FORM NAME=frmaltausr ACTION="comprobar_login.php" METHOD="POST"> 
		<TABLE CELLPADDING="15px" ALIGN="center" BORDER="0">
			<TR class="celdaoscura">
				<TD> Nombre: </TD>	
				<TD class = "celdaclara">
					<INPUT TYPE ="text" NAME="login_s" SIZE = "20" MAXLENGTH = "25">
				</TD>
				<TD class = "celdaclara">
					<INPUT NAME="Enviar" VALUE="Comprobar" TYPE=submit>
				</TD>
			</TR>		
		</TABLE>
	   </DIV>
	</DIV>
</DIV>

