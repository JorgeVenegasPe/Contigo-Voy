<?php 
    class Login {
        private $PDO;
        public function __construct()
        {
        require("C:/xampp/htdocs/Contigo-Voy/conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();
        }
        public function validarDatos($NombrePsicologo, $contra) {
            if($_POST){
                session_start();
                $NombrePsicologo = $_POST['usu'];
                $contra= $_POST['pass'];
                $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $this->PDO->prepare("SELECT * FROM psicologo WHERE NombrePsicologo = :u AND Passwords = :p");
                $statement->bindParam(":u", $NombrePsicologo);
                $statement->bindParam(":p", $contra);
                $statement->execute();
                $NombrePsicologo = $statement->fetch(PDO::FETCH_ASSOC);
                if($NombrePsicologo){
                    $_SESSION['NombrePsicologo'] = $NombrePsicologo["NombrePsicologo"];
                    $_SESSION['IdPsicologo'] = $NombrePsicologo["IdPsicologo"];
                    $_SESSION['Usuario'] = $NombrePsicologo["Usuario"];
                    $_SESSION['email'] = $NombrePsicologo["email"];
                    $_SESSION['celular'] = $NombrePsicologo["celular"];
                    $_SESSION['Passwords'] = $NombrePsicologo["Passwords"];
                    header("location: ../../Vista/Dashboards.php");
                }else{
                    header("location: ../../index.php?error=1");
                } 
            }
        }

    }
?>