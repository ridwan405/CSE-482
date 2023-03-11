<?php

if (isset($_POST['submit'])) {
    //Add database connection
    require 'connection.php';

    $name = $_POST['name'];
    $password = $_POST['password'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $confirmPass = $_POST['confirmPassword'];

    if (empty($name) || empty($password) || empty($confirmPass) || empty($location) || empty($phone)) {
        header("Location: ../register.php?error=emptyfields&name=".$name);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*/", $name)) {
        header("Location: ../register.php?error=invalidname&name=".$name);
        exit();
    } elseif($password !== $confirmPass) {
        header("Location: ../register.php?error=passwordsdonotmatch&name=".$name);
        exit();
    }

    else {
        $query = "SELECT phone FROM users WHERE phone = $phone";
        $result= mysqli_query($con, $query);
        $rowCount= mysqli_num_rows($result);

            if ($rowCount > 0) {
                header("Location: ../register.php?error=phonenumbertaken");
                exit();
            } else {
                //$hashedPass = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO `users` (`id`, `name`, `location`, `phone`, `pass`) VALUES ('0', '$name', '$location', '$phone', '$password')";
                mysqli_query($con, $query);

                //$con->query($query);
            
                        header("Location: ../login.php?succes=registered");
                        exit();
                }
            }
        }
    
    
    mysqli_close($con);

?>
