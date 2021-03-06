<?php 

    require_once ("mandarcorreo/class.Sisifocorreo.php");
    

	/**
	* Esta clase se usa para procesar la informacion relativa a las maquinas.
	* En principio solo se tendran en cuenta los ordenadores personales. En 
	* principio dicha informacion se encuentra grabada en la base de datos, pero 
	* para lograr hacerlo mas flexible se ha habilitado la posibilidad de hacerlo 
	* contra el LDAP, por si se quiere integrar con un futuro inventario mas compelto.
	* Para lograr esa flexibilidad se ha recurrdio al patron Strategy.
	* @package SisifoMaquina
	*/ 
class SisifoMaquina {
    
    
   /**#@+
   * access private
   * @var object 
   */
	/**
	* El identificador de la incidencia.
	*/
	var $id;
	
	/**
	* El nombre del ordenador.
	*/
	var $nombre;
	
	/**
	* La ip de dicho ordenador, en la base de datos esto se guarda 
	* como numero de serie.
	*/
	var $ip;
	
	/**
	* El laboratorio en el que se encuentra dicha maquina.
	*/
	var $laboratorio;
	
	/**
	* La clase concreta que realiza las operaciones, bien contra LDAP o bien
	* contra una base de datos.
	*/
	var $maq_op;
       /**#@-*/
    

       	/**
	* Constructor.
	* Se busca la maquina solicitada en la base de datos, o bien se 
	* indica que se quiere insertar una nueva.
	* @param id el identificador de la maquina a buscar.
	* @param crear si se trata de un alta o de una insercion.
	*/           
    function SisifoMaquina ( $id, $crear = false ) {    
	
	$this -> maq_op = new OperacionesMaquinaBD ( $id, $crear );
	
	if ( !$crear ) {
		$this -> id		= $this -> maq_op -> getId ();
		$this -> nombre		= $this -> maq_op -> getNombre ();
		$this -> ip 		= $this -> maq_op -> getIp ();
		$this -> laboratorio 	= $this -> maq_op -> getLaboratorio(); 
	}

    }
    
    
    /**
    * Metodo para insertar una nueva maquina, esta funcion en realidad se delega en el 
    * la clase operaciones maquina. 
    * Se inserta solo si el nombre de la maquina no existe ya en la base de datos, si
    * ya existiese se devuelve el identificador de la maquina existente, sino se devuelve
    * el de la nueva maquina insertada.
    * @param nombre el nombre de la maquina.
    * @param ip la ip de la maquina
    * @param laboratorio el laboratorio donde se encuentra.
    */
    function insertar ( $nombre, $ip, $laboratorio ) {
    
    	//Comprobamos si la maquina ya existia:
	$id = $this -> maq_op -> buscar ( $nombre );
	
	if ( ! $id  ) {
    		$id = $this -> maq_op -> insertar ( strtolower ( (trim ($nombre) )), 
			$ip, $laboratorio );
	}
	return $id;
    }
    
    
    /**
    * Metodo que devuelve el id de la maquina actual.
    */
    function getId () {
    	return $this -> id;
    }
    
    /**
    * .Metodo que devuelve la ip de la maquina actual.
    */
    function getIp () {
    	return $this -> ip;
    }

   function getNombre () {
	return $this -> nombre;
   }
  function getLaboratorio ( ) {
        return $this -> laboratorio;
  }

}    
  


	/**
	* Clase que encapsula todas las operaciones que se pueden realizar 
	* sobre una maquina. Dichas operaciones se pueden realizar sobre una base de
	* datos, o bien sobre LDAP. Para darle esa flexibilidad se usa el patron 
	* Strategy.
	* @package SisifoMaquina
	*/ 
class OperacionesMaquina {

  
   /**#@+
   * access private
   * @var object 
   */
	/**
	* El identificador de la incidencia.
	*/  
  var $id;
  
  /**
  *El nombre de la maquina.
  */
  var $nombre;
  
  /**
  * La ip de la maquina.
  */
  var $ip;
  
  /**
  * El laboratorio en el que se encuentra.
  */
  var $laboratorio;
  
  var $sisifoConf;

	
       	/**
	* Constructor. - Solo es el esqueleto-
	* Se busca la maquina solicitada en la base de datos, o bien se 
	* indica que se quiere insertar una nueva.
	* @param id el identificador de la maquina a buscar.
	* @param crear si se trata de un alta o de una insercion.
	*/           
	function OperacionesMaquina ( $id, $crear = false ) {
		return "funcion no implementada";
	}
	
	
    /**
    * Metodo para insertar una nueva maquina. Solo es el esqueleto.
    * @param nombre el nombre de la maquina.
    * @param ip la ip de la maquina
    * @param laboratorio el laboratorio donde se encuentra.
    */	
	function insertar ( $nombre, $ip, $laboratorio ) {
		return "funcion no implementada";	
	}
	
	
	/**
	* Metodo para buscar los datos de una maquina solo por el nombre.
	* Solo es el esqueleto.
	*/
	function buscar ( $nombre ) {	
		return "funcion no implementada";
	}
	
	/**
	* Metodo para devolver el identificador de una maquina.
	*/
	function getId ( ) {
		return $this -> id;
	}

	/**
	* Metodo para devolver el nombre de la maquina.
	*/
	function getNombre ( ) {
		return $this -> nombre;
	}

	/**
	* Metodo para devolver la IP de la maquina.
	*/	
	function getIp ( ) {
		return gethost ($this -> nombre);
	}

	/**
	* Metodo para devolver el laboratorio de la maquina.
	*/	
	function getLaboratorio ( ) {
		return $this -> laboratorio;
	}
			
	
}


	/**
	* Clase que realiza todas las operaciones que se necesitan sobre una maquina. 
	* Todas esas operaciones se realiza sobre una base de datos.
	* @package SisifoMaquina
	*/ 
class OperacionesMaquinaBD extends OperacionesMaquina {


    /**
    * Metodo para insertar una nueva maquina.
    * @param nombre el nombre de la maquina.
    * @param ip la ip de la maquina
    * @param laboratorio el laboratorio donde se encuentra.
    */	
	function OperacionesMaquinaBD ( $id, $crear = false ) {
	   
	   $this -> sisifoConf  = new Configuracion ( $_SESSION ['fichero'] );
	   $db = $this -> sisifoConf -> getBd();
		
	   if ( ! $crear ) {
		$sql = "SELECT * FROM maquina WHERE id ='" . $id ."'";
		$resultSet = $db->Execute ( $sql );
    		$this -> id 	     = $resultSet -> fields ['id'];	
		$this -> nombre      = $resultSet -> fields ['nombre'];
		$this -> ip 	     = $resultSet -> fields ['serial'];
		$this -> laboratorio = $resultSet -> fields ['id_lab'];
	   }	
	}
	
	
    /**
    * Metodo para insertar una nueva maquina.
    * @param nombre el nombre de la maquina.
    * @param ip la ip de la maquina
    * @param laboratorio el laboratorio donde se encuentra.
    */		
	function insertar ( $nombre, $ip, $laboratorio ) {
		
		$db = $this -> sisifoConf -> getBd();
		$db -> StartTrans();			
			$sql =  "INSERT INTO maquina (nombre, serial, id_lab ) VALUES ('";
			$sql .= $nombre . "','" . $ip . "','". $laboratorio . "')";
			$res = $db-> Execute ($sql);
			
			$sql = "SELECT last_value FROM maquina_id_seq";
			$res = $db->Execute ($sql);
			$last_id = $res -> fields ['last_value'];
		$db -> CompleteTrans();
		

		$inci_mail = $this -> sisifoConf -> getIncimail();
		$texto = "El usuario " . $_SESSION['mail'] . ", ha dado de alta la maquina " .
			$nombre . " (" . $ip ." / " . $laboratorio . ")";
		$subject = "Nueva maquina: " . $nombre;
		$mymail = new Sisifocorreo ($_SESSION['mail'] , $inci_mail, $subject, $texto ); 
		$mymail -> enviar();	
		
		
		return $last_id;
	}
	
	/**
	* Metodo para buscar los datos de una maquina solo por el nombre.
	*/	
	function buscar ( $nombre ) {
	   	$db = $this -> sisifoConf -> getBd();
		$sql = "SELECT id FROM maquina WHERE nombre = '" . $nombre . "'";
		$res = $db-> Execute ($sql);
		
		return $res -> fields ['id'];
		
	}
	
 

}

	/**
	* Clase que realiza todas las operaciones que se necesitan sobre una maquina. 
	* Todas esas operaciones se realiza sobre LDAP.
	* @package SisifoMaquina
	*/ 
class OperacionesMaquinaLDAP extends OperacionesMaquina {
}

  
?>
