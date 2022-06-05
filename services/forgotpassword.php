<?php
require_once('../header.php');
require_once('../db_config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if (isset($_POST['submit'])) {
    $email = $_POST['coda-emailid'];
    $sql = "SELECT COUNT(*) AS count from users where email = :email";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result[0]["count"] > 0) {
        $fetchqry = "SELECT id from users WHERE email=:email";
        $fetchid = $pdo->prepare($fetchqry);

        $params = ['email' => $email];
        $fetchid->execute($params);
        if ($fetchid->rowCount() > 0) {
            $row = $fetchid->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
        }

        echo $id = base64_encode($row['id']);
        echo  $code = md5(uniqid(rand()));
        $sql1 = "UPDATE users SET mdCode='$code' WHERE email='$email'";
        $statement = $pdo->prepare($sql1);
        $statement->execute();
        print_r($statement);
        echo  $message = "Hello , $email
       <br /><br />
       Click Following Link To Reset Your Password 
       <br /><br />
       <a href='".$baseurl."resetpassword.php?id=$id&mdcode=$code'>
            click here to reset your password
        </a>
       <br /><br />
       thank you :)
       ";
        $subject = "password reset";
        //mail($email,$subject, $message, );
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'user@example.com';                     //SMTP username
        $mail->Password   = 'secret';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        $msg = " We have sent an email to $email.Please click on the password reset link in the email to generate new password.";
        header('Location:../pages/forgot-password.php?msg="' . $msg . '"');
    } else {

        $msg = "<strong>Sorry!</strong>  this email not found. ";
        header('Location:../pages/forgot-password.php?error="' . $msg . '"');
    }
    $msg = "Unexpected error occured! please refresh the page.";
    header('Location:../pages/forgot-password.php?error="' . $msg . '"');
}
