<?PHP
session_start();


include ("../lib.php");
include ("../header.php");
include ("menu_gen.php");      

        import_request_variables("gp");

	
?>
</div>
	<div class="blogbody">
		
		<div class="big">
				[ Petici&oacute;n de trabajo docente (RF) ]<br><br>
		</div>			
			<FORM NAME=frmrf ACTION="rf_enviadadocencia.php" METHOD="POST" enctype="multipart/form-data"> 
				<TABLE CELLPADDING="15px" ALIGN="center">
                                       <TR class="celdaoscura"">
                                                 <TD> Poner en copia a otro correo (CC): </TD>
                                                 <TD class = "celdaclara"> <INPUT TYPE="text" NAME="cc" SIZE="25" MAXLENGTH="150" </TD>
                                        </TR>
					<TR class="celdaoscura">
						<TD> Tipo de trabajo <b>(*)</b> </TD>	
						<TD class = "celdaclara">
							<input type="radio" name="tipo" value="ASIGNATURA" /> Asignatura <br> 
                                                        <input type="radio" name="tipo" value="PFC" /> PFC<br> 
                                                        <input type="radio" name="tipo" value="TESIS DOCTORAL" /> Tesis doctoral<br>  
                                                        <input type="radio" name="tipo" value="TRABAJO DIRIGIDO" /> Trabajo dirigido<br>  
                                                        <input type="radio" name="tipo" value="OTROS" /> Otros<br> 
						</TD>
					</TR>
                                        <TR class="celdaoscura">
						<TD> Nombre de los alumnos  <b>(*)</b>  </TD>
	                                        <TD class = "celdaclara">
	                                                <TEXTAREA NAME="nombrealumnos" rows="2" cols="80" ALIGN=LEFT></TEXTAREA>
						</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Descripci&oacute;n del trabajo <b>(*)</b></TD> 
                                                <TD class = "celdaclara">      
                                                        <TEXTAREA NAME="descripcion" rows="5" cols="80" ALIGN=LEFT></TEXTAREA>
                                                </TD>
					</TR>
                                        <TR class="celdaoscura">
                                                <TD> Adjuntar fichero (hasta 8 megas): </TD>
                                                <TD class = "celdaclara">
								<input type="hidden" name="MAX_FILE_SIZE" value=9000000" />
								 descripci&oacute;n: <input type="text" name="name" size="25" length="25" value="">
								fichero: <input name="userfile" type="file" size="25"/>
							
                                                </TD>
                                        </TR>          
				</TABLE>
		<script type="text/javascript">
                        frmrf.descripcion.focus();
                </script>
	
				<DIV ALIGN=RIGHT>
					<INPUT NAME="Enviar" VALUE="Enviar incidencia" TYPE=BUTTON onclick="submit_final_rfdoc();" >
				</DIV>
				</FORM></div>			<BR>

		</DIV>
	</DIV>
</DIV>

<?PHP
include ("../footer.php");
?>
