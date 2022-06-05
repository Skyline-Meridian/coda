<?php
session_start();
require_once('../db_config.php');
 $host  = $_SERVER['HTTP_HOST'];
 $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
if(isset($_POST['submit']))
{
    if(isset($_POST['coda-username'],$_POST['coda-emailid'],$_POST['coda-password']) && !empty($_POST['coda-username']) && !empty($_POST['coda-emailid'] && !empty($_POST['coda-password'])))
    {
        $uname = trim($_POST['coda-username']);
        $email = trim($_POST['coda-emailid']);
        $password = trim($_POST['coda-password']);

        $options = array("cost"=>4);
        $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);
        $date = date('Y-m-d H:i:s');

        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $sql = 'select * from users where email = :email';
            $stmt = $pdo->prepare($sql);
            $p = ['email'=>$email];
            $stmt->execute($p);

            if($stmt->rowCount() == 0)
            {
                $sql = "insert into users (uname, email, upass, created_at,updated_at) values(:uname,:email,:upass,:created_at,:updated_at)";

                try{
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':uname'=>$uname,
                        ':email'=>$email,
                        ':upass'=>$hashPassword,
                        ':created_at'=>$date,
                        ':updated_at'=>$date
                    ];

                    $handle->execute($params);

                    $success = 'User has been created successfully';
                    header('Location:../pages/login.php?msg="'.$success.'"');

                }
                catch(PDOException $e){
                    $errors = $e->getMessage();
                }
            }
            else
            {
                $valuname = $uname;
                $valEmail = '';
                $valPassword = $password;

                $errors = 'Email address already registered';
                 header('location:../pages/register.php?error="'.$errors.'"');
            }
        }
        else
        {
            $errors = "Email address is not valid";
             header('location:../pages/register.php?error="'.$errors.'"');
        }
    }
    else
    {
        if(!isset($_POST['coda-username']) || empty($_POST['coda-username']))
        {
            $errors = 'Username is required';
             header('location:../pages/register.php?error="'.$errors.'"');
        }
        else
        {
            $valFirstName = $_POST['coda-username'];
        }
        

        if(!isset($_POST['coda-emailid']) || empty($_POST['coda-emailid']))
        {
            $errors = 'Email is required';
            header('location:../pages/register.php?error="'.$errors.'"');
        }
        else
        {
            $valEmail = $_POST['coda-emailid'];
        }

        if(!isset($_POST['coda-password']) || empty($_POST['coda-password']))
        {
            $errors = 'Password is required';
            header('location:../pages/register.php?error="'.$errors.'"');
        }
        else
        {
            $valPassword = $_POST['coda-password'];
        }

    }

}