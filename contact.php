<?php
@include'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- تضمين الهيد -->
    <header class="header">
    <div class="flex">
    <a href="products.php" class="logo">IAU clothing Store</a>
    <nav class="navbar">
        <a href="products.php">View products</a>
        <a href="prevOrder.php">previous purchase</a>
        <a href="logout.php">Log out</a>
    </nav>
    <?php
    $select_rows=mysqli_query($mysqli,"SELECT * FROM `cart`") or die('query failed');
    $row_count=mysqli_num_rows($select_rows);
    ?>
    <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span></a>
    <div id="menu-btn" class="fas fa-bars"></div>
</div>
</header>

<div class="cc">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3573.949940328777!2d50.19477598455216!3d26.39280488863037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49ef85c961edaf%3A0x7b2db98f2941c78c!2z2KzYp9mF2LnYqSDYp9mE2KXZhdin2YUg2LnYqNiv2KfZhNix2K3ZhdmGINio2YYg2YHZiti12YQ!5e0!3m2!1sar!2ssa!4v1675431922321!5m2!1sar!2ssa" width="100%" height="650px" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="contact-form">
            <h1 class="title">Contact Us</h1>
            <h2 class="subtitle">We are here assist you.</h2>
            <form action="">
                <input type="text" name="Fname" class="inputc" placeholder="Your Name" >
                <input type="email" name="e-mail" class="inputc" placeholder="Your E-mail Address" >
                <input type="tel" name="phone" class="inputc" placeholder="Your Phone Number">
                <textarea name="text" id="" rows="8" placeholder="Your Message"></textarea>
                <button class="btn-send">Get a Call Back</button>
            </form>
        </div>
    </div>


































<!-- تضمين الفوتر -->
<footer>
        <div class="footer-content">
            <h3>IAU clothing Store</h3>
            <p>
                We are an online clothing store that has been operating to serve the needs of our devoted consumers for over 15 years.
                Our objective is to increase the quality of service we offer to our esteemed clients in order to maximize societal benefits.
                The foundation of our development is complete after-sales service, and we never stop striving to achieve it.
            </p>
        </div>
    </footer>
    <div class="footer-bottom">
        <p>copyright &copy;2023 IAU. designed by <span>Group 3</span></p>
    </div>
</body>
</html>