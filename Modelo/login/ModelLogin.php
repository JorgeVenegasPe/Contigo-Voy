<?php 
    class Login {
        private $PDO;
        public function __construct()
        {
        require("../../Conexion/conexion.php");
        $con=new conexion();
        $this->PDO=$con->conexion();
        }
        public function validarDatos($NombrePsicologo, $contrasena) {
            if($_POST){
                session_start();
                $NombrePsicologo = $_POST['usu'];
                $contrasena = $_POST['pass'];
                $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $this->PDO->prepare("SELECT * FROM Psicologo WHERE NombrePsicologo = :u AND Passwords = :p");
                $statement->bindParam(":u", $NombrePsicologo);
                $statement->bindParam(":p", $contrasena);
                $statement->execute();
                $NombrePsicologo = $statement->fetch(PDO::FETCH_ASSOC);
                if($NombrePsicologo){
                    $_SESSION['NombrePsicologo'] = $NombrePsicologo["NombrePsicologo"];
                    $_SESSION['IdPsicologo'] = $NombrePsicologo["IdPsicologo"];
                    $_SESSION['Passwords'] = $NombrePsicologo["Passwords"];
                    $_SESSION['celular'] = $NombrePsicologo["celular"];
                    $_SESSION['email'] = $NombrePsicologo["email"];
                    $_SESSION['Usuario'] = $NombrePsicologo["Usuario"];
                    header("location: ../../Vista/Dashboards.php");
                }else{
                    header("location: ../../Index.php?error=1");
                } 
            }
        }

    }
?>