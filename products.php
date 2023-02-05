<?php
@include 'config.php';

session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
}

// add product to cart (print cart number)
if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($mysqli, "SELECT * FROM `cart` WHERE name='$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'product already added to cart';
    } else {
        $insert_product = mysqli_query($mysqli, "INSERT INTO `cart`(name,price,image,quantity) VALUES ('$product_name','$product_price','$product_image','$product_quantity')");
        $message[] = 'product add to cart succesfully';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        };
    };
    ?>
    <!-- تضمين الهيد -->
    <header class="header">
        <div class="flex">
            <a href="products.php" class="logo">IAU clothing Store</a>
            <nav class="navbar">
                <a href="prevOrder.php">previous purchase</a>
                <a href="contact.php">Contact us</a>
                <a href="logout.php">Log out</a>
            </nav>
            <?php
            $select_rows = mysqli_query($mysqli, "SELECT * FROM `cart`") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);
            ?>
            <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span></a>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>
    </header>

    <div class="container">
        <!-- get products from product database -->
        <section class="products">
            <h1 class="heading">lastet products</h1>
            <div class="box-container">
                <?php
                $select_products = mysqli_query($mysqli, "SELECT * FROM `products`");
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {

                ?>
                        <form action="" method="post">
                            <div class="box">
                                <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
                                <h3><?php echo $fetch_product['name']; ?></h3>
                                <div class="price">$<?php echo $fetch_product['price']; ?></div>
                                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                <input type="submit" class="btn" value="add to cart" name="add_to_cart">
                            </div>
                        </form>
                <?php
                    };
                };
                ?>
            </div>
        </section>
    </div>























    <script src="js/script.js"></script>
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