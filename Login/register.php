<?php

include 'config.php';

if (isset($_POST['submit'])) {
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $sex = mysqli_real_escape_string($conn, $_POST['sex']);
   $date = mysqli_real_escape_string($conn, $_POST['date']);
   $nubcall = mysqli_real_escape_string($conn, $_POST['nubcall']);
   $line = mysqli_real_escape_string($conn, $_POST['line']);
   $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $role = mysqli_real_escape_string($conn, $_POST['role']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;

   $select = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' OR username = '$username' AND password = '$password'") or die('query failed');

   if (mysqli_num_rows($select) > 0) {
      $message[] = 'user already exist';
   } else {
      if ($password != $cpass) {
         $message[] = 'confirm password not matched!';
      } elseif ($image_size > 2000000) {
         $message[] = 'image size is too large!';
      } else {
         $insert = mysqli_query(
            $conn,
            "INSERT INTO user
         -- (username,email, password, image,firstname,lastname,role,sex,date,nubcall,line,facebook,address) 
         VALUES
         ('',
            '$email',
            '$username',
            '$password',
            '$firstname',
            '$lastname',
            '$role',
            '$sex',
            '$date',
            '$nubcall',
            '$line',
            '$facebook',
            '$address',
            current_timestamp,
            '$image'
         )"
         )
            or die('query failed');

         if ($insert) {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('///////////////////// ใส่ location //////////////////////////');
         } else {
            $message[] = 'registeration failed!';
         }
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../Login/css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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

   <div class="regis-container">
      <img src="../Login/images/img_01.png">
      <form action="" method="post" enctype="multipart/form-data">
         <h3>Register now</h3><br>
         <?php
         if (isset($message)) {
            foreach ($message as $message) {
               echo '<div class="message">' . $message . '</div>';
            }
         }
         ?>
         <div class="user-details">
            <span >Username</span>
            <input type="text" name="username" placeholder="enter username" class="box" required>
            <span >Email address</span>
            <input type="email" name="email" placeholder="enter email" class="box" required>
            <span >Password</span>
            <input type="password" name="password" placeholder="enter password" class="box" required>
            <span >Confirm your password</span>
            <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
            <div class="input">
               <label>Firstname</label>
               <input type="text" name="firstname" placeholder="enter firstname" required>
            </div>
            <div class="input">
               <label>Lastname</label>
               <input type="text" name="lastname" placeholder="enter lastname" required>
            </div>
            <div class="sex">
               <label for="">Gender</label>
               <select name="sex">
                  <option value="" class="box">--Select Gender--</option>
                  <option value="Male" name="sex" class="box">ชาย</option>
                  <option value="Female" name="sex" class="box">หญิง</option>
               </select>
            </div>
            <div class="role">
               <label for="">Role</label>
               <select name="role">
                  <option value="" class="box">--Select Role--</option>
                  <option value="User" name="role" class="box">User</option>
                  <option value="Owner" name="role" class="box">Owner</option>
                  <option value="Agent" name="role" class="box">Agent</option>
               </select>
            </div><br><br> 
            <div class="date">
               <label for="">Birtday</label>
               <input type="date" name="date" placeholder="enter date" class="new" required>
            </div>
            <div class="input">
               <!-- <span>Birtday</span>
               <input type="date" name="date" placeholder="enter date" class="new" required> -->
               <span>Phone number</span>
               <input type="text" name="nubcall" placeholder="enter nubcall" class="box" required>
               <span>ID line</span>
               <input type="text" name="line" placeholder="enter line" class="box" required>
               <span>Facebook</span>
               <input type="text" name="facebook" placeholder="enter facebook" class="box" required>
               <span>Your address</span>
               <input type="text" name="address" placeholder="enter address" class="box" required>
               <span>Profile</span>
               <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
            </div>
         </div>
         <input type="submit" name="submit" value="register now" class="btn">
         <p>already have an account? <a href="login.php">login now</a></p>   
      </form>

   </div>

</body>

</html>