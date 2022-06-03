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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

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

<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="enter your name" required class="box">
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>