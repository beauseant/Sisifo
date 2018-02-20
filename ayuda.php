<?php
session_start();
	
		include ("classes/class.Ayuda.php");
		
		$baseurl = $_SESSION['base_url'];
		
		//$nayuda =  new Ayuda ( $id );
		$nayuda =  new Ayuda ( $_REQUEST['id'] );
		$texto_ayuda = $nayuda -> getTexto ();	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>:::: Bienvenido a la ayuda del sistema ::::</title>

<script language="javascript" type="text/javascript" src="<?php echo $baseurl?>/sisifo.js"></script>

<link rel="alternate" type="text/xml" title="RSS" href="<?php echo $baseurl?>/rss2.php" />
<link rel="pingback" href="<?php echo $baseurl?>/api.php" />
<link rel="stylesheet" href="<?php echo $baseurl?>/sisifo.css" type="text/css" />
</head> 
<body>
	<div class="ayuda">
		
		<div class="big">
				[ Bienvenido al sistema de ayuda: ]<br><br>
		</div>		
			<TABLE  BORDER="0">
				 <TR> <TD> <?PHP echo $texto_ayuda; ?> </TD></TR>
			</TABLE>
		</DIV>
	</DIV>
</DIV>
