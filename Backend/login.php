<?php

if (isset($_POST['submit'])) {

    require 'connection.php';

    $phone = $_POST['phone'];
    $password = $_POST['password'];

    if (empty($phone) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    } else {
        $query = "SELECT `name`, `id`, `pass` FROM `users` WHERE `phone` = $phone";
        $result= mysqli_query($con, $query);

        
            if ($row = mysqli_fetch_assoc($result)) {
                //$pass = password_verify($password, $row['pass']);
               
                   // $pass= true;
                  if(strcmp($password,$row['pass'])==0){
                    $pass= true;
                  }
                else{
                    $pass= false;
                }
               

                
                if ($pass == false) {
                    header("Location: ../login.php?error=wrongpass");
                    exit();
                } elseif ($pass == true) {
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['name']= $row['name'];
                   // $_SESSION['user'] = $row['name'];
                    header("Location: ../store.php?success=loggedin");
                    exit();
                } else {
                    header("Location: ../login.php?error=sqlerror");
                    exit();
                }
            } else {
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }   



?>
