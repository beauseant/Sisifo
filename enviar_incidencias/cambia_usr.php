<?PHP
session_start();
include ("../lib.php");
include ("../header.php");

include ("menu_gen.php");

?>
</div>
	<div class="blogbody">
		
		<div class="big">
				[ Cambio de status ]<br><br>
		</div>			
			<FORM NAME=frmcambusr ACTION="cambiar_usr_enviada.php" METHOD="POST"> 
				<TABLE CELLPADDING="15px" ALIGN="center">
					<TR class="celdaoscura">
						<TD> Nombre: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="nombre" SIZE = "20" MAXLENGTH = "35">
							<b>*</b>	
							</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Apellido: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="apellido" SIZE = "20" MAXLENGTH = "30">
							<b>*</b>					
						</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Login: </TD>
						<TD class = "celdaclara">		
							<INPUT TYPE ="text" NAME="loginu" SIZE = "20" MAXLENGTH = "35" VALUE =" <?PHP echo $_SESSION['login'];?>">
							<b>*</b>
							<A HREF="  
							 javascript: abrirBuscarLog('<?PHP echo $_SESSION ['base_url']; ?>/');">
							<IMG SRC="../Documentos/Imagenes/comprobar.gif" 
							BORDER="0" 
							title="Comprobar la existencia del usuario"
							alt="Comprobar la existencia del usuario"></IMG>
						</A>				
						</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Status: </TD>
						<TD class = "celdaclara">		
						  <? include ("cambioRol.php")?>
						</TD>						
					</TR>
                                              <TR class="celdaoscura"">
                                                 <TD> Poner en copia a otro correo (CC): </TD>
                                                 <TD class = "celdaclara"> <INPUT TYPE="text" NAME="cc" SIZE="40" MAXLENGTH="150" </TD> 
                                            </TR>

									
				</TABLE>
		<script type="text/javascript">
        		frmcambusr.nombre.focus();
      		</script>		
	
				<DIV ALIGN=RIGHT>
					<INPUT NAME="Enviar" VALUE="Enviar incidencia" TYPE=BUTTON onclick="submit_final_cambiarusr();" >
				</DIV>
				</FORM></div>			<BR>

		</DIV>
	</DIV>
</DIV>

<?PHP
include ("../footer.php");
?>
