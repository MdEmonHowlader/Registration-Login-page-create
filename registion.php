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
                        <button class="tablinks" onclick="openCity(event, 'sign-up')" id="defaultOpen">Sign Up</button>
                    </div>
                    <!-- <div class="tab-inner">
                        <button class="tablinks" onclick="openCity(event, 'sign-in')">Sign In</button>
                    </div> -->
                </div>
                <?php
               if(isset($_POST['submit'])) {
                $username = $_POST['full_name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $comfirm_password = $_POST['comfirm_password'];
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $errors=array();

                if(empty($username) OR empty($email) OR empty($password) OR empty($comfirm_password)){

                  array_push($errors,"Please fill in all fields");
                }
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                  array_push($errors,"Email is not valid");
                }
                if(strlen($password)<8){
                  array_push($errors,"Password must be at least 8 charactes long ");
                }
                if($password!==$comfirm_password){
                  array_push($errors,"Password and confirm password do not match");
                }
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email ='$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if($rowCount>0){
                    array_push($errors, "Email Already Exists");
                }
                if(count($errors)>0){
                  foreach($errors as $error){
                    echo "<div class='alert alert-denger'>$error</div>";
                  }
                }else{
                  

                  $sql="INSERT INTO users(full_name, email, password) VALUES (?, ?, ?)";
               
                  $stmt = mysqli_stmt_init($conn);
                  $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                  if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'> You are Registered Successfully.</div>";

                  }else{
                    die("Something went wrong");
                  }
                  
                }
            
               }
                ?>
                <form class="form-detail" action="registion.php" method="post">
                    <div class="tabcontent" id="sign-up">
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="text" name="full_name" id="full_name" class="input-text" required>
                                <span class="label">Username</span>
                                <span class="border"></span>
                            </label>
                        </div>
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
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="password" name="comfirm_password" id="comfirm_password" class="input-text"
                                    required>
                                <span class="label">Comfirm Password</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row-last">
                            <input type="submit" name="submit" class="register" value="Register">
                            <p class="mb-5 pb-lg-2" style="color: blanchedalmond;">I have an account? <a href="login.php"
                            style="color: blanchedalmond;">Login here</a></p>
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