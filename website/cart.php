<?php
session_start();

if ($_SESSION['aid'] < 0) {
    header("Location: login.php");
}

if (isset($_GET['re'])) {
    include("include/connect.php");
    $aid = $_SESSION['aid'];
    $pid = $_GET['re'];
    $query = "DELETE FROM CART WHERE aid = $aid and pid = $pid";

    $result = mysqli_query($con, $query);
    header("Location: cart.php");
    exit();
}

if (isset($_POST['check'])) {
    include("include/connect.php");

    $aid = $_SESSION['aid'];

    $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

    $result = mysqli_query($con, $query);

    $result2 = mysqli_query($con, $query);
    $row2 = mysqli_fetch_assoc($result2);

    if (empty($row2['pid'])) {
        header("Location: shop.php");
        exit();
    }

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

        $newqty = $_POST["$pid-qt"];

        $query = "UPDATE CART SET cqty = $newqty where aid = $aid and pid = $pid";

        mysqli_query($con, $query);


    }
    header("Location: checkout.php");
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
            background: #031B28;
            color: #DBA858;
        }

        /* Product Container */
        #cart {
            display: flex;
            justify-content: center;
            padding: 20px;
            gap: 40px;
            background-color: #031B28;
        }

        #cart .image-container {
            width: 220px;
            height: auto;
            margin-right: 40px;
            flex-shrink: 0;
        }

        #cart .image-container img {
            width: 100%;
            height: auto;
            max-height: 300px;
            border-radius: 10px;
        }

        #cart .details-container {
            max-width: 550px;
            color: #DBA858;
        }

        #cart .details-container h1 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        #cart .details-container h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        #cart .details-container p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        /* Quantity Input Styling */
        #cart input[type="number"] {
            width: 60px;
            padding: 5px;
            text-align: center;
            border: 1px solid #DBA858;
            border-radius: 5px;
            background-color: #031B28;
            color: #DBA858;
        }

        /* Add to Cart Button */
        #cart .add-to-cart-btn {
            background-color: #DBA858;
            color: #031B28;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        #cart .add-to-cart-btn:hover {
            background-color: #e0b500;
        }

        /* Cart Table Styling */
        #cart table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #031B28;
            align-items: center;
            text-align: center;
        }

        #cart table, #cart th, #cart td {
            border: 1px solid #DBA858;
            text-align: center;
            color: #DBA858;
            align-items: center;
            text-align: center;
        }

        #cart th, #cart td {
            padding: 10px;
            font-size: 16px;
            align-items: center;
            text-align: center;
        }

        /* Fixed Image Size in Table */
        #cart td img {
            width: 100px; /* Fixed width for images */
            height: auto;
            max-height: 120px; /* Ensures image doesn't exceed this height */
            border-radius: 5px;
        }

        /* Totals Section */
        #cart-add {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            background-color: #e0b500;
        }

        #cart-add #subtotal {
            background-color: #031B28;
            color: #DBA858;
            padding: 20px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            border-radius: 10px;
            border: 1px solid #DBA858;
        }

        /* Cart Totals Section Styling */
        #cart-add #subtotal h3, #cart-add #subtotal td {
            color: #DBA858;
            text-align: center;
        }

</style>
</head>

<body onload="totala()">
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
                    <a class="active" href="cart.php"><i class="far fa-shopping-bag"></i></a>
                </li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="page-header" class="about-header">
        <h2>Premium Fragrances</h2>
        <p>Save more with Coupons & up to 70% off!</p>
    </section>


    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>

                <?php

                include("include/connect.php");

                $aid = $_SESSION['aid'];

                $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

                $result = mysqli_query($con, $query);


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
                    echo "

            <tr>
              <td>
                <a href='cart.php?re=$pid'><i class='far fa-times-circle'></i></a>
              </td>
              <td><img src='product_images/$img' alt='' /></td>
              <td>$pname</td>
              <td class='pr'>$$price</td>
              <td><input type='number' class = 'aqt' value='$cqty' min = '1' max = '$qty' onchange='subprice()' /></td>
              <td class = 'atd'>$$a</td>
            </tr>
            ";
                }
                ?>

            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1" style="background-color: #031B28;">
        <div id="coupon">

        </div>
        <div id="subtotal">
            <h3>Cart Totals</h3><br>
            <center>
            <table>
                <tr>
                    <td>Cart SubTotal</td>
                    <td id='tot1' onload="totala()">$</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td id='tot' onload="totala()"><strong>$</strong></td>
                </tr>
            </table>
            </center>

            <form method="post">
                <?php

                include("include/connect.php");

                $aid = $_SESSION['aid'];

                $query = "SELECT * FROM cart JOIN products ON cart.pid = products.pid WHERE aid = $aid";

                $result = mysqli_query($con, $query);


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
                    echo "

              <input style='display: none;' name='$pid-p' class='inp' type = 'number' value = '$pid'/>
              <input style='display: none;' name='$pid-qt' class='inq' type = 'number' value = '$cqty'/>
              ";
                }
                ?><br>
                <button class="normal" name="check">Proceed to Checkout!</button>
            </form>
            </a>
        </div>
    </section>

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
function subprice() {
    var qty = document.getElementsByClassName("aqt");
    var sub = document.getElementsByClassName("atd");
    var pri = document.getElementsByClassName("pr");
    var upd = document.getElementsByClassName("inq");

    for (var i = 0; i < qty.length; i++) {
        var quantity = parseInt(qty[i].value);
        var price = parseFloat(pri[i].innerText.replace('$', ''));
        sub[i].innerHTML = `$${quantity * price}`;
        upd[i].value = parseInt(qty[i].value);
    }

    totala();
}

function totala() {
    var pri = document.getElementsByClassName("atd");
    let yes = 0;
    for (var i = 0; i < pri.length; i++) {
        yes = yes + parseFloat(pri[i].innerText.replace('$', ''));
    }


    document.getElementById('tot').innerHTML = '$' + yes;
    document.getElementById('tot1').innerHTML = '$' + yes;
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