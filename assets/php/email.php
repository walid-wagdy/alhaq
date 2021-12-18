<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// $log_file = "error.log";
// ini_set('error_log', $log_file);

// error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';



// echo json_encode($_POST) ;
// die;



$mail = new PHPMailer(true);
$name_field = ($_POST["name"]);
$phone_field = ($_POST["phone"]);

    $subject_field = ($_POST["subject"]);
    $message_field = ($_POST["message"]);

    $subject = "Callback! From the site was sent an message!";
    $message = file_get_contents('../templates/message.html');

    // Fill form
    // $message = str_replace('{{ subject }}', $subject_field, $message);
    $message = str_replace('{{ name }}', $name_field, $message);
    $message = str_replace('{{ phone }}', $phone_field, $message);
    $message = str_replace('{{ subject }}', $subject_field, $message);
    $message = str_replace('{{ message }}', $message_field, $message);

try {
	// $mail->SMTPDebug = 2;									
	$mail->isSMTP();
    $mail->CharSet = 'UTF-8';  
	$mail->Host	 = 'mail.saudielc.com;';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'info@saudielc.com';				
	$mail->Password = 'a@marketing4u';						
	$mail->SMTPSecure = 'ssl';							
	$mail->Port	 = 465;
	
	$mail->setFrom('info@saudielc.com', 'Saudielc');		
	$mail->addAddress('walid.wagdy@hotmail.com');
	
	$mail->isHTML(true);								
	$mail->Subject = $subject;
	$mail->Body = $message ;
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
    echo '<div class="status-icon valid"><i class="icon_check"></i></div>';
} catch (Exception $e) {
    echo '<div class="status-icon invalid"><i class="icon_close"></i></div>';
}



  

?>