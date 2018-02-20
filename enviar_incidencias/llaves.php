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
				[ Copias de llaves ]<br><br>
		</div>			
			<FORM NAME=frmllave ACTION="llave_enviada.php" METHOD="POST"> 
				<TABLE CELLPADDING="15px" ALIGN="center">
					<TR class="celdaoscura">
						<TD> Laboratorio: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="laboratorio" SIZE = "20" MAXLENGTH = "12">
							<b>*</b>	
							</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Tipo: </TD>	
						<TD class = "celdaclara">
							<SELECT name="estado">
								<OPTION value="devolucion" selected>Devolucion
								<OPTION value="peticion">Peticion
							</SELECT>								
						</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Anotaciones adiccionales: </TD>
						<TD class = "celdaclara">		
						<TEXTAREA NAME="desc_larga" rows="8" cols="43" ALIGN=LEFT> </TEXTAREA>
						</TD>
					</TR>					
                                        </TR>
                                        <TR class="celdaoscura"">
                                                 <TD> Poner en copia a otro correo (CC): </TD>
                                                 <TD class = "celdaclara"> <INPUT TYPE="text" NAME="cc" SIZE="25" MAXLENGTH="150" </TD>
                                        </TR>
				</TABLE>
		
				<BR>
		<script type="text/javascript">
        		frmllave.laboratorio.focus();
      		</script>	
				<DIV ALIGN=RIGHT>
					<INPUT NAME="Enviar" VALUE="Enviar incidencia" TYPE=BUTTON onclick="submit_final_llave();" >
				</DIV>
				</FORM></div>			<BR>

		</DIV>
	</DIV>
</DIV>

<?PHP
include ("../footer.php");
?>
