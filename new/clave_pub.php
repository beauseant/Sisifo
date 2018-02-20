<?PHP
session_start(); 

require("lib.php");
include ("header.php");
include_once ("classes/mandarcorreo/class.Sisifopgp.php");
//include ("Sisifopgp.php");

	include ("menu_opc.php");

	$sisifoConf  = new Configuracion ( $_SESSION ['fichero'] );
	
	$mypgp = $sisifoConf -> getPGP();
	
	$salida_en_html = true;



?>
<DIV CLASS="blogbody">	
		<FIELDSET>
         		<LEGEND><B> [ Clave publica PGP ]</B></LEGEND>
			<BR><BR>
			<DIV class="pgp">
				<?PHP
					echo "
				<a href=\"javascript: abrirAyuda('" . $_SESSION ['base_url'] . "/','209')\">
				<img src=\"Documentos/Imagenes/icon_help.gif\" border=0 
				title=\"Filtro de incidencias\"
				alt=\"Ayuda\" ALIGN=\"righT\"></img></a>";
					echo $mypgp -> getClavePublica ( $salida_en_html );
				?>
				<BR>
				<BR>
			</DIV>
		</FIELDSET>
	</DIV>

<?PHP
	echo "<BR><BR>";
	include ("footer.php");

