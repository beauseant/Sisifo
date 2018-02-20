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
				[ Dar de alta una nueva m&aacute;quina ]<br><br>
		</div>			
			<FORM NAME=frmaltamaq ACTION="altamaq_enviada.php" METHOD="POST"> 
				<TABLE CELLPADDING="15px" ALIGN="center">
					<TR class="celdaoscura">
						<TD> Nombre de la m&aacute;quina: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="nombre" SIZE = "20" MAXLENGTH = "200">
							<b>*</b>	
							</TD>
					</TR>
					<TR class="celdaoscura">
						<TD> Laboratorio: </TD>	
						<TD class = "celdaclara">
							<INPUT TYPE ="text" NAME="labo" SIZE = "10" MAXLENGTH = "200">
							<b>*</b>	
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
        		frmaltamaq.nombre.focus();
      		</script>		
	
				<DIV ALIGN=RIGHT>
					<INPUT NAME="Enviar" VALUE="Enviar incidencia" TYPE=BUTTON onclick="submit_final_altamaq();" >
				</DIV>
				</FORM></div>			<BR>

		</DIV>
	</DIV>
</DIV>

<?PHP
include ("../footer.php");
?>
