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
				[ Rellene, por favor, los siguientes campos ]<br><br>
		</div>
			<FORM NAME=frm_pedircable ACTION="pedir_cable_enviada.php" METHOD="POST"> 
				<TABLE CELLPADDING="15px" ALIGN="center">
					<TR class="celdaoscura">
						<TD> Cantidad solicitada: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="cantidad" SIZE = "4" MAXLENGTH = "25">
									
							</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Tipo: </TD>	
						<TD class = "celdaclara">		
						  <? include ("listadoCables.php")?>			
							<b>*</b>							
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
				(*) Campos obligatorios.
				<BR>
		<script type="text/javascript">
        		frm_pedircable.cantidad.focus();
      		</script>
	
		<DIV ALIGN=RIGHT>
			<INPUT NAME="Enviar" VALUE="Enviar incidencia" TYPE=BUTTON onclick="submit_final_pedircable();" >
		</DIV>
				</FORM>			<BR>
		</DIV>
	</DIV>
</DIV>

<?PHP
include ("../footer.php");
?>
