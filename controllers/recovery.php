<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
class Recovery extends Controller{

    private $userID;
    private $genCode;

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }

    function render(){
        $this->view->render('recovery/index');
    }

    private function genPass($length, $characters){
        $symbols = array(); 
        $passwords = array(); 
        $used_symbols ="";
        $pass = "";

        $symbols["lc"] = "abcdefghijklmnopqrstuvwxyz";
        $symbols["uc"] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $symbols["n"] = "1234567890";
        $symbols["ss"] = "!?~#%<>";

        $characters = explode(",", $characters);

        foreach ($characters as $key => $value) {
           $used_symbols .= $symbols[$value];
        }

        $symbols_length = strlen($used_symbols)-1;

           for ($j=0; $j < $length; $j++) { 
               $n = rand (0, $symbols_length);
               $pass .= $used_symbols[$n];
           }
       return $pass;
   }

    public function sendCode(){
        $result = array();
        $result ['error'] = false;
        $result ['message'] = "Codigo Enviado";

        $user = $_POST['email'];

        if($this->model->userExists($user)){
            $this->userID = $this->model->getUserID($user);
            if(is_null($this->userID)){
                $result ['error'] = true;
                $result ['message'] = "Usuario no encontrado";
            } else{
                $this->code = $this->genPass(6,'n');
                $codeSent = $this->model->sendCode($this->code,$this->userID);

                if (is_null($codeSent) || $codeSent == 0) {
                    $result ['error'] = true;
                    $result ['message'] = "Error al generar código de verificación";
                } else {
                    //==============Inicio de envio de correo
                    $subject = "Código para cambio de contraseña";
                    $mail = new PHPMailer(TRUE);
                    try {
                    $sMensaje= "
                    <html>
                        <head>
                            <title>Codigo de recuperación de contraseña</title>
                        </head>
                        <body>
                            <h1>Cambio de contraseña</h1>
                            <p>Recientemente se ha solicitado un cambio de contraseña.</p>
                            <br>
                            <p><strong>Código de verificación: </strong> {$this->code}</p>
                            <br>
                            <p>Ingrese este código en la página donde solicito el cambio de contraseña.</p>         
                        </body>
                    </html>
                    ";

                    $mail->setFrom('contacto@techbusiness.com.mx', 'Technology Business & Research');
                    $mail->addAddress($user, 'Usuario');
                    $mail->Subject = $subject;
                    $mail->isHTML(true);
                    
                    $mail->Body = $sMensaje;
                    
                    /* SMTP parameters. */
                    
                    /* Tells PHPMailer to use SMTP. */
                    $mail->isSMTP();
                    
                    /* SMTP server address. */
                    $mail->Host = 'mail.techbusiness.com.mx';
                    /* Use SMTP authentication. */
                    $mail->SMTPAuth = TRUE;
                    
                    /* Set the encryption system. */
                    $mail->SMTPSecure = 'ssl';
                    
                    //$mail->CharSet = "UTF-8";
                    
                    /* SMTP authentication username. */
                    $mail->Username = 'contacto@techbusiness.com.mx';
                    
                    /* SMTP authentication password. */
                    $mail->Password = '2=R3z1B1U!^i';
                    
                    /* Set the SMTP port. */
                    $mail->Port = 465;
                    /* Disable some SSL checks. */
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                        )
                    );
                    /* Finally send the mail. */
                    $mail->send();
                    $result ['error'] = false;
                    $result ['message'] = "Codigo Enviado";
                    $result ['correo'] = $sMensaje;

                    }
                    catch (Exception $e)
                    {
                    //echo $e->errorMessage();
                        $result ['error'] = false;
                        $result ['message'] = "Correo electronico no enviado  /{$this->code}";
                    }
                    catch (\Exception $e)
                    {
                        $result ['error'] = false;
                        $result ['message'] = "Correo electronico no enviado  /{$this->code}";
                    }
                    //==============Fin envio de correo
                }
            }
        }
        else{
            $result ['error'] = true;
            $result ['message'] = "Usuario no encontrado";
        }

        echo json_encode($result);

   }

   public function verifyCode(){
    $result = array();
    $result ['error'] = false;

    $user = $_POST['email'];
    $code = $_POST['code'];

    $result ['valid_code'] = $this->model->vefifyCode($user,$code);
    $result ['error'] = !$result ['valid_code'];
    $result ['message'] = ($result ['valid_code']) ? "Codigo válido" : "Codigo no válido" ;

    echo json_encode($result);
   }

   public function changePass(){
    $user = $_POST['email'];
    $code = $_POST['code'];
    $newpass = $_POST['newpass'];

    $result = array();
    $result ['error'] = false;

    if ($this->model->vefifyCode($user,$code)) {
        $result ['error'] = !$this->model->changePass( $this->model->getUserID($user),$newpass);
        $result ['message'] = (!$result ['error']) ? "Contraseña actualizada" : "Error cambio contraseña" ;
        //$this->model->cleanCodes($this->model->getUserID($user));
    } else {
        $result ['error'] = true;
        $result ['message'] = "Codigo no válido" ;
    }
    echo json_encode($result);
   }

}

?>