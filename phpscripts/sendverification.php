<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require ('../vendor/autoload.php');
if(isset($_POST['email'])){
   
   $email=$_POST['email'];
   $db=mysqli_connect("localhost","root","","agrly");
   
   $hash = md5( rand(0,1000) );
   $sql="insert into Verification values('$email','$hash');";
   
   $result = mysqli_query($db,$sql);
   
   $mail = new PHPMailer();
   try {
       $mail->setFrom('egytourism2019@gmail.com', 'Agrly Support');
      $mail->addAddress($email);
      $mail->Subject = 'Successfully registration';
      
      /* SMTP parameters. */
      $mail->isSMTP();
   
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = TRUE;
      $mail->SMTPSecure = 'ssl';
      $mail->Username = 'egytourism2019@gmail.com';
      $mail->Password = 'Egytou2019';
      $mail->Port = '465';
      $mail->SetFrom('noreply@hegz.com');
      $mail->Body = ' 
      Thanks for signing up!
       
      Please click this link to activate your account:
      http://localhost:8080/agrly/verification.php?email='.$email.'&hash='.$hash.'
       
      '; // Our message above including the link
      $mail->AddAddress('ahmedhegazee1998@gmail.com');
      $mail->send();
    }
    catch (Exception $e)
    {
       /* PHPMailer exception. */
       echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
       /* PHP exception (note the backslash to select the global namespace Exception class). */
       echo $e->getMessage();
    }
}
?>
 