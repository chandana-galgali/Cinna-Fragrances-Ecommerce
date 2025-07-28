<?php
session_start();

if (isset($_POST['sub'])) {
    include("include/connect.php");

    $aid = $_SESSION['aid'];
    $add = $_POST['houseadd'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $acc = $_POST['acc'];
    $query = "";

    if (empty($acc)) {
        $query = "insert into `orders` (dateod, datedel, aid, address, city, country, account, total) values(CURDATE(), NULL, '$aid', '$add', '$city', '$country', NULL, 0)";
    } else {
        if (preg_match('/\D/', $acc) || strlen($acc) != 16) {
            echo "<script> alert('invalid account number'); setTimeout(function(){ window.location.href = 'checkout.php'; }, 100); </script>";
            exit();
        }

        $query = "insert into `orders` (dateod, datedel, aid, address, city, country, account, total) values(CURDATE(), NULL, '$aid', '$add', '$city', '$country', '$acc', 0)";
    }
    $result = mysqli_query($con, $query);

    $oid = mysqli_insert_id($con);

    $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

    $result = mysqli_query($con, $query);
    global $tott;
    while ($row = mysqli_fetch_assoc($result)) {
        $pid = $row['pid'];
        $pname = $row['pname'];
        $desc = $row['description'];
        $qty = $row['qtyavail'];
        $price = $row['price'];
        $cat = $row['category'];
        $img = $row['img'];
        $brand = $row['brand'];
        $cqty = $row['cqty'];
        $tott = $price * $cqty;

        $query = "insert into `order-details` (oid, pid, qty) values ($oid, $pid, $cqty)";

        mysqli_query($con, $query);

        $query = "update products set qtyavail = qtyavail - $cqty where pid = $pid";

        mysqli_query($con, $query);
    }

    $query = "delete from cart where aid = $aid";

    mysqli_query($con, $query);

    $query = "update orders set total = $tott where oid = $oid";

    mysqli_query($con, $query);


    header("Location: profile.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cinna Fragrances</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="styles.css" />

    <style>
/* Page Header */
#page-header {
    text-align: center;
    padding: 20px 0;
    background: #1d1e22;
    color: #DBA858;
    border-bottom: 1px solid #DBA858;
}

/* Form Styling */
.container {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
    background-color: #031B28;
    color: #DBA858;
    border: 1px solid #DBA858;
    border-radius: 10px;
}

.titlecheck h2 {
    text-align: center;
    color: #DBA858;
    margin-bottom: 20px;
}

.input11 {
    display: block;
    width: 90%;
    margin: 20px auto;
    padding: 10px;
    border: none;
    border-bottom: 2px solid #DBA858;
    background-color: #1d1e22;
    color: #DBA858;
    outline: none;
    font-size: 16px;
}

.input11:focus {
    border-bottom: 2px solid #e0b500;
}

/* Radio Button Styling */
.input2 {
    margin: 10px 0;
    font-size: 16px;
    cursor: pointer;
    color: #DBA858;
}

.input2 label {
    cursor: pointer;
}

.input2 input[type="radio"] {
    accent-color: #DBA858;
}

/* Button Styling */
.btn112 {
    display: block;
    width: 90%;
    margin: 20px auto;
    padding: 12px;
    font-size: 18px;
    font-weight: bold;
    color: #1d1e22;
    background-color: #DBA858;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn112:hover {
    background-color: #e0b500;
}

/* Order Summary Table */
.Yorder {
    margin-top: 20px;
    padding: 20px;
    background-color: #1d1e22;
    border: 1px solid #DBA858;
    border-radius: 10px;
    color: #DBA858;
}

.table12 {
    width: 100%;
    border-collapse: collapse;
}

.table12 th, .table12 td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #DBA858;
}

.table12 th {
    font-size: 18px;
}

.table12 td {
    font-size: 16px;
}

/* Responsive Styling */
@media (max-width: 768px) {
    .container, .Yorder, .btn112 {
        width: 100%;
        padding: 15px;
    }

    .input11 {
        width: 100%;
    }
}

    </style>

</head>

<body>
    <section id="header">
        <a href="index.php"><img src="img/logo.png" class="logo" alt="Cinna Fragrances Logo" height="65" width="50" style="margin-right: 3px;"/></a>
        <h3 style="font-size: 30px; margin-left: 10px;">Cinna Fragrances</h3>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>

                <?php

                if ($_SESSION['aid'] < 0) {
                    echo "   <li><a href='login.php'>Login</a></li>
            <li><a href='signup.php'>Sign Up</a></li>
            ";
                } else {
                    echo "   <li><a href='profile.php'>Profile</a></li>
          ";
                }
                ?>
                <li><a href="admin.php">Admin</a></li>
                <li id="lg-bag">
                    <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
                </li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <div class="container">
        <div class="titlecheck">
            <h2>Product Order Form</h2>
        </div>
        <div class="d-flex">
            <form method="post" id="form1">

                <h3 style="color: darkred; margin: auto"></h3>
                <input class="input11" type="text" name="houseadd" placeholder="Address" required>
                <input class="input11" type="text" name="city" placeholder="City" required>
                <input class="input11" type="text" name="country" placeholder="County/State" required>
                <input class="input11" id="account-field" type="text" name="acc" placeholder="Account Number">
                <div>
                    <input class="input2" type="radio" id="ac1" name="dbt" value="cod" onchange="showInputBox()"> Cash
                    on Delivery!
                </div>
                <div>
                    <input class="input2" type="radio" id="ac2" name="dbt" value="bank" checked
                        onchange="showInputBox()"> Paypal/Visa/MasterCard <span>
                        <img src="img/pay/pay.png" alt="">
                    </span>
                </div>
                <button name="sub" type="submit" class="btn112">Place Order</button>
            </form>
            <div class="Yorder">
                <table class="table12">
                    <tr class='tr1'>
                        <th class='th1' colspan='2'>Your order</th>
                    </tr>

                    <?php
                    include("include/connect.php");

                    $aid = $_SESSION['aid'];

                    $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

                    $result = mysqli_query($con, $query);

                    global $tot;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $pid = $row['pid'];
                        $pname = $row['pname'];
                        $desc = $row['description'];
                        $qty = $row['qtyavail'];
                        $price = $row['price'];
                        $cat = $row['category'];
                        $img = $row['img'];
                        $brand = $row['brand'];
                        $cqty = $row['cqty'];
                        $a = $price * $cqty;
                        $tot = $tot + $a;

                        echo "
            
            <tr class='tr1'>
              <td class='td1'>$pname x $cqty(Qty)</td>
              <td class='td1'>$a</td>
            </tr>

              ";
                    }
                    echo "
            <tr class='tr1'>
            <td class='td1'>Subtotal</td>
            <td class='td1'>$$tot.00</td>
          </tr>
          <tr class='tr1'>
            <td class='td1'>Shipping</td>
            <td class='td1'>Free shipping</td>
          </tr>";
                    ?>


                </table><br>
            </div><!-- Yorder -->
        </div>
    </div>

    <footer class="section-p1">
    <div class="col">
        <a href="index.php"><img src="img/logo.png" class="logo" alt="Cinna Fragrances Logo" height="105" width="90" style="margin-right: 3px;"/></a>
        <h3>Contact</h3>
        <p><strong>Address:</strong> Mumbai, Maharashtra, India.<br><br>
        <strong>Phone:</strong> +91-9870776977<br><br>
        <strong>Hours:</strong> Mon - Fri, 9am - 6pm</p>
    </div>

    <div class="col">
        <h4>My Account</h4>
        <a href="cart.php">View Cart</a>
        <a href="wishlist.php">My Wishlist</a>
        <a href="profile.php">Profile</a>
        <a href="admin.php">Admin</a>
    </div>

    <div class="col install">
        <h4>Secured Payment Gateways</h4>
        <img src="img/pay/payment_methods.png" alt="Payment Options" />
    </div>

    <div class="col social-icons">
        <h4>Follow Us</h4>
        <a href="#"><i class="fab fa-facebook-f">     Facebook</i></a>
        <a href="#"><i class="fab fa-twitter">     Twitter</i></a>
        <a href="#"><i class="fab fa-instagram">     Instagram</i></a>
        <a href="#"><i class="fab fa-linkedin-in">     LinkedIn</i></a>

    </div>

    <div class="copyright">
        <p>&copy; 2024. Cinna Fragrances. All rights reserved.</p>
    </div>
</footer>

    <script src="script.js"></script>
</body>

</html>

<script>
    function showInputBox() {
        var select = document.querySelector('#ac1');
        var inputBox = document.getElementById("account-field");
        if (!select.checked) {
            inputBox.style.display = "block";
        } else {
            inputBox.style.display = "none";
        }
    }
</script>

<script>
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>