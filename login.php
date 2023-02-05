<?php
@include 'config.php';
session_start();

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
    // query
    $select = "SELECT * FROM user_form WHERE email='$email' && password = '$pass'";
    // run query
    $result = mysqli_query($mysqli, $select);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $_SESSION['email'] = $row['email'];
        
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin.php');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            header('location:products.php');
        }
    } else {
        $error[] = 'incorrect email or password!';
        header('location:login.php');
    }
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>login now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                };
            };

            ?>
            <div class="input-group">
                <input type="email" name="email" placeholder="Enter your email" id="contact-email" onkeyup='vaildateEmail()'>
                <span id="email-error"></span>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Enter your password" id="contact-pass" onkeyup='vaildatepass()'>
                <span id="password-error"></span>
            </div>
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>don't have an account? <a href="register.php">register now</a></p>
        </form>
    </div>



    <script src="js/scripts.js"></script>
</body>

</html>