<?php
session_start();
include("include/connect.php");

if (isset($_POST['submit'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username == "admin") {

    $query = "select * from accounts where username='$username' and password='$password'";
    $result = mysqli_query($con, $query);


    if (mysqli_num_rows($result) > 0) {
      echo "<script> window.open('inventory.php', '_blank') </script>";


    } else {
      echo "<script> alert('Wrong credentials') </script>";
    }

  } else {
    echo "<script> alert('Wrong credentials') </script>";
  }
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
    <link rel="stylesheet" href="styles.css" />
    <style>
        /* Container for the login form */
        #form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
            padding: 20px;
        }

        #form {
            background-color: #031B28;
            border: 1px solid #DBA858;
            border-radius: 8px;
            padding: 20px 30px;
            width: 320px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        #form h3 {
            color: #DBA858;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .input1 {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #DBA858;
            border-radius: 4px;
            background-color: #031B28;
            color: #DBA858;
        }

        .input1::placeholder {
            color: #DBA858;
            opacity: 0.8;
        }

        .btn {
            padding: 10px 20px;
            background-color: #DBA858;
            color: #031B28;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .btn:hover {
            background-color: #E3E6F3;
            color: #031B28;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
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
                <li><a class="active" href="admin.php">Admin</a></li>
                <li id="lg-bag">
                    <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
                </li>
            </ul>
        </div>
    </section>

    <!-- Login Form Section -->
    <div id="form-container">
        <form method="post" id="form">
            <h3>Admin Login</h3>
            <input class="input1" id="user" name="username" type="text" placeholder="Username *">
            <input class="input1" id="pass" name="password" type="password" placeholder="Password *">
            <button type="submit" class="btn" name="submit">Login</button>
        </form>
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