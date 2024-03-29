<?php
include_once ("../model/connect_data.php");
include_once("reservaClass.php");

class reservaModel extends reservaClass{
	
	private $link;
	private $list= array();
	
	public function OpenConnect()
{
    $konDat=new connect_data();
    try
    {
         $this->link=new mysqli($konDat->host,$konDat->userbbdd,$konDat->passbbdd,$konDat->ddbbname);
         // mysqli klaseko link objetua sortzen da dagokion konexio datuekin
         // se crea un nuevo objeto llamado link de la clase mysqli con los datos de conexión. 
    }
    catch(Exception $e)
    {
    echo $e->getMessage();
    }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta 
        //                  //databasearen artean UTF -8 erabiltzera datuak trukatzeko
}                   
 
 public function CloseConnect()
 {
     mysqli_close ($this->link);
 }
 
 
	private function getList(){
		return $this->list;
	}
	
	//Cargar los datos
	public function setList(){
		
		$this->OpenConnect(); // Abrir la conexion
		
		$sql= "call spAllReservas()";
		
		$result = $this->link->query($sql); //Almacena los datos recibidos de la llamada a la base de datos
		
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			
			$reserva= new reservaClass();
			
			$reserva->setIdReserva($row{'id'});
			$reserva->setIdOrdenador($row['idOrdenador']);
			$reserva->setIdUsuario($row['idUsuario']);
			$reserva->setFechaReserva($row['fechaReserva']);
			$reserva->setFechaUso($row['fechaUso']);

			
			 array_push($this->list, $reserva);
		}
		        mysqli_free_result($result);
        	$this->CloseConnect();  //Cerrar la conexion
	}
	
	/*
	//Insert Usuarios
	public function insert(){
        
        $this->OpenConnect();  // konexio zabaldu  - abrir conexión
        
        $nombreInsert=$this->getTituloPelicula();
		$contraseniaInsert=$this->getContrasenia();
		$nickNameInsert=$this->getNickName();
		$residenciaInsert=$this->getResidencia();
		$emailInsert=$this->getEmail();
		$numTelInsert=$this->getNumTel();

        $sql="CALL spInsertUser('$nombreInsert','$contraseniaInsert','$nickNameInsert','$residenciaInsert','$emailInsert',$numTelInsert)";
        
        $numFilas=$this->link->query($sql);
        
        if ($numFilas>=1){
            return "insertado";
        } else {
            return "Error al insertar";
        }
        
        $this->CloseConnect();
    }
	
	//Delete Usuarios
   	public function delete(){
        
        $this->OpenConnect();  // konexio zabaldu  - abrir conexión

        $id=$this->getIdUsuario();
        
        $sql="CALL spDeleteUser($id)";
        
        $numFilas=$this->link->query($sql); 
        
        if ($numFilas>=1)
        {
            echo "borrado";
        } else {
            echo "Error al borrar";
        }
        $this->CloseConnect();
        
    }
    
	//Update Usuarios
	public function Update(){
        
        $this->OpenConnect();  // konexio zabaldu  - abrir conexión
        
        
        $nombreUpdate=$this->getNombre();
		$contraseniaUpdate=$this->getContrasenia();
		$nickNameUpdate=$this->getNickName();
		$residenciaUpdate=$this->getResidencia();
		$emailUpdate=$this->getEmail();
		$numTelUpdate=$this->getNumTel();

        $sql="CALL spUpdateUser('$nombreUpdate','$contraseniaUpdate','$nickNameUpdate','$residenciaUpdate','$emailUpdate',$numTelUpdate)";
        
        $numFilas=$this->link->query($sql);
        
        if ($numFilas>=1){
            return "insertado";
        } else {
            return "Error al insertar";
        }
        
        $this->CloseConnect();
    }*/
    function getListJsonString() {//if Class attributes PROTECTED
        
        // returns the list of objects in a srting with JSON format
        // Atributtes don't must be PUBLICs, they can be PRIVATE or PROTECTED
        $arr=array();
        
        foreach ($this->list as $object)
        {
            $vars = get_object_vars($object);
            
            array_push($arr, $vars);
        }
        return json_encode($arr);
    }
}

?>