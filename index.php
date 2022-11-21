<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP; //SMTP authentication --> SMTP Simple Mail Transfer Protocol
 use PHPMailer\PHPMailer\Exception;

 //Load Composer's autoloader
 require 'vendor/autoload.php';
 include 'includes/config.php';


include 'includes/config.php';
if (isset($_POST["login"])) {
    $captcha = $_POST["g-recaptcha-response"];
    $secretkey = "6Les9yMjAAAAAEOrshqxWeE79fjrKZxUJlyobZ3o";
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . urlencode($secretkey) . "&response=" . urlencode($captcha) . " ";
    $response = file_get_contents($url);
    $responsekey = json_decode($response, true);
    if ($responsekey["success"]) {
        $login_attempt = 0;
        $mymail="";
        $user_name = $_POST['username'];
        $password = $_POST['password'];
        $sql_q = "select login_attempts from users where user_name='$user_name'";
        $result = mysqli_query($connection, $sql_q);

        while ($user_result = mysqli_fetch_assoc($result)) {
            $login_attempt = $user_result['login_attempts'];
        }
        if ($login_attempt <= 2) {
            $sql = "SELECT user_name,user_password, user_email FROM users WHERE user_name='$user_name' and user_password='$password' and status='1'";

            $res = mysqli_query($connection, $sql);
            $row = mysqli_fetch_array($res, MYSQLI_NUM);
            if (!empty($row)) {
                $mymail=$row[2];
            } 
            
           
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //login successfull
                $_SESSION['login'] = $_POST['username'];
                echo "<script type='text/javascript'> document.location = 'interface.php'; </script>";
            } else {
                if ($login_attempt <= 2) {
                    //updating login attempts in database
                    $login_attempt++;
                    $usql = "UPDATE `users` SET login_attempts= '$login_attempt' WHERE user_name='$user_name'";
                    $resultt = mysqli_query($connection, $usql);
                }
  
                echo "<div id='dialog-message' title='Failed Login'>
                <span style='float:left; '> <br> Invalid username or password, Please try again.</span> </div>";
            }
        } else {
            $u_sql = "UPDATE `users` SET status= '0' WHERE user_name='$user_name'";
            $u_result = mysqli_query($connection, $u_sql);

           
            //Sending email to the User 
            $randomNum= substr(sha1(mt_rand()),17,10);
            $sqlq = "SELECT  user_email FROM users WHERE user_name='$user_name'";

            $resu = mysqli_query($connection, $sqlq);
            $rows = mysqli_fetch_array($resu, MYSQLI_NUM);
            if (!empty($rows)) {
                $mymail=$rows[0];
            }    


            if ($mymail!=="") {
                //Server settings
                $mail = new PHPMailer(true);                 //Create an instance; passing `true` enables exceptions
                $mail->isSMTP();                             //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';        //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                    //Enable SMTP authentication
                $mail->Username   = 'amalun10@gmail.com';    //my email is amalun10@gmail.com      //SMTP username
                $mail->Password   = 'gfmjgoewvtllqvdq';      //my password is gfmjgoewvtllqvdq     //SMTP password
                $mail->SMTPSecure = "tls";                   //Enable implicit TLS encryption
                $mail->Port       = 587;                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('amalun10@gmail.com', 'Uniten Info System');
                $mail->addAddress($mymail, 'Hello');         //Add a recipient
                $mail->addReplyTo('no-reply@gmail.com', 'No-reply');

                //Content
                $mail->isHTML(true);                          //Set email format to HTML
                $mail->Subject = 'UNITEN INFO SYSTEM';
                $mail->Body    = "<b>Dear User, </b> <br> <b>Please follow the following steps to allow you to login in again to you account: </b>

                <br> <br> <b>Step 1: </b> <br> 
                <b>Copy the code and paste it in the link below </b> <br> <b>$randomNum</b> <br>

                <br> <b>Step 2: </b> <br> 
                <b> Click the link below: <b> 
                <a href="."localhost/fyp2/verify.php?user=$mymail".">Link </a>
                
                <br><br>
                <b> Note: <b>
                Please login within 5 minutes before the code expires and contact the IT department for further assistance. ";

                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
     

                $u_sqll = "UPDATE `users` SET ver_code= '$randomNum' WHERE user_name='$user_name'";
                $u_resultt = mysqli_query($connection, $u_sqll);

                if(!$mail->send()) {
                    // echo 'Message could not be sent.';
                    // echo 'Mailer Error: ' . $mail->ErrorInfo;

                    echo "<div id='dialog-message' title='Email Error'>";
                    echo "<p>
                    <span class='ui-icon ui-icon-circle-info' style='float:left; margin:0 7px 50px 0;'></span>
                    $mail->ErrorInfo;
                    </p>
                    
                    </div>";
                } 
                // else {
                //     echo 'Message has been sent';
                // }
            }
            
            echo "<div id='dialog-message' title='Login Alert'>";
                echo "<p> You had tried three unsuccessful attempts which is not allowed to try more than three times 
                so make sure to check your email address to allow you to login into your account.</p> </div>";
        }

    } else {
        // echo "<script>alert('Recaptcha Required');</script>";
        echo "<div id='dialog-message' title='reCaptcha Required'>";
        echo "<p>Please check your internet and refresh the page to check the reCaptcha.</p>
        <b>This is for security purpose.<b> </div>";
    }
}



?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>LOGIN</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    $( function() {
        $( "#dialog-message" ).dialog({
        modal: true,
        buttons: {
            Ok: function() {
            $( this ).dialog( "close" );
            }
        }
        });
    } );
    </script>
</head>

<body>
    <table style="width:90%">
        <tr>
            <th>
                <h1 class="log">Login</h1>
                <form method="post">
                    <div class="form-field" style=" width: 20vw; margin-left : 15vw; padding-bottom: 4%;">
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-field" style=" width: 20vw; margin-left : 15vw;">
                        <input type="Password" name="password" placeholder="Password" required>
                    </div>
                    <div class="g-recaptcha" style=" width: 20vw; margin-left : 15vw; padding-bottom: 4%;" data-sitekey="6LcqpQ4hAAAAAMR6Dgb4Q1oqmpSsDShGh_UeUOsH"></div>
                <!-- <div> <label><input type="checkbox" checked="checked" name="remember">Remember me </label>
                </div><br> -->

                    <button class="btn" name="login" style=" width: 20vw; margin-left : 15vw;" type="submit">Log
                        in</button>

                </form>
                <div>
                    <span class="psw">Forgot <a href="#">Password?</a></span> </label>
                </div>
                <div class="sighnup">Don't have an account yet?
                    <a href="sighnup.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                        Sign Up </a>
                </div>
            </th>
            <th><img src="Uniten-Logo.jpg"></th>
        </tr>

    </table>
</body>

</html>
