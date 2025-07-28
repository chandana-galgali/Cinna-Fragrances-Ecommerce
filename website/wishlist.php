<?php
session_start();

if ($_SESSION['aid'] < 0) {
    header("Location: login.php");
}

if (isset($_GET['re'])) {
    include("include/connect.php");
    $aid = $_SESSION['aid'];
    $pid = $_GET['re'];
    $query = "DELETE FROM wishlist WHERE aid = $aid and pid = $pid";

    $result = mysqli_query($con, $query);
    header("Location: wishlist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cinna Fragrances - Wishlist</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="styles.css" />
    <script>
        window.addEventListener("beforeunload", function() {
            // Call a PHP script to log out the user
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "logout.php", false);
            xhr.send();
        });
    </script>
    <style>
        /* Wishlist Table Styling */
        #cart {
            width: 80%;
            margin: 30px auto;
            background-color: #1d1e22;
            color: #ffd700;
            border: 1px solid #ffd700;
            border-radius: 10px;
            padding: 20px;
        }

        #cart table {
            width: 100%;
            border-collapse: collapse;
        }

        #cart th, #cart td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ffd700;
        }

        #cart th {
            font-size: 18px;
            background-color: #1d1e22;
            color: #ffd700;
        }

        #cart td {
            font-size: 16px;
        }

        #cart td img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }

        #cart td a {
            color: #ffd700;
            text-decoration: none;
            font-size: 20px;
        }

        #cart td a:hover {
            color: #e0b500;
        }
    </style>
</head>

<body>
    <section id="header">
        <a href="index.php"><img src="img/logo.png" class="logo" alt="Cinna Fragrances Logo" height="65" width="50" style="margin-right: 3px;" /></a>
        <h3 style="font-size: 30px; margin-left: 10px;">Cinna Fragrances</h3>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>

                <?php
                if ($_SESSION['aid'] < 0) {
                    echo "<li><a href='login.php'>Login</a></li>
                          <li><a href='signup.php'>Sign Up</a></li>";
                } else {
                    echo "<li><a href='profile.php'>Profile</a></li>";
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
        <h2 style="text-align: left;">Your Wishlist</h2>
        <p style="text-align: left;">Discover your saved fragrances and add them to your collection.</p>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include("include/connect.php");

                $aid = $_SESSION['aid'];
                $query = "SELECT * FROM wishlist JOIN products ON wishlist.pid = products.pid WHERE aid = $aid";
                $result = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $pid = $row['pid'];
                    $pname = $row['pname'];
                    $price = $row['price'];
                    $img = $row['img'];
                    echo "
                        <tr>
                            <td><a href='wishlist.php?re=$pid'><i class='far fa-times-circle'></i></a></td>
                            <td><img src='product_images/$img' alt='$pname' /></td>
                            <td>$pname</td>
                            <td class='pr'>$$price</td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
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