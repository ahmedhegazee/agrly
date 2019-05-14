<?php
//db user operations only
/*
*Dependancy:
*PHPMailer library is for sending mails. Source :Github
* You have to download it before running send_verification function
* You can download it using compressor . It is a tool for installin php dependencies
*Important Note :
*if you use gmail as a sender email you have to enable some settings in security 
*to allow gmail from sending mails.
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use \Gumlet\ImageResize;
require ('../vendor/autoload.php');
/*
*Constants:
*Database: Database Name
*utable: The table name which contains your users information.
*email : is the sender email.
*emailpassword: is the password of sender email.
*smtpport: it is the port which used to send emails .You can search for it base on your sender email
*smtpserver: the server will sends emails
*emailtitle: the title of mails which is sent to another emails
*domain : is the domain will be generated from ngrok script to allow android app from accessing 
*local host
*/
/*
 *To use apis you have to change in SQL statements the table fields. 
 */
define("Database","agrly");
define("utable","Users");
define("email","egytourism2019@gmail.com");
define("emailpassword","Egytou2019");
define("smtpport","465");
define("smtpserver","smtp.gmail.com");
define("emailtitle","Successfully registration");
define("domain","localhost:8080");
$GLOBALS["db"] = mysqli_connect("localhost","root","",Database);
/*
 *Function Name :
 *register()
 *Functionality : 
 *The function takes registration data from user and insert it in database.
 *returns true if it executed succesfully and false for otherwise
 *params:
 *$firstname : stands for user first name
 *$lastname : stands for the user last name
 *$username : stands for user name which will be used in sign in
 *$password : stands for user password wich will be used in sign in
 *$email : stands for user email wich will be used for sending verification code
 *$tel : stands for user mobile phone
 *You can change this parameters for your purposes and don't to forget to change sql statment
 */
function register($firstname,$lastname,$username,$password,$email,$tel){
$sql="INSERT INTO ".utable." (firstname, lastname, username, useremail, userpassword,usertel) VALUES ('$firstname','$lastname','$username','$email','$password',$tel);";
if($result = mysqli_query($GLOBALS["db"],$sql))
return TRUE;
else
return FALSE;
}
/*
 *Function Name :
 *check_email()
 *Functionality : 
 *The function takes user email and checks if the email is regestered before or not.
 *returns true if the email is not found and false for otherwise
 *params:
 *$email : stands for user email 
 *You can change this parameters for your purposes and don't to forget to change sql statment
 */
function check_email($email){
    $sql="select useremail from ".utable." where useremail = '$email';";
 $result = mysqli_query($GLOBALS["db"],$sql);
 
 $row=mysqli_fetch_array($result);
 if($row!=null)
 return FALSE;
 else
 return TRUE;
}
function check_username($un){
    $sql="select * from ".utable." where username = '$un';";
 $result = mysqli_query($GLOBALS["db"],$sql);
 
 $row=mysqli_fetch_array($result);
 if($row!=null)
 return FALSE;
 else
 return TRUE;
}
/*
 *Function Name :
 *check_tel()
 *Functionality : 
 *The function takes user mobile phone and checks if the mobile phone is regestered before or not.
 *returns true if it executed succesfully and false for otherwise
 *params:
 *$tel : stands for user mobile phone
 *You can change this parameters for your purposes and don't to forget to change sql statment
 */
function check_tel($tel){
    $sql="select useremail from ".utable." where usertel = '$tel';";
    $result = mysqli_query($GLOBALS["db"],$sql);
    
    $row=mysqli_fetch_array($result);
    if($row!=null)
    return FALSE;
    else
    return TRUE;
}
/*
 *Function Name :
 *send_verification()
 *Functionality : 
 *The function takes user email to send him a verification email with code.
 *The function generates the verification code
 *Dependancy:
 *PHPMailer library from Githup installed by comprosser
 *returns true if the email is sent succesfully and false for otherwise
 *params:
 *$email : stands for user email wich will be used for sending verification code
 *You can change this parameters for your purposes and don't to forget to change sql statment
 */
function send_verification($email){
   $hash = md5( rand(0,1000) );
   $sql="insert into Verification values('$email','$hash');";
   if($result = mysqli_query($GLOBALS["db"],$sql))
   {
    $mail = new PHPMailer();
    try {
        $mail->setFrom(email, 'Agrly Support');
       $mail->addAddress($email);
       $mail->Subject = emailtitle;
       
       /* SMTP parameters. */
       $mail->isSMTP();
       $mail->Host = smtpserver;
       $mail->SMTPAuth = TRUE;
       $mail->SMTPSecure = 'ssl';
       $mail->Username = email;
       $mail->Password = emailpassword;
       $mail->Port = smtpport;
       $mail->SetFrom('noreply@hegz.com');
       $mail->Body = ' 
       Thanks for signing up!
        
       Please click this link to activate your account:
       http://'.domain.'/agrly/verification.php?email='.$email.'&hash='.$hash.'
        '; // Our message above including the link
       return $mail->send();
       
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
   else
   return false;
  
}
/*
 *Function Name :
 *check_verification()
 *Functionality : 
 *The function takes user name and user password to check if he is verified or not.
 *returns true if the user is verified and false for otherwise
 *params:
 *$username : stands for user name
 *$password : stands for user password
 *You can change this parameters for your purposes and don't to forget to change sql statment
 */
function check_verification($username,$password){
    
    $sql="SELECT userid,verified FROM ".utable." WHERE username='$username'and userpassword='$password';";
    $result = mysqli_query($GLOBALS["db"],$sql);
    $myrow = mysqli_fetch_array($result);
    $verified =$myrow["verified"];
    if($verified==1){
        return TRUE;
    }
    else 
    return FALSE;
}
/*
 *Function Name :
 *sign()
 *Functionality : 
 *The function takes user name and user password to sign in and return user id.
 *params:
 *$username : stands for user name
 *$password : stands for user password
 *You can change this parameters for your purposes and don't to forget to change sql statment
 */
function sign($username,$password){
    $sql="SELECT userid FROM ".utable." WHERE username='$username'and userpassword='$password';";
    $result = mysqli_query($GLOBALS["db"],$sql);
    $myrow = mysqli_fetch_array($result);
  
        $uid=$myrow["userid"];
        if(isset($uid))
        return $uid;
    
    else
    return 0;
    
    
}
/*
 *Function Name :
 *check_found_token()
 *Functionality : 
 *The function takes user id to check if the token is found or not .
 *It it is found , it returns token code else returns No Token.
 *params:
 *$uid : stands for user id
 *You can change this parameters for your purposes and don't to forget to change sql statment
 */
function check_found_token($uid){
    $sql="SELECT token FROM AccessToken WHERE userid=$uid;";
    $result = mysqli_query($GLOBALS["db"],$sql);
    $myrow = mysqli_fetch_array($result);
        $token=$myrow["token"];
        if(isset($token))
        return $token;
    
    else 
    return "No Token";
}
/*
 *Function Name :
 *generate_token()
 *Functionality : 
 *The function takes user id and generates access token .
 *Then it inserts this token in database.
 *params:
 *$uid : stands for user id
 *You can change this parameters for your purposes and don't to forget to change sql statment
 */
function generate_token($uid){
    $token = bin2hex(random_bytes(64));
    $sql="INSERT INTO AccessToken VALUES($uid,'$token');";
    if($result = mysqli_query($GLOBALS["db"],$sql)){
        return $token;
    }
    else
    return FALSE;
}
/*
 *Function Name :
 *check_userid()
 *Functionality : 
 *The function takes user id and checks if the user is registered or not .
 *params:
 *$uid : stands for user id
 *You can change this parameters for your purposes and don't to forget to change sql statment
 */
function check_userid($uid){
    $sql="select userid from ".utable." where userid = $uid;";
 $result = mysqli_query($GLOBALS["db"],$sql);
 
 $row=mysqli_fetch_array($result);
 if($row!=NULL)
 return TRUE;
 else
 return FALSE;
}
function check_token($token){
    $sql="SELECT userid FROM AccessToken WHERE token='$token';";
    $result = mysqli_query($GLOBALS["db"],$sql);
    $myrow = mysqli_fetch_array($result);
        $userid=$myrow["userid"];
        if(isset($userid))
        return $userid;
    
    else 
    return "No Token";
}
function displayUserInfo($uid){
    $sql="select * from ".utable." where userid = $uid;";
 $result = mysqli_query($GLOBALS["db"],$sql);
 
 $row=mysqli_fetch_array($result);
 $userdata =array();
 $userdata["username"]=$row["username"];
 $userdata["firstname"]=$row["firstname"];
 $userdata["lastname"]=$row["lastname"];
 $userdata["usertel"]=$row["usertel"];
 $userdata["email"]=$row["useremail"];
 $file= dirname(__DIR__)."/profileimg/prof".$uid.".jpg";
    $profimg="prof".$uid.".jpg";
    if(file_exists($file))
 $userdata["image"]=$profimg;
 else
 $userdata["image"]="Ahmed.png";
 return $userdata;
}
function displayUserApart($token){
    $sql="SELECT * FROM Apartements ap join AccessToken ac on ap.userid = ac.userid where ac.token ='$token';";
    $result = mysqli_query($GLOBALS["db"],$sql);
    $userdata=array();
    $apart=array();
     $index=0;
    while($row=mysqli_fetch_array($result)){
    if($index==4)
        break;
    $apart=array(
    "id"=>$row["apartid"],
    "govern"=>$row["govern"],
    "city"=>$row["city"],
    "price"=>$row["price"],
    "numOfRooms"=>$row["numOfRooms"],
    "numOfKitchen"=>$row["numOfKitchen"],
    "numOfBathrooms"=>$row["numOfBathrooms"],
    "apartdescription"=>$row["apartdescription"]
    );

    $file= dirname(__DIR__)."/apartimg/apart".$row["apartid"].".jpg";
    $profimg="apart".$row["apartid"]."jpg";
    if(file_exists($file))
    $apart["image"]=$profimg;
    else
    $apart["image"]="Ahmed.png";
    $index++;
    array_push($userdata,$apart);

 }
 
 
    return $userdata;
}
function displayApartInfo($apartid){
    $sql="SELECT * FROM Apartements where apartid=$apartid;";
    $result = mysqli_query($GLOBALS["db"],$sql);
    $apart=array();
    $row=mysqli_fetch_array($result);
   
    $apart=array(
    "id"=>$row["apartid"],
    "govern"=>$row["govern"],
    "city"=>$row["city"],
    "price"=>$row["price"],
    "numOfRooms"=>$row["numOfRooms"],
    "numOfKitchen"=>$row["numOfKitchen"],
    "numOfBathrooms"=>$row["numOfBathrooms"],
    "apartdescription"=>$row["apartdescription"]
    );

    $file= dirname(__DIR__)."/apartimg/apart".$row["apartid"].".jpg";
    $profimg="apart".$row["apartid"]."jpg";
    if(file_exists($file))
    $apart["image"]=$profimg;
    else
    $apart["image"]="Ahmed.png";

    return $apart;
}
function resizeProfImage($filename,$sourcefile){
    $image = new ImageResize($sourcefile);
    $image->resize(600, 300);
    $target_dir=dirname(__DIR__,1)."/android/profileimg/";
    if (file_exists($target_dir.$filename)) 
            {
                chmod($target_dir.$filename,0755);//changes the file permission to write / execute
                unlink($target_dir.$filename);
                }
    $image->save($target_dir.$filename);
}
function resizeApartImage($filename,$sourcefile){
    $image = new ImageResize($sourcefile);
    $image->resize(600, 300);
    $target_dir=dirname(__DIR__,1)."/android/apartimg/";
    if (file_exists($target_dir.$filename)) 
            {
                chmod($target_dir.$filename,0755);//changes the file permission to write / execute
                unlink($target_dir.$filename);
                }
    $image->save($target_dir.$filename);
}
?>