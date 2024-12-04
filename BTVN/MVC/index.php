<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Quản lý thành viên</title>
</head>
<body>

</body>
</html>

<?php
     include 'Model/function.php';
     $db = new Database;
     $db->connect();

     if(isset($_GET['controller'])){
         $controller = $_GET['controller'];
     }
     else{
         $controller = '';
     }

     switch($controller){
         case 'thanh-vien':{
             require_once('Controller/thanh_vien/index.php');
         }
     }
?>
