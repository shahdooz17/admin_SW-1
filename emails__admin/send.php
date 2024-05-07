<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    if(isset($_POST["send"]))
    {
        $mail= new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username="shahdalsayed20042017@gmail.com";
        $mail->Password= 'suoe jllb vxzz pwxd';
        $mail->SMTPSecure='ssl';
        $mail->Port=465;
        $mail->setFrom('shahdalsayed20042017@gmail.com');
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);
        $mail->Subject=$_POST["subject"];
        $mail->Body=$_POST["message"];
        $mail->send();
        echo"
        <script>
            alert('Sent successfully');
            document.location.href='index.php';
        </script>
        
        ";
    }
?>