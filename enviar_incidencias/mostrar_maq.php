<?PHP
session_start();

$nolista = $_REQUEST['nolista'];

if ( ( ! isset ( $nolista) ) || ( $nolista == "Quiero volver a ver la lista") || ( $nolista == " " )) {

		if ( $tipo == "frm_hard" ) {
			echo '
				Seleccione una maquina de la lista:<BR>
				<HR>			
				<DIV ALIGN=RIGHT>
					Nombre de la maquina:
					<SELECT NAME="lst_maquina" onChange="mostrar_maq_hard ();">
			
			';
			
		}else {
			echo '
				Seleccione una maquina de la lista:<BR>
				<HR>			
				<DIV ALIGN=RIGHT>
					Nombre de la maquina:
					<SELECT NAME="lst_maquina" onChange="mostrar_maq_soft ();">
			
			';
		}
		
		$sql = "SELECT * FROM maquina ORDER BY nombre";
		$res = $db->Execute($sql);
		
		$lst_maquina = $_REQUEST['lst_maquina'];
		//echo "******************" . $lst_maquina;
		
		while(!$res->EOF) {
			$nombre = $res -> fields ['nombre'];
			
			if ( !$lst_maquina || ( trim($lst_maquina) == trim ($nombre))  ) 
			{			
				echo ('
					<OPTION SELECTED>'. $nombre .'</OPTION>
					');
				$ip = $res -> fields ['serial'];
				$id_maq = $res -> fields ['id'];
				$labo = $res -> fields ['id_lab'];
				$nombre2 = $nombre;
			}else {
				echo ('
					<OPTION>'. $nombre .'</OPTION>
					');
			}
			$res -> movenext();
		}
		echo ('
				</SELECT>
				<BR><BR>
				Direccion IP: ' . $ip .
				'<INPUT TYPE="HIDDEN" NAME="nom_maquina" 
				VALUE="'. $nombre2 .'"	 >' .
				'<INPUT TYPE="HIDDEN" NAME="id_maq" VALUE="'.$id_maq.'">
				<BR>
				Laboratorio:' .$labo .'
				<INPUT TYPE="HIDDEN" NAME="labo_maq" VALUE="'. $labo .'" ><BR>
			</DIV>
			<BR>
			<BUTTON NAME="nolista" ACCESSKEY=C VALUE="No se encuentra en la lista" onClick="javascript:document.'
				 . $tipo . '.submit();">No se encuentra en la lista</BUTTON>
			<HR>
		');
		
	}else {
	
		echo '
			<HR><BR>
			Como la maquina no se encuentra en la lista complete, por favor, los siguientes datos:<BR><BR>
			<DIV ALIGN=RIGHT>
			<b>*</b>Nombre de la maquina: <INPUT TYPE="text" NAME="nom_maquina" SIZE="20" 
				MAXLENGTH="30" VALUE=""><br><br>
			<b>*</b>Despacho: <INPUT TYPE="text" NAME="labo_maq" SIZE="20" 
				MAXLENGTH="30" VALUE=""><br><br>			
			</DIV>
			<BR>
			<BUTTON NAME="nolista" ACCESSKEY=C VALUE="Quiero volver a ver la lista" onClick="javascript:document.'
				 . $tipo . '.submit();">Quiero volver a ver la lista</BUTTON>
			<HR>
		';
		
		
	}

?>