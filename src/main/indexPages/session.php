<?php
   include "/var/www/html/CourseEvals/src/main/inc/dbinfo.inc";

   function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }
  

   session_start();

   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from users where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];

   
   if(!isset($_SESSION['login_user'])){
    console_log("redirecting!!");
      header("location:/var/www/html/CourseEvals/src/main/indexPages/index.php");
   }
?>