<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarAviso(){
          
      $mail = new PHPMailer();
      //Server settings
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = $_ENV["EMAIL_HOST"];                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = $_ENV["EMAIL_USER"];                     //SMTP username
      $mail->Password   = $_ENV["EMAIL_PASS"];                           //SMTP password
      $mail->SMTPSecure = "ssl";                             //Enable implicit TLS encryption               
      $mail->Port= $_ENV["EMAIL_PORT"];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->setFrom("arturorod90artica@gmail.com", "Regexseo Pinterest");
      $mail->addAddress($this->email, $this->nombre);     //Add a recipient                
                   
      
      //Attachments
      /* $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
   */
      //Content
      $mail->isHTML(true);    
      $mail->CharSet = "UTF-8";                              //Set email format to HTML
    

      
        $mail->Subject = 'Website policy violation notice';
        $contenido = "<html>";
        $contenido .= "<p>the image you have uploaded has violated the policies of the RegexseoPinterest website this will be a first warning to repeat it again your account will be deleted and you will not be able to create one again</p>";
       $contenido .= "</html>";

       $mail->Body = $contenido;
      
     return $mail->send();
    }

    public function enviarEmail($tipo)
    {
       
        $mail = new PHPMailer();
      //Server settings
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = $_ENV["EMAIL_HOST"];                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = $_ENV["EMAIL_USER"];                     //SMTP username
      $mail->Password   = $_ENV["EMAIL_PASS"];                           //SMTP password
      $mail->SMTPSecure = "ssl";                             //Enable implicit TLS encryption               
      $mail->Port= $_ENV["EMAIL_PORT"];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
      //Recipients
      $mail->setFrom("arturorod90artica@gmail.com", "Regexseo Pinterest");
      $mail->addAddress($this->email, $this->nombre);     //Add a recipient                
                   
      
      //Attachments
      /* $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
   */
      //Content
      $mail->isHTML(true);    
      $mail->CharSet = "UTF-8";                              //Set email format to HTML
    

      if ($tipo === "crear") {
        $mail->Subject = 'Confirma tu Cuenta';
        $contenido = "<html>";
        $contenido .= "<p><b>" . $this->nombre . "</b> Has Creado tu cuenta en regexseo, porfavor confirmarla
       en el siguiente enlace</p>";
       $contenido .= "<p>Preciona aqui: <a href = '" . $_ENV["HOST"] . "/confirmar?token=" 
      . $this->token ."'>Confirmar Cuenta</a></p>";

      }elseif ($tipo === "cambiar") {
        $mail->Subject = 'Resstablece tu Password';
        $contenido = "<html>";
        $contenido .= "<p><b>" . $this->nombre . "</b> Has olvidado tu Password sigue las instrucciones
        para cambiar tu password de tu cuenta regexseo, porfavor sigue el siguiente enlace</p>";
        $contenido .= "<p>Preciona aqui: <a href = '" . $_ENV["HOST"] . "/reestablecer?token=" 
      . $this->token ."'>Reestablecer Cuenta</a></p>";
      }
      
      
      $contenido .= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
      $contenido .= "</html>";
      // debuguear($contenido);
      $mail->Body = $contenido;
      
     return $mail->send();
      
    }
}