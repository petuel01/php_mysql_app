<?php 
include 'connect2.php';
session_start();

// Check if the user is logged in and has a role set in the session


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user info</title>
    <link rel="stylesheet" href="\ims\css\dashboard.css">
    <link rel="stylesheet" href="\ims\source\fontawesome-free-5.15.4-web\fontawesome-free-5.15.4-web\css\all.css">
    <link rel="stylesheet" href="user.css">
    <script type="text/javascript" src="\ims\js\script.js"></script>
    <style>
        .user{
            width: 90%;
            margin-left: 6%;
            padding: 2rem;
            margin-top: 5.6rem;
            align-items: center;
            justify-content: center;
            background: white;
            margin-bottom: 2rem;
            border-radius: 10px;
        }
        .user h5{
            text-align: center;
            font-size: .9rem;
        }
        .user input{
            text-align: center;
            width: 80%;
            margin-left: 10%;
            font-size: .9rem;
        }
        .user input[type=submit]{
            background-color: green;

        }
        .user input[type=submit]:hover{
            background: black;
            color: white;
            transform: scale(1.15);
        }
        @media screen and (max-width: 700px){
            .user input,
            .user h5{
                font-size: .6rem;
            }
        }
    </style>
</head>
<body>
<section class="user">
   <?php  
    $name = $_SESSION['username'];
    $edit_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$name' ") or die('query failed');
    if(mysqli_num_rows($edit_query)){
     while($fetch_edit = mysqli_fetch_assoc($edit_query)){
        
 ?>
 <input type="hidden" name="up_id" value="<?php echo $fetch_edit['id'] ?>" >
 <h5>username</h5>
 <input type="text" name="up_name" value="<?php echo $fetch_edit['username'] ?>" readonly>
 <form method="post">
    <h5>Enter your Old-Password</h5>
    <input type="password" name="old-pass" placeholder="old password">
    <h5>Enter your New-Password</h5>
    <input type="password" name="new-pass" placeholder="new password">
    <input type="submit" name="save" value="Save Changes" >
 </form>
 </form>
 <?php
    }
  }

 
   
  if(isset($_POST['save'])){
    $oldpass = $_POST['old-pass'];
    $newpass = $_POST['new-pass'];
    $edit_pass = mysqli_query($conn, "SELECT password FROM users WHERE name = '$name' ") or die('query failed');
    if(mysqli_num_rows($edit_pass)){
        while($row = mysqli_fetch_assoc($edit_pass)){
            $pass = $row['password'];
        }
        if($pass == $oldpass){
            $change_pass = mysqli_query($conn,"UPDATE users SET password = '$newpass' WHERE name = '$name'") or die('query failed');
            $message[] = 'password chsnged successfully';
        }else{
            $message[] = 'wrong password';
        }
    
  }

  }      


   ?>
</section>
</body>
</html>