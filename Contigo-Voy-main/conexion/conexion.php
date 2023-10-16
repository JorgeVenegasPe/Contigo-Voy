<?php
class conexion{
    private $host="localhost";
    private $dbname="psicologia";
    private $user="root";
    private $password="";

    public function conexion(){
        try{
            $PDO=new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $PDO;

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}
?>