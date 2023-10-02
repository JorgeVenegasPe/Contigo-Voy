<?php
class conexion{
    private $host="localhost";
    private $dbname="ghxumdmy_psicologiaMaster";
    private $user="ghxumdmy_psicologia";
    private $password="ghxumdmy_psicologia";

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