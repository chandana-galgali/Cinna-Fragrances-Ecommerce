<?php
session_start();
include('cookie_consent.php');

if (empty($_SESSION['aid'])) {
    $_SESSION['aid'] = -1;
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
    .fe-box img {
    width: 270px; /* Adjust to your preferred size */
    height: 160px; /* Adjust to your preferred size */
    object-fit: cover; /* Keeps the aspect ratio within the specified dimensions */
    }

    #banner {
    background-color: #DBA858;
    padding: 40px;
    text-align: center;
    }

    #banner h4, #banner h2 {
        color: #031B28;
        margin: 0;
    }

    #banner button {
        padding: 12px 25px;
        border: none;
        background-color: #031B28;
        color: #DBA858;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        border-radius: 4px;
    }

    #sm-banner {
    display: flex;
    flex-wrap: wrap; /* Ensures responsiveness */
    gap: 10px; /* Adds space between the boxes */
    padding: 20px;
    justify-content: center; /* Centers the content within the container */
    }

    .banner-box {
        flex: 1 1 45%; /* Adjust width to about 45% for two boxes side by side */
        max-width: 45%; /* Ensures the boxes don’t grow beyond 45% */
        padding: 30px;
        background-color: #F4E3C1;
        color: #031B28;
        text-align: center;
        border-radius: 10px;
        box-sizing: border-box; /* Ensures padding doesn’t affect width */
    }

    .banner-box button {
        padding: 10px 20px;
        background-color: #031B28;
        color: #DBA858;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    @media (max-width: px) {
        #sm-banner {
            flex-direction: column; /* Stacks the boxes vertically on smaller screens */
        }
    }

    #banner3 {
    display: flex;
    gap: 20px; /* Adds space between the boxes */
    padding: 40px 0;
    justify-content: center;
    background-color: #031B28;
    }

    .banner-box {
        flex: 1;
        max-width: 30%; /* Ensures each box takes up approximately one-third of the row */
        padding: 40px;
        background-color: #F4E3C1;
        color: #031B28;
        text-align: center;
        border-radius: 10px;
        box-sizing: border-box;
        min-height: 200px; /* Sets a uniform height */
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .banner-box h2 {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
    }

    .banner-box h3 {
        margin: 10px 0 0 0;
        font-size: 20px;
        color: #B08B57;
    }

    @media (max-width: 768px) {
        #banner3 {
            flex-direction: column;
        }
        .banner-box {
            max-width: 100%;
            min-height: auto; /* Removes fixed height on smaller screens */
            margin-bottom: 20px; /* Adds spacing between stacked boxes */
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
                <li><a class="active" href="index.php">Home</a></li>
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

    <section id="hero">
    <h4>Exclusive Offer</h4>
        <h2 style="color: #ffffff;">Discover Luxurious Scents</h2>
        <h1 style="color: #ffffff;">For Every Moment</h1>
        <p>Enjoy up to 70% off on selected items!</p>
        <a href="shop.php">
            <button style="color: #ffffff;">Shop Now</button>
        </a>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/features/free_shipping.png" alt="Free Shipping" />
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/online_order.png" alt="Online Order" />
            <h6>Online Order</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/save_money.png" alt="Save Money" />
            <h6>Save on Perfumes</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/promotions.png" alt="Promotions" />
            <h6>Special Promotions</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/secure_payment.png" alt="Secure Payment" />
            <h6>Secure Payment</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/support.png" alt="24/7 Support" />
            <h6>24/7 Support</h6>
        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4 style="color: #031B28;">Summer Collection</h4><br>
        <h2 style="color: #031B28;">Up to 70% OFF - Premium Fragrances</h2><br>
        <a href="shop.php">
            <button class="normal" style="background-color: #031B28; color:#DBA858">Explore More</button>
        </a>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box" style="background-image: url('img/banner/b2.jpg');">
            <h4 style="color: #031B28;">Exclusive Deals</h4><br>
            <h2 style="color: #031B28;">Buy a combo, get a free gift</h2><br>
            <span style="color: #031B28;">Explore classic fragrances on sale at Cinna Fragrances</span><br><br>
            <a href="shop.php">
                <button class="white">Learn More</button><br>
            </a>
        </div>
        <div class="banner-box" style="background-image: url('img/banner/b3.jpg'); margin-top: 40px;">
            <h4 style="color: #031B28; text-align: center;">Coming This Week</h4><br>
            <h2 style="color: #031B28; text-align: center;">Winter Collection</h2><br>
            <span style="color: #031B28; text-align: center;">Discover new arrivals at Cinna Fragrances</span><br><br>
            <a href="shop.php">
                <button class="white">Browse Collection</button><br>
            </a>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box" style="background-image: url('img/banner/b4.jpg');">
            <h2>Signature Collection</h2>
            <h3>25% OFF</h3>
        </div>
        <div class="banner-box banner-box2" style="background-image: url('img/banner/b5.jpg');">
            <h2>Limited Edition</h2>
            <h3>30% OFF</h3>
        </div>
        <div class="banner-box banner-box3" style="background-image: url('img/banner/b6.jpg');">
            <h2>Holiday Specials</h2>
            <h3>50% OFF</h3>
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
    <script>
        window.addEventListener("beforeunload", function() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "logout.php", false);
            xhr.send();
        });
    </script>
</body>

</html>