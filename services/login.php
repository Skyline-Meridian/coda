<?php
session_start();
require_once('../db_config.php');

if(isset($_POST['submit']))
{
    if(isset($_POST['coda-emailid'],$_POST['coda-password']) && !empty($_POST['coda-emailid']) && !empty($_POST['coda-password']))
    {
        $email = trim($_POST['coda-emailid']);
        $password = trim($_POST['coda-password']);

        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $sql = "select * from users where email = :email ";
            $handle = $pdo->prepare($sql);
            $params = ['email'=>$email];
            $handle->execute($params);
            if($handle->rowCount() > 0)
            {
                $getRow = $handle->fetch(PDO::FETCH_ASSOC);
                if(password_verify($password, $getRow['upass']))
                {
                    unset($getRow['upass']);
                    $_SESSION['auth'] = true;
                    $_SESSION['id'] = $getRow['id'];
                    $_SESSION['start'] = time();
                    $_SESSION['name'] = $getRow['uname'];
                    header('location:../index.php');
                    exit();
                }
                else
                {
                    $errors = "Wrong Email or Password";
                    header('Location:../pages/login.php?error="'.$errors.'"');

                }
            }
            else
            {
                $errors = "Wrong Email or Password";
                 header('Location:../pages/login.php?error="'.$errors.'"');
                 die;
            }

        }
        else
        {
            $errors = "Email address is not valid";
             header('Location:../pages/login.php?error="'.$errors.'"');
             die;
        }

    }
    else
    {
        $errors = "Email and Password are required";
         header('Location:../pages/login.php?error="'.$errors.'"');
         die;
    }

}
?>