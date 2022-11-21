<?php
include 'includes/config.php';

$user_email = $_GET['user'];
    

if (isset($_POST["reset"])) {
    
        $password=$_POST['password'];
        
            $sql_q = "UPDATE `users` SET user_password= '$password', status='1', login_attempts='0', ver_code='0' WHERE user_email='$user_email'";
            
            if (mysqli_query($connection, $sql_q)) {
                echo "<script>alert('Password Reset Successfully.');</script>";
                echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
            } else {
                echo "<div id='dialog-message' title='Invalid Details'>";
                echo "<p>
                <span class='ui-icon ui-icon-circle-info' style='float:left; margin:0 7px 50px 0;'></span>
                There is a problem in reseting your password. Pleae try again later!
                </p>
                
                </div>";
            }
        
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Reset Password</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <h2>Enter New Password</h2>
                <form  method="post">
                    <div  style=" width: 20vw; margin-left : 15vw; padding-bottom: 4%;">
                        <input type="Password" placeholder="Password"  name="password" required />
                    </div>
                    <button class="btn" style=" width: 20vw; margin-left : 15vw;" name="reset" type="submit">Reset Password</button>
                    </div> <br>
                </form>
            </th>
            <th><img src="Uniten-Logo.jpg"></th>
        </tr>
    </table>
</body>
</html>
