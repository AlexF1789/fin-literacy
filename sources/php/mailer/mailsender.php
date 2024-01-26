<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 require "<path to mailer folder>/mailer/vendor/autoload.php"; // complete with your server path to the mailer folder
 
 
function send_mail($email, $oggetto, $messaggio, $path_allegato){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = ""; // smtp server address
        $mail->SMTPDebug = 0;
        $mail->Port = 0; // smtp server port
 	    $mail->SMTPAuth = true;
        $mail->SMTPAutoTLS = true;
	    $mail->SMTPSecure = ''; // ssl or tls according to your provider
        $mail->Username = ""; // the email address
        $mail->Password = ""; // your email password
        $mail->Priority    = 0; // the priority of the email sent (1 = High, 3 = Normal, 5 = low)
        $mail->setFrom('', ''); // identity of the sender (email address, name)
        $mail->AddAddress($email);
        $mail->IsHTML(true); 
        $mail->Subject  =  $oggetto;
        $mail->Body     =  $messaggio;
        $mail->AltBody  =  "";
        $mail->AddAttachment($path_allegato);  
        if(!$mail->Send()){
                echo "An error occured sending the email: ".$mail->ErrorInfo;
                return false;
        }else{
                return true;
        }
        //echo !extension_loaded('openssl')?"Not Available":"Available";
}
?>
