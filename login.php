<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="css/sourcesanspro-font.css">

    <link rel="stylesheet" href="css/style.css" />
    <meta name="robots" content="noindex, follow">
</head>

<body class="form-v8">
    <div class="page-content">
        <div class="form-v8-content">
            <div class="form-left">         
                <img src="images.jpg" alt="form" height="100%" width="100%">
            </div>
            <div class="form-right">
                <div class="tab">
                    <div class="tab-inner">
                        <button class="tablinks" onclick="openCity(event, 'sign-up')" id="defaultOpen">Sign into your account</button>
                        
                    </div>
                    
                </div>
                <?php
                if(isset($_POST['login'])){
                  $email=$_POST['email'];
                  $password=$_POST['password'];
                  require_once "database.php";
                  $sql= "SELECT * FROM users WHERE email ='$email'";
                  $result = mysqli_query($conn, $sql);
                  $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  if($user){
                    if(password_verify($password, $user["password"])){
                      session_start();
                      $_SESSION["user"]="Yes";
                      header("Location: index.php");
                    die();

                    }else{
                        echo "<div class='alert alert-denger'>Password does not match</div>";
                      
                    }

                  }else{
                    echo "<div class='alert alert-denger'>Email does not match</div>";
                  }
                }
                ?>
               
                <form class="form-detail" action="login.php" method="post">
                    <div class="tabcontent" id="sign-up">
                      
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="text" name="email" id="email" class="input-text" required>
                                <span class="label">E-Mail</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="password" name="password" id="password" class="input-text" required>
                                <span class="label">Password</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row-last">
                        
                        <input type="submit" name="login" class="register" value="Login">
                           
                            <p class="mb-5 pb-lg-2" style="color: blanchedalmond;">Don't have an account? <a href="registion.php"
                            style="color: blanchedalmond;">Register here</a></p>
                        </div>
                    </div>
                </form>
               
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

      
        document.getElementById("defaultOpen").click();
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"897e60325deaa485","version":"2024.4.1","token":"cd0b4b3a733644fc843ef0b185f98241"}'
        crossorigin="anonymous"></script>
</body>

</html>