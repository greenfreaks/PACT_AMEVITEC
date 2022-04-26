<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

class Registro extends Controller{

    private $userID = NULL;

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }

    function render(){
        $this->view->render('registro/index');
    }

    function registroAcademico(){

        $result = array();
        $result ['error'] = false;
        $result ['message'] = "Registro correcto";

        $data = array();

        // datos con * son obligatorios 
        // datos con - son opcionales

            //-------Datos Generales---------
            //Nombres *  {name: "nombre", value: "Gustavo"}
            $data['nombre'] = isset($_POST['nombre']) ? $_POST['nombre']  : NULL;
            //Apeido Paterno * {name: "apeidoP", value: "Castañeda"}
            $data['apeidoP']  = isset($_POST['apeidoP']) ? $_POST['apeidoP'] : NULL;
            //Apeido Materno * {name: "apeidoM", value: "Martinez"}
            $data['apeidoM']  = isset($_POST['apeidoM']) ? $_POST['apeidoM'] : NULL;
            //correo electronico * {name: "email", value: "bwa616@gmail.com"}
            $data['email']  = isset($_POST['email']) ? $_POST['email'] : NULL;
            //telefono de contacto - opcional {name: "telefono", value: "7835107611"}
            $data['telefono']  = isset($_POST['telefono']) ? $_POST['telefono'] : NULL;
            //fecha de nacimiento - opcional {name: "fecha_nacimiento", value: "1991-01-23"}
            $data['fecha_nacimiento']  = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : NULL;
            //Estado * {name: "estado", value: "1"}
            $data['estado']  = isset($_POST['estado']) ? $_POST['estado'] : NULL;
            //Municipio * {name: "municipio", value: "1"}
            $data['municipio']  = isset($_POST['municipio']) ? $_POST['municipio'] : NULL;
            //Password * {name: "pass", value: "Pass1234%"}
            $data['pass']  = isset($_POST['pass']) ? $_POST['pass'] : NULL;              

            //-------Formacion---------
            //Ultimo grado academico* {name: "grado_academico", value: "3"}
            $data['grado_academico']  = isset($_POST['grado_academico']) ? $_POST['grado_academico'] : NULL;
            //titulo obtenido - {name: "titulo", value: "Interaccion Humano Computadora"}
            $data['titulo']  = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;
            //Universidad o centro de investigacion* {name: "escuela", value: "Universidad de Nottingham"}
            $data['escuela']  = isset($_POST['escuela']) ? $_POST['escuela'] : NULL;
            //Campo del conocimiento* {name: "select-campo_de_conocimiento", value: "2"}
            $data['campo_de_conocimiento']  = isset($_POST['campo_de_conocimiento']) ? $_POST['campo_de_conocimiento'] : NULL;
            //Disciplina* {name: "disciplina", value: "9"}
            $data['disciplina']  = isset($_POST['disciplina']) ? $_POST['disciplina'] : NULL;
            //Subdisciplina*  {name: "subdisciplina", value: "61"}
            $data['subdisciplina']  = isset($_POST['subdisciplina']) ? $_POST['subdisciplina'] : NULL;
            //Actualmente estudiando* {name: "actualmente_estudiando", value: "1"}
            $data['actualmente_estudiando']  = isset($_POST['actualmente_estudiando']) ? $_POST['actualmente_estudiando'] : NULL;
            //fecha de egreso - {name: "fecha_egreso", value: ""}
            $data['fecha_egreso']  = isset($_POST['fecha_egreso']) ? $_POST['fecha_egreso'] : NULL;
            //apoyo o beca* {name: "estimulo", value: "2"}
            $data['estimulo']  = isset($_POST['estimulo']) ? $_POST['estimulo'] : NULL;

            //-------Experiencia---------
            //Organizacion actual* {name: "organizacion_actual", value: "4"}
            $data['organizacion_actual']  = isset($_POST['organizacion_actual']) ? $_POST['organizacion_actual'] : NULL;
            //funcion en la organizacion - {name: "funcion", value: "1"}
            $data['funcion']  = isset($_POST['funcion']) ? $_POST['funcion'] : NULL;
            //actividad con mayor experiencia* [max 2] {name: "actividad[]", value: "1"}
            $data['actividad']  = isset($_POST['actividad']) ? $_POST['actividad'] : array();
            //donde adquiriste esta experiencia* [max 2] {name: "donde[]", value: "2"}
            $data['donde']  = isset($_POST['donde']) ? $_POST['donde'] : array();
            //actividades que te gustaria desarollar* [max 2] {name: "desarrollo_talentos[]", value: "1"}
            $data['desarrollo_talentos']  = isset($_POST['desarrollo_talentos']) ? $_POST['desarrollo_talentos'] : array();
            //organizacion en la que te gustaria desarollar* [max 2] {name: "desarrollo_profecional[]", value: "4"}
            $data['desarrollo_profecional']  = isset($_POST['desarrollo_profecional']) ? $_POST['desarrollo_profecional'] : array();


            //-------Habilidades---------
            //habilidades que has desarrollado en tu experiencia previa* [max 3] {name: "habilidades_experiencia[]", value: "1"}
            $data['$habilidades_experiencia']  = isset($_POST['habilidades_experiencia']) ? $_POST['habilidades_experiencia'] : array();
            // habilidades por definir {name: "habilidades[]", value: "1"}
            $data['$habilidades']  = isset($_POST['habilidades']) ? $_POST['habilidades'] : array();
            $data['$competencias']  = isset($_POST['competencias']) ? $_POST['competencias'] : array();

        //verificar si los datos obligatorios se han recibido 
        if (
            is_NULL($data['nombre']) || 
            is_NULL($data['apeidoP']) || 
            is_NULL($data['apeidoM']) || 
            is_NULL($data['email']) || 
            is_NULL($data['municipio']) || 
            is_NULL($data['pass']) ||
            is_NULL($data['grado_academico']) ||
            is_NULL($data['escuela']) ||
            is_NULL($data['subdisciplina']) ||
            is_NULL($data['actualmente_estudiando']) ||
            is_NULL($data['estimulo']) ||
            is_NULL($data['organizacion_actual']) 
            ) 
        {
                $result ['error'] = true;
                $result ['message'] = "Dato obligatorio no proporcionado";
                echo json_encode($result);
                exit();
        } 

        //verificar si el email proporcionado no ha sido usado
        else if($this->model->userExists($data['email'])){
            $result ['error'] = true;
            $result ['message'] = "El email se encuentra en uso";
            echo json_encode($result);
            exit();
        }
        else{

            $userID = $this->model->registroUsuarioGeneral($data,2);
        
            if(is_NULL($userID) || $userID==0){
                $result ['error'] = true;
                $result ['message'] = "Error en registro de usuario.";
                
            }else{
                $IDperfilAcademico = $this->model->registroPerfilAcademico($userID,$data);

                if(!empty($data['actividad'])){
                    foreach ($data['actividad'] as  $actividad) {
                        $this->model->insertActividad($IDperfilAcademico,$actividad);
                    }
                }

                if(!empty($data['donde'])){
                    foreach ($data['donde'] as  $donde) {
                        $this->model->insertOrganizacion($IDperfilAcademico,$donde);
                    }
                }

                if(!empty($data['desarrollo_talentos'])){
                    foreach ($data['desarrollo_talentos'] as  $desarrollo_talentos) {
                        $this->model->insertDesarrollo($IDperfilAcademico,$desarrollo_talentos);
                    }
                }

                if(!empty($data['desarrollo_profecional'])){
                    foreach ($data['desarrollo_profecional'] as  $desarrollo_profecional) {
                        $this->model->insertLugarDesarrollo($IDperfilAcademico,$desarrollo_profecional);
                    }
                }

                if(!empty($data['habilidades_experiencia'])){
                    foreach ($data['habilidades_experiencia'] as  $habilidades_experiencia) {
                        $this->model->insertHabilidadAdquirida($IDperfilAcademico,$habilidades_experiencia);
                    }
                }

                if(!empty($data['habilidades'])){
                    foreach ($data['habilidades'] as  $habilidades) {
                        $this->model->insertHabilidadCompetencia($IDperfilAcademico,$habilidades);
                    }
                } 

                if(!empty($data['competencias'])){
                    foreach ($data['competencias'] as  $competencia) {
                        $this->model->insertTalento($IDperfilAcademico,$competencia);
                    }
                } 
                $result ['message'] = "Usuario registrado.";
                $result ['mensaje'] = "Usuario registrado.";
                $subject = 'Te damos la Bienvenida al PACT';       
                $result ['mailcontent'] = "
                    <html>
                        <head>
                            <title>{$subject}</title>
                        </head>
                        <body>
                            <p>&iexcl;Hola, bienvenido!</p>
                            <p>Gracias por registrarte en la Plataforma de Aceleraci&oacute;n Comercial de Tecnolog&iacute;as (PACT) de Technology Business and Research SAPI de CV. A partir de ahora, podr&aacute;s ingresar en ella con tu correo electr&oacute;nico y contrase&ntilde;a que acabas de registrar cuantas veces gustes; recuerda que estas claves son personales e intransferibles.</p>
                            <p>En esta plataforma podr&aacute;s analizar la ruta de desarrollo de tus tecnolog&iacute;as y resultados de investigaci&oacute;n, mediante el c&aacute;lculo del nivel de madurez con el m&eacute;todo TRL (Technology Readiness Level) de la NASA y, con esa misma calculadora de TRL podr&aacute;s evaluar, en menos de 30 minutos, el desempe&ntilde;o comercial de tus tecnolog&iacute;as en su etapa actual de desarrollo.</p>
                            <p>En la plataforma podr&aacute;s registrar las tecnolog&iacute;as que desees, y para evitar que se sature tu p&aacute;gina de &ldquo;Mis Tecnolog&iacute;as&rdquo;, tu licencia solo te permitir&aacute; realizar un an&aacute;lisis cada 5 d&iacute;as. Cada an&aacute;lisis de TRL generar&aacute; un reporte en PDF con informaci&oacute;n y gr&aacute;ficos de resultados, que podr&aacute;s descargar con esa licencia que te asign&oacute; tu administrador institucional, o bien puedes comprarla directamente en el portal. Este reporte en PDF tiene una firma digital &uacute;nica que valida su autenticidad.</p>
                            <p>Esperamos que la informaci&oacute;n que este software online te proporciona sobre tus proyectos y resultados de investigaci&oacute;n, te ayuden a afinar tu estrategia para llevar tus tecnolog&iacute;as al mercado, ya sea por transferencia, licenciamiento o emprendimiento tecnol&oacute;gico.</p>
                            <p>Por cierto, la plataforma no te pedir&aacute; que redactes nada ni que des informaci&oacute;n confidencial. Adem&aacute;s, tus datos personales est&aacute;n seguros y protegidos; puedes consultar nuestro aviso de privacidad en nuestra p&aacute;gina web techbusiness.com.mx.</p>
                            <p>Espero que tu experiencia en nuestra Plataforma de Aceleraci&oacute;n Comercial de Tecnolog&iacute;as sea satisfactoria y que te ayude a fortalecer tus capacidades como cient&iacute;fico o tecn&oacute;logo en busca de desarrollar soluciones innovadoras que atiendan retos y necesidades de nuestra sociedad.</p>
                            <p>Atte.</p>
                            <p style=-margin-bottom: .0001pt;'>Alejandro Ruiz Mart&iacute;nez</p>
                            <p style='margin-bottom: .0001pt;'>Socio-Director</p>
                            <p style='margin-bottom: .0001pt;'>Technology Business and Research SAPI de CV</p>
                        </body>
                    </html>
                ";

                $mail = new PHPMailer(TRUE);
                try {
                    $sMensaje= $result ['mailcontent'];
                    $mail->setFrom('contacto@techbusiness.com.mx', 'Technology Business & Research');
                    $mail->addAddress($data['email'], $data['nombre'].' '.$data['apeidoP']);
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
                    $mail->Password = '#XEa@;=n~NL?';
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
                }
                catch (Exception $e)
                {
                //echo $e->errorMessage();
                    $result['mensaje'] .= "->ERROR al enviar correo para {$_POST['email']} -> {$e->errorMessage()}";
                }
                catch (\Exception $e)
                {
                    $result['mensaje'] .= "->ERROR al enviar correo para {$_POST['email']} -> {$e->errorMessage()}";
                }
                //===================================
            }
            
        }

        echo json_encode($result);

    }

    function registroEmpresario(){

        $result = array();
        $result ['error'] = false;
        $result ['message'] = "Registro correcto";

        $data = array();

            //nombre: Gustavo Leonardo
            $data['nombre']  = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
            //apeidoP: Castañeda
            $data['apeidoP']  = isset($_POST['apeidoP']) ? $_POST['apeidoP'] : NULL;
            //apeidoM: Martinez
            $data['apeidoM']  = isset($_POST['apeidoM']) ? $_POST['apeidoM'] : NULL;
            //email: bwa616@gmail.com
            $data['email']  = isset($_POST['email']) ? $_POST['email'] : NULL;
            //telefono: 
            $data['telefono']  = isset($_POST['telefono']) ? $_POST['telefono'] : NULL;
            //fecha_nacimiento: 
            $data['fecha_nacimiento']  = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : NULL;
            //estado: 14
            $data['estado']  = isset($_POST['estado']) ? $_POST['estado'] : NULL;
            //municipio: 618
            $data['municipio']  = isset($_POST['municipio']) ? $_POST['municipio'] : NULL;
            //pass: Pass1234%
            $data['pass']  = isset($_POST['pass']) ? $_POST['pass'] : NULL;
            //pass2: Pass1234%
            $data['pass2']  = isset($_POST['pass2']) ? $_POST['pass2'] : NULL;
            //nombre_empresa: TBR
            $data['nombre_empresa']  = isset($_POST['nombre_empresa']) ? $_POST['nombre_empresa'] : NULL;
            //pagina_web: http://techbussiness.com
            $data['pagina_web']  = isset($_POST['pagina_web']) ? $_POST['pagina_web'] : NULL;
            //puesto: 5
            $data['puesto']  = isset($_POST['puesto']) ? $_POST['puesto'] : NULL;
            //tamano: 1
            $data['tamano']  = isset($_POST['tamano']) ? $_POST['tamano'] : NULL;
            //mercado: 1
            $data['presencia_mercado']  = isset($_POST['mercado']) ? $_POST['mercado'] : NULL;
            //rama: 1
            $data['rama_scian']  = isset($_POST['rama']) ? $_POST['rama'] : NULL;

        //verificar si los datos obligatorios se han recibido 
        if (
            is_NULL($data['nombre']) || 
            is_NULL($data['apeidoP']) || 
            is_NULL($data['apeidoM']) || 
            is_NULL($data['email']) || 
            is_NULL($data['municipio']) || 
            is_NULL($data['pass']) ||
            is_NULL($data['rama_scian'])
            ) 
        {
                $result ['error'] = true;
                $result ['message'] = "Dato obligatorio no proporcionado";
                echo json_encode($result);
                exit();
        } 

        //verificar si el email proporcionado no ha sido usado
        else if($this->model->userExists($data['email'])){
            $result ['error'] = true;
            $result ['message'] = "El email se encuentra en uso";
            echo json_encode($result);
            exit();
        }
        else{

            $userID = $this->model->registroUsuarioGeneral($data,1);
            if(is_NULL($userID) || $userID==0){
                $result ['error'] = true;
                $result ['message'] = "Error en registro de usuario.";
                
            }else{
                $IDperfilEmpresario = $this->model->registroPerfilEmpresario($userID,$data);
                $result ['message'] = "Usuario registrado.";
            }
        }

        echo json_encode($result);
    }

}

?>