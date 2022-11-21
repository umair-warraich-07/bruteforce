<?php
include 'includes/config.php';

$user_email = $_GET['user'];
    
$sql=mysqli_query($connection, "select ver_code from users where user_email='$user_email'");
$result=mysqli_fetch_array($sql);
$verification_code=$result['ver_code'];


if (isset($_POST["verify"])) {
    
        $code=$_POST['tac'];
        if ($code==$verification_code) {
            echo "<script type='text/javascript'> document.location = 'reset_password.php?user=$user_email'; </script>";
        }else {
            // echo "TAC Code is not correct or expired!";
            echo "<div id='dialog-message' title='TAC Information'>";
            echo "<p>
            Unable to verify TAC Code.
            </p>
            <p>
            <b>Please check your email and write the correct TAC code<b>
            </p>
            </div>";
        }
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Verification </title>
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
                <h2>Enter the TAC that you have received in your email</h2>
                <form  method="post">
                    <div  style=" width: 20vw; margin-left : 15vw; padding-bottom: 4%;">
                        <input type="text" placeholder="TAC Code"  name="tac" required />
                    </div>
                    
                    
                    <button class="btn" style=" width: 10vw; margin-left : 20vw;" name="verify" type="submit">Verify</button>
                    
                    </div> <br>
                </form>
            </th>
            <th><img src="Uniten-Logo.jpg"></th>
        </tr>
    </table>
</body>
</html>
