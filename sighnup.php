<?php
include 'includes/config.php';
if (isset($_POST["login"])) {
    $captcha = $_POST["g-recaptcha-response"];
    $secretkey = "6LcqpQ4hAAAAAJ6SY_1WRZZ6BHkingaQQ2-3SX-U";
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . urlencode($secretkey) . "&response=" . urlencode($captcha) . " ";
    $response = file_get_contents($url);
    $responsekey = json_decode($response, true);
    if ($responsekey["success"]) {
        $email = $_POST['email'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $sql_q = "INSERT INTO `users`( `user_name`, `user_password`, `user_email`) VALUES ('$user_name','$password','$email')";
        // $result = mysqli_query($connection, $sql_q);
        if (mysqli_query($connection, $sql_q)) {
            echo "<div id='dialog-message' title='Registeration Info'>";
                echo "<p>
                <span class='ui-icon ui-icon-circle-info' style='float:left; margin:0 7px 50px 0;'></span>
                You have been registered successfully, Please login now.
                </p>
                
                </div>";

            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        } else {
            echo "<div id='dialog-message' title='Invalid Details'>";
                echo "<p>
                <span class='ui-icon ui-icon-circle-info' style='float:left; margin:0 7px 50px 0;'></span>
                There is problem with the login..
                </p>
                <p>
                    Please check your email or password.
                </p>
                </div>";
        }
    } else {
        echo "<div id='dialog-message' title='reCaptcha Required'>";
        echo "<p>
        <span class='ui-icon ui-icon-circle-info' style='float:left; margin:0 7px 50px 0;'></span>
        Please check your internet and refresh the page to check the reCaptcha.
        </p>
        <p>
        <b>This is for security purpose.<b>
        </p>
        </div>";
    }
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Register</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <h1 class="log">Sign Up</h1>
                <form  method="post">
                    <div class="form-field" style=" width: 20vw; margin-left : 15vw; padding-bottom: 4%;">
                        <input type="text" placeholder="Username"  name="user_name" required />
                    </div>
                    <div class="form-field" style=" width: 20vw; margin-left : 15vw; padding-bottom: 4%;">
                        <input type="password" placeholder="Password" name="password"  required />
                    </div>
                    <div class="form-field" style=" width: 20vw; margin-left : 15vw; padding-bottom: 4%;">
                        <input type="email" placeholder="Email" name="email" required />
                    </div>
                    <div class="g-recaptcha" style=" width: 20vw; margin-left : 15vw; padding-bottom: 4%;" data-sitekey="6LcqpQ4hAAAAAMR6Dgb4Q1oqmpSsDShGh_UeUOsH"></div>
                <!-- <div> <label><input type="checkbox" checked="checked" name="remember">Remember me </label>
                </div><br> -->
                    <button class="btn" style=" width: 10vw; margin-left : 20vw;" name="login" type="submit">Sighnup</button>
                    </div> <br>
                </form>
            </th>
            <th><img src="Uniten-Logo.jpg"></th>
        </tr>
    </table>
</body>
</html>
