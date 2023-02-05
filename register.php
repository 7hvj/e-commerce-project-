<?php 
@include'config.php';

if(isset($_POST['submit'])){

    $name=mysqli_real_escape_string($mysqli,$_POST['name']);
    $email=mysqli_real_escape_string($mysqli,$_POST['email']);
    $pass=md5($_POST['password']);
    $cpass=md5($_POST['cpassword']);
    $user_type=$_POST['user_type'];
    // query
    $select="SELECT * FROM user_form WHERE email='$email' && password = '$pass'";
    // run query
    $result=mysqli_query($mysqli,$select);
    if(mysqli_num_rows($result)>0){

        $error[]='user already exist!';

    }else{
        if($pass != $cpass){
            $error[]='Password not matched!';
        }else{
            // querey
            $insert="INSERT INTO user_form(name, email, password, user_type) values ('$name','$email','$pass','$user_type')";
            // run query
            mysqli_query($mysqli,$insert);
            header('location:login.php');
        }
    }


};

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Register Now</h3>
            
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            
            ?>
            <input type="text" name="name" required placeholder="Enter your name">
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="password" name="cpassword" required placeholder="confirm your password">
            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </div>
</body>
</html>