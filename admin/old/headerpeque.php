<?php 
    session_start();
		$wtitle = "Sisifo:: Sistema de gestion de incidencias";
		$baseurl = $_SESSION['base_url'];
		$wtitle = "Sisifo:: Sistema de gestion de incidencias";
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $wtitle?>: <?php echo $wtitle?></title>

<script language="javascript" type="text/javascript" src="<?php echo $baseurl?>/sisifo.js"></script>

<link rel="alternate" type="text/xml" title="RSS" href="<?php echo $baseurl?>/rss2.php" />
<link rel="pingback" href="<?php echo $baseurl?>/api.php" />
<link rel="stylesheet" href="<?php echo $baseurl?>/sisifo.css" type="text/css" />
</head> 
