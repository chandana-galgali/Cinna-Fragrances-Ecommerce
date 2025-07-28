<?php
session_start();
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
    .paragraph {
        line-height: 1.5;
    }

    .fe-box img {
    width: 270px; /* Adjust to your preferred size */
    height: 160px; /* Adjust to your preferred size */
    object-fit: cover; /* Keeps the aspect ratio within the specified dimensions */
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
                <li><a class="active" href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>

                <?php
                if ($_SESSION['aid'] < 0) {
                    echo "   <li><a href='login.php'>Login</a></li>
                             <li><a href='signup.php'>Sign Up</a></li>";
                } else {
                    echo "   <li><a href='profile.php'>Profile</a></li>";
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

    <section id="page-header" class="about-header" style="text-align: left;">
        <h2>#EmbraceTheAroma</h2>
        <p>Where Elegance Meets the Essence of Fragrance</p>
    </section>

    <section id="about-head" class="section-p1">
    <center><img src="img/about/fragrance.jpg" alt="Fragrance Collection" width="700" style="margin-bottom: 10px; text-align: center;"/>
    <div>
        <center><h3>About Us</h3><center>
        <p class="paragraph" style="text-align: justify;">
            Welcome to Cinna Fragrances, your gateway to the world of luxurious and unforgettable scents. Founded with a profound appreciation for the art of perfumery, Cinna Fragrances is devoted to crafting olfactory experiences that leave a lasting impression. Our journey began with a simple belief: fragrance is more than just a scent—it is a powerful force that evokes memories, enhances emotions, and becomes a personal signature. We are passionate about creating exquisite fragrances that inspire and captivate.
            <br><br>
            Each fragrance in our collection is a labor of love, meticulously blended using the finest raw materials from around the globe. Our perfumers draw inspiration from nature, art, and cultures across continents, carefully balancing each ingredient to create scents that are both timeless and contemporary. From the first spritz, our perfumes transport you to exotic landscapes, lush gardens, and ancient forests. Whether you prefer floral, woody, spicy, or fresh notes, our collection has something that will resonate with your unique personality.
            <br><br>
            At Cinna Fragrances, we understand that a scent can tell a story as vividly as a painting or a piece of music. Our fragrances are designed to accompany you through life’s moments, big and small. With each bottle, we invite you to express yourself, to feel confident, elegant, and empowered. We believe in the beauty of simplicity, and our fragrances are crafted to enhance your natural allure, not overpower it. Subtle, sophisticated, and evocative, each scent is a reminder of the finer things in life.
            <br><br>
            Committed to sustainability, we take great care to ensure that our ingredients are sourced ethically and responsibly. Our dedication to the environment extends beyond our products to our packaging, which is designed with recyclability and elegance in mind. We strive to be a brand that respects the earth while celebrating the art of fragrance. Step into the world of Cinna Fragrances, where every bottle is an invitation to explore, to feel, and to live beautifully.
        </p>
        <br /><br />
        <marquee bgcolor="#031B28" loop="-1" scrollamount="5" style="
        color: #DBA858; 
        font-size: 18px; 
        font-weight: bold; 
        padding: 10px 0;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
        background: linear-gradient(90deg, #031B28, #1A3A4B);
        border-top: 2px solid #DBA858;
        border-bottom: 2px solid #DBA858;
    ">
        ✨ Indulge in the Art of Perfumery with Cinna Fragrances ✨
    </marquee>
    </div>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/features/free_shipping.png" alt="Free Shipping" />
            <h6> Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/online_order.png" alt="Online Order" />
            <h6> Online Order</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/exclusive_discounts.png" alt="Exclusive Discounts" />
            <h6>Exclusive Discounts</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/premium_quality.png" alt="Premium Quality" />
            <h6>Premium Quality</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/ethically_sourced.png" alt="Ethically Sourced" />
            <h6>Ethically Sourced</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/support.png" alt="24/7 Support" />
            <h6> 24/7 Support</h6>
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
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>