<?php
@include 'config.php';
session_start();

// remove item from shopping cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($mysqli, "DELETE FROM `cart` WHERE id ='$remove_id'");
    header('location:cart.php');
};

// remove all items from shopping cart
if (isset($_GET['delete_all'])) {
    mysqli_query($mysqli, "DELETE FROM `cart`");
    header('location:cart.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
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
            <a href="cart.php" class="cart">cart</a>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>
    </header>
    <div class="container">
        <section class="shopping-cart">
            <h1 class="heading">previous purchase</h1>
            <table>
                <thead>
                    <th>image</th>
                    <th>name</th>
                    <th>price</th>
                </thead>
                <!-- Return Prodcts From Database -->
                <tbody>
                    <?php
                    $email = $_SESSION['email'] ?? '';

                    $name = str_replace('.', '_', $email);

                    $data = $_COOKIE[$name] ?? [];

                    $data = !empty($data) ? json_decode($data, true) : [];

                    foreach ($data as $item) {
                        echo '<tr>
               <td><img src="uploaded_img/' . $item['image'] . '" alt="" height="100"></td>
               <td>' . $item['name'] . '</td><td>' . (number_format($item['price'])) . '</td>
           </tr>';
                    }
                    ?>


                </tbody>
            </table>
        </section>

    </div>































    <script src="js/script.js"></script>
</body>

</html>