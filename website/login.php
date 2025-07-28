<?php
session_start();

include("include/connect.php");

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";

    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);



        $_SESSION['aid'] = $row['aid'];



        header("Location: profile.php");
        exit();

    }
    else
    {
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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="styles.css" />
    <style>
        /* Login Form Container */
        #form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 200px);
            padding: 20px;
        }

        #form {
            background-color: #031B28;
            border: 1px solid #DBA858;
            border-radius: 8px;
            padding: 20px 30px;
            width: 350px;
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

        /* Link to Signup */
        .sign {
            text-align: center;
            margin-top: 20px;
        }

        .signn {
            color: #DBA858;
            text-decoration: none;
        }

        .signn:hover {
            color: #E3E6F3;
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
                <li><a class="active" href="login.php">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
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


    <!-- Login Form Section -->
    <div id="form-container">
        <form method="post" id="form">
            <h3>Login to Your Account</h3>
            <input class="input1" name="username" type="text" placeholder="Username *" required>
            <input class="input1" name="password" type="password" placeholder="Password *" required>
            <button type="submit" class="btn" name="submit">Login</button>
            <a href="signup.php" class="signn">Do not have an account?</a>
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

<script>
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>