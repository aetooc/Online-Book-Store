<?php

include 'config.php';

try{

   if(isset($_POST['submit'])){

      $name = $_POST['name'];
      $email = $_POST['email'];
      $pass = md5($_POST['password']);
      $cpass = md5($_POST['cpassword']);
      $user_type = "user";

      $check = $conn->query("SELECT * FROM `users`");
      $check_count = $check->rowCount(); 
      if ($check_count == 0){
         $user_type = "admin";
         try{
            $query = $conn->prepare("INSERT INTO users(name, email, password, user_type) VALUES(?,?,?,?)");
            $query->execute([$name, $email, $cpass, $user_type]);
            $message[] = 'registered successfully!';
            // header('location:login.php');
            }catch(PDOException $e) {
               echo "Connection failed: " . $e->getMessage();
            }
      }

      else{

         // $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
         $select_users = $conn->query("SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'");
         $count = $select_users->rowCount();
         if($count > 0){
            $message[] = 'user already exist!';
         }
         else{
            if($pass != $cpass){
               $message[] = 'confirm password not matched!';
            }else{
               try{
               $query = $conn->prepare("INSERT INTO users(name, email, password, user_type) VALUES(?,?,?,?)");
               $query->execute([$name, $email, $cpass, $user_type]);
               $message[] = 'registered successfully!';
               // header('location:login.php');
               }catch(PDOException $e) {
                  echo "Connection failed: " . $e->getMessage();
               }
            }
         }
      }     
   }
}
catch(PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php
try{
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
}
catch(PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
   }
?>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>

                        <form method="POST" name="myForm" >
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account-circle"></i></label>
                                <input type="text" name="name" placeholder="Enter Your Name" required/>
                            </div>                            
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" placeholder="Enter Your Email" required/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" placeholder="Enter Your Password" required/>
                            </div>
                            <div class="form-group">
                                <label for="cpassword"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="cpassword" placeholder="Confirm Your Password" required/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" required name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submit" value="register now" class="form-submit"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

        

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
