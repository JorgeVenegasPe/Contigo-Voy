<?php
require_once("../../Controlador/Cita/citaControlador.php");
$obj = new usernameControlerCita();
$FechaCitaInicio = $_POST['FechaInicioCita'];
$HoraInicio = $_POST['HoraInicio'];
$FechaInicio = $FechaCitaInicio . ' ' . $HoraInicio;

$obj->modificarCita($_POST['IdCita'],$FechaInicio, $_POST['EstadoCita'], $_POST['MotivoCita'], $_POST['DuracionCita'], $_POST['tipoCita'], $_POST['CanalCita'], $_POST['EtiquetaCita'], $_POST['ColorFondo']);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer/Exception.php';
require '../../phpmailer/PHPMailer.php';
require '../../phpmailer/SMTP.php';

//Load Composer's autoloader

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'gestion.contigo-voy.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'gestioncontigovoy@gestion.contigo-voy.com';                     //SMTP username
    $mail->Password   = '}qlC%A.frc3?';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('gestioncontigovoy@gestion.contigo-voy.com', 'Contigo Voy');
    $mail->addAddress($_POST['correo']);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = '!!Felicidades!!';
    $mail->Body = '<body style="text-align: center; font-size: 20px;max-width: 300px; margin: 0 auto;">
                    Querido ' . $_POST['Paciente'] . ',
                    <br>Se Modifico su cita con nosotros. 
                    <br>Los detalles de su reserva son los siguientes:
                    <br>
                    <br>Fecha: ' . $_POST['FechaInicioCita'] . '
                    <br>Hora: ' . $_POST['HoraInicio'] . '
                    <br>
                    <br>"Saludos Cordiales, Contigo Voy"
                    <hr>
                    <br><b>Cuenta pacientes y reservas de citas en línea</b>
                    <br>Utilice nuestra plataforma para reservar y administrar sus citas médicas:
                    <br>
                    <br><a href="https://gestion.contigo-voy.com" style="background-color: #9274b3; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; cursor: pointer;">Acceso a la Pagina</a>
                    ';
    $mail->send();
    header('Location: ../../Vista/citas.php?enviado=true');
    exit;
} catch (Exception $e) {
    header('Location: ../../Vista/citas.php?error=' . urlencode($mail->ErrorInfo));
    exit;
}



?>
