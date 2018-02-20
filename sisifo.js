<!--//


function abrirAyuda ( baseurl, id_ayuda ) {

	window.open (baseurl+'ayuda.php?id='+id_ayuda,'doc','width=480,height=280,scrollbars=no,status=yes,resizable=no'); 

}


function abrirAdminInci ( baseurl, id_inci, posInicio ) {

	document.opciones.id.value = id_inci;
	document.opciones.posInicio.value = posInicio;
	document.opciones.submit();
	window.open (baseurl+'mostrar_inci.php?id='+id_inci,'doc','width=680,height=580,status=yes,resizable=yes,scrollbars=yes'); 

}


function  OrdenarFecha ( ordenact ) {

	if ( ordenact == 'DESC' ) {
		document.opciones.ordenfecha.value = 'ASC';
	}else {
		document.opciones.ordenfecha.value = 'DESC';
	}
	document.opciones.submit();
}

function calcularInicioAdminInci ( posInicio ) {

	document.opciones.posInicio.value = posInicio;
	document.opciones.submit();

}


function abrirBuscarLog ( baseurl ) {
	window.open (baseurl + '/enviar_incidencias/comprobar_login.php','doc','width=680,height=280,scrollbars=no,status=yes,resizable=no');

}



function submit_final() {


var passed = true;

	if (document.frm_hard.desc_breve.value =="") {
		alert ("Por favor, introduzca una descipcion breve.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	else if (document.frm_hard.desc_larga.value =="") {
		//fixElement(document.frm_soft.desc_larga, "Por favor, introduzca una descipciÀ» detallada.");
		alert ("Por favor, introduzca una descipcion detallada.");
		passed = false;
	}else if ( document.frm_hard.nom_maquina.value == "") {
			alert ("Por favor, introduzca el nombre de la maquina");
			passed = false;	
	}else if ( document.frm_hard.labo_maq.value == "") {
			alert ("Por favor, introduzca el laboratorio de la maquina");
			passed = false;	
	}

	if (passed==true){		
		document.frm_hard.action="hard_enviada.php";
		document.frm_hard.submit();
	}


}



function submit_final_soft() {

var passed = true;

	if (document.frm_soft.desc_breve.value =="") {
		alert ("Por favor, introduzca una descipcion breve.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	else if (document.frm_soft.desc_larga.value =="") {
		//fixElement(document.frm_soft.desc_larga, "Por favor, introduzca una descipciÀ» detallada.");
		alert ("Por favor, introduzca una descipcion detallada.");
		passed = false;
	}else if ( document.frm_soft.nom_maquina.value == "") {
			alert ("Por favor, introduzca el nombre de la maquina");
			passed = false;	
	}else if ( document.frm_soft.labo_maq.value == "") {
			alert ("Por favor, introduzca el laboratorio de la maquina");
			passed = false;	
	}

	if (passed==true){		
		document.frm_soft.action="soft_enviada.php";
		document.frm_soft.submit();
	}
}



function submit_final_alta_usr() {

var passed = true;

	if (document.frmaltausr.nombre.value =="") {
		alert ("Por favor, introduzca el nombre del usuario.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	else if (document.frmaltausr.apellido.value =="") {
		alert ("Por favor, introduzca el apellido del usuario.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	else if (document.frmaltausr.rol.value =="") {
		alert ("Por favor, introduzca el rol del usuario.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	
	
	if (passed==true){		
		document.frmaltausr.action="alta_usr_enviada.php";
		document.frmaltausr.submit();
	}
}


function submit_final_pedircable() {

var passed = true;


        if (document.frm_pedircable.cantidad.value =="") {
                alert ("Por favor, introduzca La cantidad.");
                //fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipci\217; breve.");
                passed = false;
        }

       if (passed==true){
                document.frm_pedircable.action="pedir_cable_enviada.php";
                document.frm_pedircable.submit();
        }

}


function submit_final_baja_usr() {

var passed = true;


	if (document.frmbajausr.nombre.value =="") {
		alert ("Por favor, introduzca el nombre del usuario.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	else if (document.frmbajausr.apellido.value =="") {
		alert ("Por favor, introduzca el apellido del usuario.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	else if (document.frmbajausr.login_usr.value =="") {
		alert ("Por favor, introduzca el login del usuario.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	
	
	if (passed==true){		
		document.frmbajausr.action="baja_usr_enviada.php";
		document.frmbajausr.submit();
	}
}


function submit_final_llave() {

var passed = true;


	if (document.frmllave.laboratorio.value =="") {
		alert ("Por favor, introduzca el nombre del laboratorio.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}		
	
	if (passed==true){		
		document.frmllave.action="llave_enviada.php";
		document.frmllave.submit();
	}
}


function submit_final_cambiarusr () {

var passed = true;


	if (document.frmcambusr.nombre.value =="") {
		alert ("Por favor, introduzca el nombre del usuario.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	else if (document.frmcambusr.apellido.value =="") {
		alert ("Por favor, introduzca el apellido del usuario.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}	
	else if (document.frmcambusr.loginu.value =="") {
		alert ("Por favor, introduzca el login del usuario.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	else if ( document.frmcambusr.rolant.value == document.frmcambusr.rolnuevo.value ) {
		alert ("No ha cambiado el status del usuario.");
		passed = false;
	}
	
	if (passed==true){		
		document.frmcambusr.action="cambiar_usr_enviada.php";
		document.frmcambusr.submit();
	}


}

//Estas dos funciones serÈ¡a innecesarias en un mozilla, pero el explorer hace las cosas de
//otra forma. En mozilla tambiÈ¨n funciona, claro ;)
function mostrar_maq_hard () {
	document.frm_hard.nolista.value = "Quiero volver a ver la lista";
	document.frm_hard.submit();
}


function mostrar_maq_soft () {
	document.frm_soft.nolista.value = "Quiero volver a ver la lista";
	document.frm_soft.submit();
}

function submit_final_audio () {

var passed = true;


        if (document.frmaudio.desc_breve.value =="") {
                alert ("Por favor, introduzca una descripcion breve.");
                //fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipci\217\300\273 breve.");
                passed = false;
        }
        else if (document.frmaudio.desc_larga.text =="") {
                alert ("Por favor, introduzca una descripcion detallada.");
                //fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipci&oacute; breve.");
                passed = false;
        }
        if (passed==true){
                document.frmaudio.action="audio_enviada.php";
                document.frmaudio.submit();
        }


}


function submit_final_otras () {

var passed = true;


	if (document.frmotras.desc_breve.value =="") {
		alert ("Por favor, introduzca una descripcion breve.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	else if (document.frmotras.desc_larga.text =="") {
		alert ("Por favor, introduzca una descripcion detallada.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipci&oacute; breve.");
		passed = false;
	}		
	if (passed==true){		
		document.frmotras.action="otras_enviada.php";
		document.frmotras.submit();
	}


}

function submit_final_rfinves () {
var passed = true;
var contador;
var tipoinvestigacion;


        tipoinvestigacion = "nada";


        for (contador=0;contador < document.frmrf.tipoinvestigacion.length ; contador++){
                if (document.frmrf.tipoinvestigacion[contador].checked) {
                        tipoinvestigacion = document.frmrf.tipoinvestigacion[contador].value;
                        break;
                }
        }

        if ( tipoinvestigacion == "nada") {
                alert ("Por favor, introduzca el tipo de investigacion.");
                passed = false;
        }
        else if ( document.frmrf.descripcion.value == "") {
                alert ("Por favor, introduzca la descripcion.")
                passed = false;
        }
        if (passed==true){
                document.frmrf.action="rf_enviadainvestigacion.php";
                document.frmrf.submit();
        }
}



function submit_final_rfdoc () {

var passed = true;
var contador;
var tipotrabajo;


	tipotrabajo = "nada";

    	for (contador=0;contador < document.frmrf.tipo.length ; contador++){
       		if (document.frmrf.tipo[contador].checked) {
			tipotrabajo = document.frmrf.tipo[contador].value; 
          		break;
		}
    	}

        if (document.frmrf.nombrealumnos.value =="") {
                alert ("Por favor, introduzca el nombre de los alumnos.");
                passed = false;
        }
	else if ( tipotrabajo =="nada") {
		alert ("Por favor, introduzca el tipo trabajo.")
		passed = false;
	}
	else if ( document.frmrf.descripcion.value == "") {
		alert ("Por favor, introduzca la descripcion.")
		passed = false;
	}

        if (passed==true){
                document.frmrf.action="rf_enviadadocencia.php";
                document.frmrf.submit();
        }


}





function submit_final_cluster () {

var passed = true;


	if (document.frmotras.desc_breve.value =="") {
		alert ("Por favor, introduzca una descripcion breve.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipciÀ» breve.");
		passed = false;
	}
	else if (document.frmotras.desc_larga.text =="") {
		alert ("Por favor, introduzca una descripcion detallada.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipci&oacute; breve.");
		passed = false;
	}		
	if (passed==true){		
		document.frmotras.action="cluster_enviada.php";
		document.frmotras.submit();
	}


}



function submit_final_altamaq () {

var passed = true;


	if (document.frmaltamaq.nombre.value =="") {
		alert ("Por favor, introduzca el nombre.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipci&oacute; breve.");
		passed = false;
	}else if (document.frmaltamaq.labo.value =="") {
		alert ("Por favor, introduzca el laboratorio.");
		//fixElement(document.frm_soft.desc_breve, "Por favor, introduzca una descipci&oacute; breve.");
		passed = false;
	}		



	if (passed==true){		
		document.frmaltamaq.action="altamaq_enviada.php";
		document.frmaltamaq.submit();
	}


}
