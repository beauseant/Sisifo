<?PHP
session_start();

include ("../lib.php");
include ("../header.php");

include ("menu_gen.php");
	
        extract($_REQUEST);

	
?>

	</div>
	<div class="blogbody">

		<div class="big">
				[ Dar de baja un usuario en el sistema ]<br><br>
		</div>		
			<FORM NAME=frmbajausr ACTION="baja_usr_enviada.php" METHOD="POST"> 
				<TABLE CELLPADDING="15px" ALIGN="center">
                                        <TR class="celdaoscura">
                                                <TD> Poner en copia a otro correo (CC): </TD>
                                                <TD class = "celdaclara">
                                                        <INPUT TYPE ="text" NAME="cc" SIZE = "40" MAXLENGTH = "150">
                                                        </TD>
                                        </TR>
					<TR class="celdaoscura">
						<TD> Nombre: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="nombre" SIZE = "20" MAXLENGTH = "25">
							<b>*</b>	
							</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Apellido: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="apellido" SIZE = "20" MAXLENGTH = "25">
							<b>*</b>
							</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Login: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="login_usr" SIZE = "20" MAXLENGTH = "25">
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
						<TD> Rol: </TD>	
						<TD class = "celdaclara">		
						  <? include ("listadoRolUsr.php")?>			
							<b>*</b>							
							</TD>					
						</TD>
					</TR>
					
					<TR class="celdaoscura">
						<TD> Correo contacto: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="correo" SIZE = "40" MAXLENGTH = "150">
									
							</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Anotaciones adiccionales: </TD>
						<TD class = "celdaclara">					
						<TEXTAREA NAME="desc_larga" rows="8" cols="43" ALIGN=LEFT> </TEXTAREA>
						</TD>
					</TR>					
				</TABLE>
		
		<script type="text/javascript">
        		frmbajausr.nombre.focus();
      		</script>	
		<DIV ALIGN=RIGHT>
			<INPUT NAME="Enviar" VALUE="Enviar incidencia" TYPE=BUTTON onclick="submit_final_baja_usr();" >
		</DIV>
				</FORM>			<BR>

			</DIV>
		</DIV>
	</DIV>
</DIV>

<?PHP
include ("../footer.php");
?>
