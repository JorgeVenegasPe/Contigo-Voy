<?php
require_once("C:/xampp/htdocs/Contigo-Voy/Controlador/Cita/ControllerCita.php");
$obj = new usernameControlerCita();
$FechaInicioCita = $_POST['FechaInicioCita'];
$HoraInicio = $_POST['HoraInicio'];
$FechaInicio = $FechaInicioCita . ' ' . $HoraInicio;
$fechaInicioObj = new DateTime($FechaInicio);
$obj->guardar($_POST['IdPaciente'],$_POST['MotivoCita'],$_POST['EstadoCita'],$FechaInicio,$_POST['DuracionCita'],$_POST['FechaFin'],$_POST['TipoCita'], $_POST['ColorFondo'], $_POST['IdPsicologo'], $_POST['CanalCita'], $_POST['EtiquetaCita']);


require_once('../../vendor/autoload.php');
use Twilio\Rest\Client;

    $sid    = "ACd9bb959c9e58da76d5b2ec3991ce60f4";
    $token  = "fa895f8a13586d9387b8530a1cb57997";
    $twilio = new Client($sid, $token);

$numeroPaciente = $_POST['telefono'];
error_log("NUM: ".$numeroPaciente);

$mensaje = "Hola " . $_POST['Paciente'] . ",\n";
$mensaje .= "Gracias por reservar una cita con nosotros.\n";
$mensaje .= "Los detalles de su reserva son los siguientes: \n";
$mensaje .= "Fecha: " . $_POST['FechaInicioCita'] . "\n";
$mensaje .= "Hora: " . $_POST['HoraInicio'] . "\n";
$mensaje .= "Cuenta pacientes y reservas de citas en línea\n";
$mensaje .= "Utilice nuestra plataforma para reservar y administrar sus citas médicas: \n";
$mensaje .= "telefono: " . $_POST['telefono'] . "\n";
$mensaje .= "correo: " . $_POST['correo'] . "\n";   
$mensaje .= "Acceso a la Pagina: https://gestion.contigo-voy.com";
$bodym = $mensaje;

$message = $twilio->messages
->create("whatsapp:+51$numeroPaciente", // to
array(
"from" => "whatsapp:+14155238886",
"body" => $mensaje // Mensaje personalizado con los detalles de la cita
)
);
print($message->sid);

//otra opcion  de envio de mensajes

/*$params=array(
    'token' => 'd1sxwjpyw79qfpkr',
    'to' => "+51$numeroPaciente",
    'body' => "$bodym",
    );
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.ultramsg.com/instance67334/messages/chat",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => http_build_query($params),
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }

 */
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
                    <br>Se modifico su cita con nosotros. 
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
    header('Location: ../../Vista/RegCitas.php?enviado=true');
    exit;
} catch (Exception $e) {
    header('Location: ../../Vista/RegCitas.php?error=' . urlencode($mail->ErrorInfo));
    exit;
}


?>
