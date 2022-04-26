<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

class Licencias extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId']) and $_SESSION['userType'] == 3) {
            $this->view->render('licencias/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    private function genLicencia($length, $characters){
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

    function sendLicencia(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "Licencia";
        $result ['sessionActive'] = (isset($_SESSION['userId']) and $_SESSION['userType'] == 3);

        if ($result ['sessionActive']) {
            $idLicencia = $this->model->insertLicenceEmail($_POST['email']);
            $serial = $this->genLicencia(10,'lc,uc,n');
            $idTRl = $this->model->insertSerial($idLicencia , $serial);

            if ($idTRl > 0 and !is_null($idTRl)){
                $result ['mensaje'] = "Licencia generada: {$serial}";
                $subject = 'Licencia de descarga TRL';
                $sMensaje= "
                <html>
                    <head>
                        <title>{$subject}</title>
                    </head>
                    <body>
                        <p style='text-align: justify;'>&iexcl;Hola!</p>
                        <p style='text-align: justify;'>Gracias por adquirir tu licencia de usuario de la <a href='http://techbusiness.com.mx/PACT/' target='_blank'>Plataforma de Aceleraci&oacute;n Comercial de Tecnolog&iacute;as</a> de Technology Business and Research (TB&amp;R). Como usuario de la plataforma, podr&aacute;s hacer los an&aacute;lisis de madurez que desees, sin embargo, poseer esta licencia te permitir&aacute; descargar el producto m&aacute;s valioso: el Reporte Electr&oacute;nico de Resultados (RER), el cual es un documento en extenso con los datos, gr&aacute;ficos y recomendaciones puntuales, que te ayudar&aacute;n a definir la mejor estrategia comercial de tu tecnolog&iacute;a.</p>
                        <p style='text-align: justify;'>Te recomendamos que el an&aacute;lisis de la tecnolog&iacute;a que hayas elegido para usar tu licencia, lo realices de la manera m&aacute;s veraz, honesta y precisa posible, ya que de la calidad de tus respuestas depender&aacute; la calidad de tus resultados. Si haces esto, puedes tener la seguridad de que tu licencia te servir&aacute; para descargar un Reporte Electr&oacute;nico de Resultados lleno de informaci&oacute;n sumamente valiosa, para desarrollar tu tecnolog&iacute;a con mayor grado de factibilidad t&eacute;cnica y econ&oacute;mica en su camino hacia el mercado.</p>
                        <p style='text-align: justify;'>Para usar tu licencia, simplemente copia y pega el c&oacute;digo en el campo de captura respectivo, una vez que hayas terminado el an&aacute;lisis de madurez TRL de tu tecnolog&iacute;a, luego da clic en VER REPORTE y se abrir&aacute; una nueva pesta&ntilde;a en tu navegador con el Reporte Electr&oacute;nico de Resultados, para que lo descargues, analices, imprimas y compartas con quien quieras.</p>
                        <p style='text-align: center;'><a href='http://techbusiness.com.mx/PACT/'><span style='font-size: 20pt;'><strong>Licencia generada: {$serial}</strong></span></a></p>
                        <p style='text-align: justify;'>Puedes ingresar a la plataforma en el siguiente link <a href='http://techbusiness.com.mx/PACT/'>http://techbusiness.com.mx/PACT/</a></p>
                        <p style='text-align: justify;'>Tu licencia te da el beneficio de que el Reporte Electr&oacute;nico de Resultados, contiene una firma digital verificada por TB&amp;R, la cual es indicador de la legitimidad del documento y la veracidad de los resultados obtenidos, lo cual le da la validez necesaria para cualquier instituci&oacute;n, organizaci&oacute;n o tomador de decisiones con quien decidas compartir tus resultados.</p>
                        <p style='text-align: justify;'>Esperamos que esta informaci&oacute;n te sea de utilidad. Si tienen alguna duda, puedes contactar a Soporte T&eacute;cnico al correo contacto@techbusiness.com.mx, o bien v&iacute;a whatsapp al 7797966790.</p>
                        <p style='text-align: justify;'>Atte.</p>
                        <p style='text-align: justify;'>Soporte T&eacute;cnico de TB&amp;R</p>
                    </body>
                </html>
            ";
                if($this->sendEMail($_POST['email'],$subject,$sMensaje)){
                    $result ['mensaje'] .= " Email enviado.";
                }else{
                    $result ['error'] = true;
                    $result ['mensaje'] .= " error envio Email.";
                }
            }
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
        }

        echo json_encode($result);
    }

    function sendEMail($email,$subject,$content){
         
        $mail = new PHPMailer(TRUE);
        try {
            $mail->setFrom('contacto@techbusiness.com.mx', 'Technology Business & Research');
            $mail->addAddress($email, 'Usuario');
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $content;
            $mail->isSMTP();
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'ssl';
            $mail->CharSet = "UTF-8";

            $mail->Host = 'mail.techbusiness.com.mx';
            $mail->Username = 'contacto@techbusiness.com.mx';
            $mail->Password = ',4sLPRjU-+]n';
            $mail->Port = 465;
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );
            $mail->send();
        }
        catch (Exception $e)
        {
            //echo $e->errorMessage();
            return false;
        }
        catch (\Exception $e)
        {
            return false;
        }

        return true;
        //===================================
    }

    function multipleLicence(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = (isset($_SESSION['userId']) and $_SESSION['userType'] == 3);

        $emails = array();
        //Insertar emails aqui
        //===============================================


        //===============================================
        array_push($emails, 'leocasdeveloper@gmail.com');

        $result ['sent_emails'] = array();

        if ($result ['sessionActive']) {

            foreach ($emails as $index => $email) {
                $idLicencia = $this->model->insertLicenceEmail($email);
                $serial = $this->genLicencia(10,'lc,uc,n');
                $idTRl = $this->model->insertSerial($idLicencia , $serial);

                if ($idTRl > 0 and !is_null($idTRl)){
                    $result ['mensaje'] = "Licencia generada: {$serial}";
                    $subject = 'Licencia de descarga TRL';
                    $sMensaje= "
                        <html>
                            <head>
                                <title>{$subject}</title>
                            </head>
                            <body>
                                <p style='text-align: justify;'>&iexcl;Hola!</p>
                                <p style='text-align: justify;'>Gracias por adquirir tu licencia de usuario de la <a href='http://techbusiness.com.mx/PACT/' target='_blank'>Plataforma de Aceleraci&oacute;n Comercial de Tecnolog&iacute;as</a> de Technology Business and Research (TB&amp;R). Como usuario de la plataforma, podr&aacute;s hacer los an&aacute;lisis de madurez que desees, sin embargo, poseer esta licencia te permitir&aacute; descargar el producto m&aacute;s valioso: el Reporte Electr&oacute;nico de Resultados (RER), el cual es un documento en extenso con los datos, gr&aacute;ficos y recomendaciones puntuales, que te ayudar&aacute;n a definir la mejor estrategia comercial de tu tecnolog&iacute;a.</p>
                                <p style='text-align: justify;'>Te recomendamos que el an&aacute;lisis de la tecnolog&iacute;a que hayas elegido para usar tu licencia, lo realices de la manera m&aacute;s veraz, honesta y precisa posible, ya que de la calidad de tus respuestas depender&aacute; la calidad de tus resultados. Si haces esto, puedes tener la seguridad de que tu licencia te servir&aacute; para descargar un Reporte Electr&oacute;nico de Resultados lleno de informaci&oacute;n sumamente valiosa, para desarrollar tu tecnolog&iacute;a con mayor grado de factibilidad t&eacute;cnica y econ&oacute;mica en su camino hacia el mercado.</p>
                                <p style='text-align: justify;'>Para usar tu licencia, simplemente copia y pega el c&oacute;digo en el campo de captura respectivo, una vez que hayas terminado el an&aacute;lisis de madurez TRL de tu tecnolog&iacute;a, luego da clic en VER REPORTE y se abrir&aacute; una nueva pesta&ntilde;a en tu navegador con el Reporte Electr&oacute;nico de Resultados, para que lo descargues, analices, imprimas y compartas con quien quieras.</p>
                                <p style='text-align: center;'><a href='http://techbusiness.com.mx/PACT/'><span style='font-size: 20pt;'><strong>Licencia generada: {$serial}</strong></span></a></p>
                                <p style='text-align: justify;'>Puedes ingresar a la plataforma en el siguiente link <a href='http://techbusiness.com.mx/PACT/'>http://techbusiness.com.mx/PACT/</a></p>
                                <p style='text-align: justify;'>Tu licencia te da el beneficio de que el Reporte Electr&oacute;nico de Resultados, contiene una firma digital verificada por TB&amp;R, la cual es indicador de la legitimidad del documento y la veracidad de los resultados obtenidos, lo cual le da la validez necesaria para cualquier instituci&oacute;n, organizaci&oacute;n o tomador de decisiones con quien decidas compartir tus resultados.</p>
                                <p style='text-align: justify;'>Esperamos que esta informaci&oacute;n te sea de utilidad. Si tienen alguna duda, puedes contactar a Soporte T&eacute;cnico al correo contacto@techbusiness.com.mx, o bien v&iacute;a whatsapp al 7797966790.</p>
                                <p style='text-align: justify;'>Atte.</p>
                                <p style='text-align: justify;'>Soporte T&eacute;cnico de TB&amp;R</p>
                            </body>
                        </html>
                    ";
                    if($this->sendEMail($email,$subject,$sMensaje)){
                        array_push($result ['sent_emails'], 
                            ['email' => $email, 
                            'licencia' => $serial, 
                            'resultado' => 'correcto']
                        );
                    }else{
                        array_push($result ['sent_emails'], 
                            ['email' => $email, 
                            'licencia' => $serial, 
                            'resultado' => 'error mail']
                        );
                        $result ['error'] = true;
                        $result ['mensaje'] .= "error al enviar email {$email}.";
                    }
                }else{
                    array_push($result ['sent_emails'], 
                        ['email' => $email, 
                        'licencia' => $serial, 
                        'resultado' => 'error licencia']
                    );
                    $result ['error'] = true;
                    $result ['mensaje'] .= "error al generar licencia.";
                }
                //sleep(1);
            }
            
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
            //header('Location: '.constant('URL'));
        }

        echo json_encode($result);
    }

    function searchUser(){

        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "Usuario Encontrado";
        $result ['sessionActive'] = (isset($_SESSION['userId']) and $_SESSION['userType'] == 3);

        if ($result ['sessionActive']) {

            $result ['resultados'] = $this->model->selectEmpresario($_POST['email']);

            if (empty($result ['resultados'])) {
                $result ['error'] = true;
                $result ['mensaje'] = "Sin resultados";
            }

        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
            header('Location: '.constant('URL'));
        }

        echo json_encode($result);
    }

    function createMultipleLicence(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = (isset($_SESSION['userId']) and $_SESSION['userType'] == 3);

        if ($result ['sessionActive']) {

            $idLicencia = $this->model->insertEmpresario($_POST['email'] , $_POST['id']);
            for ($i=0; $i < $_POST['licencias']; $i++) { 
                $serial = $this->genLicencia(10,'lc,uc,n');
                $this->model->insertLicenciaEmpresario($serial,$idLicencia);
            } 

        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
            header('Location: '.constant('URL'));
        }

        echo json_encode($result);
    }

    function templateFunction(){

        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        if ($result ['sessionActive']) {
            
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
            header('Location: '.constant('URL'));
        }

        echo json_encode($result);
    }

}

?>