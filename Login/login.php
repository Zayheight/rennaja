<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $email = mysqli_real_escape_string($conn, $_POST['email']);


   $select = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' AND password = '$password'") or die('query failed');

      // if (preg_match("admin(int i, i >= 0, i++)",$username)) {
      //    header('location:test.html');
      // }
      if(mysqli_num_rows($select) > 0){
         $row = mysqli_fetch_assoc($select);
         $_SESSION['username'] = $row['id'];
         header('location:home.php');
      }else{
         $message[] = 'incorrect email or password!';
      }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../Login/css/style.css">
   <!-- <link rel="stylesheet" href="../rentnaja-main/Style/style_homepage.css"> -->

</head>
<body>

<header>
    <div class="nav-bar">
      <div class="logo">
        <img src="../Login/images/logo.png" alt="" id="vv" />
      </div>
      <div class="navigation">
        <div class="nav-items">
          <i class="uil uil-times nav-close-btn"></i>
          <a href="/Homepage.html"><i class="uil uil-home"></i>หน้าแรก</a>
          <a href="/Menunavbar/Rentpage.html"><i class="uil uil-compass"></i>ให้เช่า</a>
          <a href="/Menunavbar/Reccomendedpage.html"><i class="uil uil-info-circle"></i>รายการแนะนำ</a>
          <a href="/Menunavbar/Aboutuspage.html"><i class="uil uil-document-layout-left"></i>เกี่ยวกับเรา</a>
          <a href="/Menunavbar/Contactuspage.html"><i class="uil uil-document-layout-left"></i>ติดต่อเรา</a>
          <a href="/Menunavbar/Newspage.html"><i class="uil uil-envelope"></i>ข่าว</a>
          <a href="/Menunavbar/Questionpage.html"><i class="uil uil-envelope"></i>คำถาม</a>
          <a1><a href="/Function/sidebar/index.html"><i class="uil uil-envelope"></i> + ลงประกาศ</a></a1>
          <!-- <a href="/Function/login/login.html"><i class="uil uil-envelope"></i>เข้าสู่ระบบ</a> -->
        </div>
      </div>
      <i class="uil uil-apps nav-menu-btn"></i>
    </div>
    <div class="scroll-indicator-container">
      <div class="scroll-indicator-bar"></div>
    </div>
  </header>


<div class="form-container">
   <img src="../Login/images/img_01.png">

   <form action="" method="post">
      <h3>login Here</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <label for="username">Email</label>
      <input type="text" name="email" placeholder="enter email" class="box" required><br>
      <label for="username">password</label>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login" class="btn">
      <p>don't have an account? <a href="register.php">regiser now</a></p>
   </form>

</div>

</body>
</html>