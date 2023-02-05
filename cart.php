<?php
@include 'config.php';
// update the quantity
if (isset($_POST['update_update_btn'])) {

    $update_value = $_POST['update_quantity'];

    $update_id = $_POST['update_quantity_id'];

    $update_quantity_query = mysqli_query($mysqli, "UPDATE `cart` SET quantity = '$update_value' WHERE id='$update_id' ");
    if ($update_quantity_query) {
        header('location:cart.php');
    };
};
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
            <?php
            $select_rows = mysqli_query($mysqli, "SELECT * FROM `cart`") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);
            ?>
            <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span></a>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>
    </header>
    <div class="container">
        <section class="shopping-cart">
            <h1 class="heading">shopping cart</h1>
            <table>
                <thead>
                    <th>image</th>
                    <th>name</th>
                    <th>price</th>
                    <th>quantity</th>
                    <th>total price</th>
                    <th>action</th>
                </thead>
                <!-- Return Prodcts From Database -->
                <tbody>
                    <?php
                    $select_cart = mysqli_query($mysqli, "SELECT * FROM `cart`");
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                    ?>
                            <tr>
                                <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="" height="100"></td>
                                <td><?php echo $fetch_cart['name']; ?></td>
                                <td>$<?php echo number_format($fetch_cart['price']); ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                                        <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                                        <input type="submit" value="update" name="update_update_btn">
                                    </form>
                                </td>
                                <td>$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
                                <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"><i class="fas fa-trash"> remove</i></a></td>
                                <!-- End -->
                            </tr>
                    <?php
                            $grand_total += $sub_total;
                        };
                    };
                    ?>
                    <tr class="table-bottom">
                        <td><a href="products.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
                        <td colspan="3">Total</td>
                        <td>$<?php echo $grand_total; ?></td>
                        <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all ?');" class="delete-btn"><i class="fas fa-trash"></i> delete all</a></td>

                    </tr>
                </tbody>
            </table>
            <div class="checkout-btn">
                <!-- الشرط يبين للمستخدم الزر اذا فيه سلع -->
                <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">procced to checkout</a>
            </div>
        </section>

    </div>































    <script src="js/script.js"></script>
</body>

</html>