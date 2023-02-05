<?php
@include 'config.php';
session_start();

if (isset($_POST['order_btn'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $pin_code = $_POST['pin_code'];

    $cart_query = mysqli_query($mysqli, "SELECT * FROM `cart`");

    $price_total = 0;

    $email = $_SESSION['email'];

    $cookiesData = [];

    if (mysqli_num_rows($cart_query) > 0) {
        while ($product_item = mysqli_fetch_assoc($cart_query)) {
            $product_name[] = $product_item['name'] . '(' . $product_item['quantity'] . ')';
            $product_price = number_format($product_item['price'] * $product_item['quantity']);
            $price_total += $product_price;

            $cookiesData[] = [
                'name' => $product_item['name'],
                'price' => $product_price,
                'qty' => $product_item['quantity'],
                'image' => $product_item['image']
            ];
        };
    };

    $cookie_name = $_SESSION['email'];
    $name = str_replace('.', '_', $email);
    $cookieExistingData = $_COOKIE[$name] ?? [];

    if (!empty($cookieExistingData)) {
        $cookieExistingData = json_decode($cookieExistingData, true);
    }

    $cookieExistingData = array_merge($cookieExistingData, $cookiesData);

    $cookieExistingData = json_encode($cookieExistingData);

    setcookie($cookie_name, $cookieExistingData, time() + (86400 * 30), "/"); // 86400 = 1 day

    $total_product = implode(', ', $product_name);

    $select_rows = mysqli_query($mysqli, "DELETE FROM `cart`") or die('query failed');

    $detail_query = mysqli_query($mysqli, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price)
    VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total')") or die('query failed');

    if ($cart_query && $detail_query) {
        echo "
        <div class='order-message-container'>
    <div class='message-container'>
        <h3>thank you for shopping !!</h3>
        <div class='order-detail'>
            <span>" . $total_product . "</span>
            <span class='total'> Total: $" . $price_total . "</span>
        </div>
        <div class='customer-details'>
            <p> your name: <span>" . $name . "</span></p>
            <p> your number: <span>" . $number . "</span></p>
            <p> your email: <span>" . $email . "</span></p>
            <p> your address: <span>" . $flat . ", " . $street . ", " . $city . ", " . $state . ", " . $country . ", " . $pin_code . "</span></p>
            <p> your payment mode: <span>" . $method . "</span></p>
        </div>
        <a href='products.php' class='btn'>continue shopping</a>
    </div>
        </div>

        ";
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
        <section class="checkout-form">
            <h1 class="heading">complete your information</h1>

            <form action="" method="post">

                <div class="display-order">
                    <?php
                    $select_cart = mysqli_query($mysqli, "SELECT * FROM `cart`");
                    $total = 0;

                    $grand_total = 0;

                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                            $grand_total = $total += $total_price;
                    ?>
                            <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                    <?php

                        }
                    } else {

                        echo "<div class='display-order'><span>your cart is empty!!</span></div>";
                    }
                    ?>
                    <span class="grand-total">Total:<?= $grand_total; ?> </span>
                </div>
                <div class="flex">
                    <div class="inputBox">
                        <span>your name</span>
                        <input type="text" placeholder="enter your name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>your number</span>
                        <input type="number" placeholder="enter your number" name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>your email</span>
                        <input type="email" placeholder="enter your email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>payment method</span>
                        <select name="method">
                            <option value="cash on delivery" selected>cash on delivery</option>
                            <option value="credit cart">credit cart</option>
                            <option value="paypal">paypal</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>address line 1</span>
                        <input type="text" placeholder="e.g. flat no." name="flat" required>
                    </div>
                    <div class="inputBox">
                        <span>address line 2</span>
                        <input type="text" placeholder="e.g. street name." name="street" required>
                    </div>
                    <div class="inputBox">
                        <span>pin code</span>
                        <input type="text" placeholder="e.g. 73999" name="pin_code" required>
                    </div>
                    <div class="inputBox">
                        <span>city</span>
                        <input type="text" placeholder="e.g. Dammam" name="city" required>
                    </div>
                    <div class="inputBox">
                        <span>state</span>
                        <input type="text" placeholder="e.g. Eastern Region " name="state" required>
                    </div>
                    <div class="inputBox">
                        <span>country</span>
                        <input type="text" placeholder="e.g. Kingdom of Saudi Arabia " name="country" required>
                    </div>
                </div>
                <input type="submit" value="order now" name="order_btn" class="btn">
            </form>

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