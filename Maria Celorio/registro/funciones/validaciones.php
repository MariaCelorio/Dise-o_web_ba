<?php 
	
	
	
	function validaAlfanumerico($valor)
	{
		if(!preg_match("/^\w+$/", $valor) ) {
	   		return false; } 
	 	else{
	   		return true;
		   }
		   
	} 

	function validaRequerido($valor){
        if(trim($valor) == ''){ 
		
            return false;
        }else{
            return true;
        }
    }

	function validaNombres($valor)
	{
	   if(!preg_match("/^[a-zA-Z  áéíóúñÑÁÉÍÓÚ]+$/i", $valor) )
	   {
	   		return false;
	   } else {
	   		return true;
	   }
	}	

    function validarEntero($valor, $opciones=null){
        if(filter_var($valor, FILTER_VALIDATE_INT, $opciones) === FALSE){
            return false;
        }else{
            return true;
        }
    }

	function verificar_email($email) 
	{
	  if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\.-])*@([a-zA-Z0-9-])+([a-zA-Z0-9\._-]+)+$/",$email))
	  {
		return true;
	  }
	  return false;
	}

	

?>