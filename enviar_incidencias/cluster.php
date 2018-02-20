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
				[ Incidencias cluster]<br><br>
		</div>			
			<FORM NAME=frmotras ACTION="cluster_enviada.php" METHOD="POST"> 
				<TABLE CELLPADDING="15px" ALIGN="center">
					<TR class="celdaoscura">
						<TD> Descripci&oacute;n breve: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="desc_breve" SIZE = "20" MAXLENGTH = "200">
							<b>*</b>	
							</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Descripciones detalladas: </TD>
						<TD class = "celdaclara">		
						<TEXTAREA NAME="desc_larga" rows="8" cols="43" ALIGN=LEFT> </TEXTAREA>
						</TD>
					</TR>					
                                        </TR>
                                              <TR class="celdaoscura"">
                                                 <TD> Poner en copia a otro correo (CC): </TD>
                                                 <TD class = "celdaclara"> <INPUT TYPE="text" NAME="cc" SIZE="40" MAXLENGTH="150" </TD>
                                            </TR>

				</TABLE>
		<script type="text/javascript">
        		frmotras.desc_breve.focus();
      		</script>		
		
	
				<DIV ALIGN=RIGHT>
					<INPUT NAME="Enviar" VALUE="Enviar incidencia" TYPE=BUTTON onclick="submit_final_cluster();" >
				</DIV>
				</FORM></div>			<BR>

		</DIV>
	</DIV>
</DIV>

<?PHP
include ("../footer.php");
?>
