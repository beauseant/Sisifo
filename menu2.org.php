	
	<div class="principal">
		<div class="calendar">
			<br><b>:: Incidencias inform&aacute;ticas ::</b> <br>
				<a href="enviar_incidencias/hardware.php">
					- hardware
				</a>
				<a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','200');">				
				<img src="Documentos/Imagenes/icon_help.png" border=0 
				title="Incidencia hardware"
				alt="Ayuda"></img></a>
				<br>	
				
				<a href="enviar_incidencias/software.php">- software
				</a>
				<a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','201');">				
				<img src="Documentos/Imagenes/icon_help.png" border=0 
				title="Incidencia software"
				alt="Ayuda"></img></a>	
				<br>
				
			<br><b>:: Gesti&oacute;n de usuarios ::</b> <br>	
				<a href="enviar_incidencias/alta_usr.php">- solicitar alta
				</a>
				
				<a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','202');">				
				<img src="Documentos/Imagenes/icon_help.png" border=0 
				title="Solicitar alta usuario"
				alt="Ayuda"></img></a>
				<br>
				
				<a href="enviar_incidencias/baja_usr.php">- solicitar baja</a>
				<a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','203');">
				<img src="Documentos/Imagenes/icon_help.png" border=0 
				title="Solicitar baja usuario"
				alt="Ayuda"></img></a>
				<br>
				
				<a href="enviar_incidencias/cambia_usr.php">- cambiar status</a>
				<a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','204');">				
				<img src="Documentos/Imagenes/icon_help.png" border=0 
				title="cambiar status usuario"
				alt="Ayuda"></img></a>
				<br>
				
			<br><b>:: Incidencias de cluster ::</b>
				<br>
				<a href="enviar_incidencias/cluster.php"> - incidencia general</a>
				<a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','205');">				
				<img src="Documentos/Imagenes/icon_help.png" border=0 
				title="cluster"
				alt="Ayuda"></img></a>
				<br>
				
				
			<br><b>:: Otras incidencias ::</b>			
				<br>
				<a href="enviar_incidencias/llaves.php"> - copia de llaves</a>
				<a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','205');">				
				<img src="Documentos/Imagenes/icon_help.png" border=0 
				title="llaves"
				alt="Ayuda"></img></a>		

				<br>
                                <a href="enviar_incidencias/pedir_cable.php"> - solicitud de cables</a>
                                <a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','205');">

                                <img src="Documentos/Imagenes/icon_help.png" border=0
                                title="cables"
                                alt="Ayuda"></img></a>


				<br>
				<a href="enviar_incidencias/nueva_maq.php">- alta de una nueva m&aacute;quina </a>
				<a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','206');">				
				<img src="Documentos/Imagenes/icon_help.png" border=0 
				title="Alta de una nueva maquina"
				alt="Ayuda"></img></a><br>
				<a href="enviar_incidencias/otras.php"> - otras incidencias </a>
				<a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','210');">				
				<img src="Documentos/Imagenes/icon_help.png" border=0 
				title="otras incidencias"
				alt="Ayuda"></img></a><br>
				<br>
			<b>:: Incidencias anteriores ::</b>
				<a href="javascript: abrirAyuda('<?PHP echo $_SESSION ['base_url']; ?>/','207');">				
				<img src="Documentos/Imagenes/icon_help.png" border=0 
				title="Uso del archivo"
				alt="Ayuda"></img></a>			
			
			<br>
<?PHP
			$uid = getUID($_SESSION['login']);
			mk_drawCalendar ($m, $y, $uid, 1);
?>
	     </div>
	     
