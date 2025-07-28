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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="styles.css" />
    <style>
        /* Contact Details Section */
        #contact-details {
            padding: 60px 80px;
            display: flex;
            justify-content: space-between;
            color: #DBA858;
        }

        #contact-details .details {
            flex: 1;
            max-width: 50%;
        }

        #contact-details h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        #contact-details h3 {
            font-size: 20px;
            margin: 20px 0;
        }

        #contact-details li {
            list-style: none;
            margin: 15px 0;
            display: flex;
            align-items: center;
        }

        #contact-details li i {
            font-size: 20px;
            margin-right: 10px;
            color: #E3E6F3;
        }

        /* Map Styling */
        .map iframe {
            margin-left: 10px;
            width: 700px;
            height: 500px;
            border: none;
            border-radius: 8px;
        }

        /* Contact People Section */
        #form-details {
            padding: 40px 80px;
            background-color: #031B28;
        }

        #form-details .people {
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }

        #form-details .people div {
            text-align: center;
            color: #DBA858;
            padding: 20px;
            border: 1px solid #DBA858;
            border-radius: 8px;
        }

        #form-details .people img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        #form-details .people p {
            font-size: 16px;
        }

        #form-details .people span {
            font-weight: bold;
            font-size: 18px;
            display: block;
            margin-bottom: 5px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            #contact-details {
                flex-direction: column;
                padding: 20px;
            }

            #form-details .people {
                flex-direction: column;
            }

            footer {
                flex-direction: column;
                align-items: center;
                text-align: center;
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
                <li><a class="active" href="contact.php">Contact</a></li>

                <?php

                if ($_SESSION['aid'] < 0) {
                    echo "   <li><a href='login.php'>Login</a></li>
            <li><a href='signup.php'>Sign Up</a></li>
            ";
                } else {
                    echo "   <li><a href='Profile.php'>Profile</a></li>
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

    <!-- Page Header Section -->
    <section id="page-header" style="text-align: left;">
        <h2>#IndulgeInLuxury</h2>
        <p>Experience the finest fragrances for every occasion</p>
    </section>

    <!-- Contact Details Section -->
    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our boutiques or<br>contact us today</h2>
            <h3>Head Office</h3>
            <div>
                <li><i class="fal fa-map"></i><p>Marathon Cosmos, Mulund, Mumbai.</p></li>
                <li><i class="fal fa-envelope"></i><p>support@cinnafragrances.com</p></li>
                <li><i class="fal fa-phone-alt"></i><p>+91-9870776977</p></li>
                <li><i class="fal fa-clock"></i><p>Monday to Saturday: 9am - 6pm</p></li>
            </div>
        </div>
        <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3768.602311271162!2d72.93372307373929!3d19.16887774905311!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b85ac024b9a7%3A0x5e9a34f5e51e6502!2sMarathon%20Cosmos%2C%20Nirmal%20Lifestyle%20Zircon%2C%20off%20LBS%20Marg%2C%20Mulund%20(West)%2C%20Mumbai%2C%20Maharashtra%20400%20080%2C%20India%2C%20Marathon%20Ave%2C%20Moti%20Nagar%2C%20Mulund%20Colony%2C%20Mulund%20West%2C%20Mumbai%2C%20Maharashtra%20400082!5e0!3m2!1sen!2sin!4v1730825284114!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- Contact Team Section -->
    <section id="form-details">
        <div class="people">
            <div>
                <img src="img/people/founder.jpg" alt="" />
                <p>
                    <span>Cinna Ryams</span> Founder & CEO <br />
                    Phone: +1 800-234-5678 <br />
                    Email: cinna.r@cinnafrag.com
                </p>
            </div>
            <div>
                <img src="img/people/manager.jpg" alt="" />
                <p>
                    <span>James Dean</span> Marketing Manager <br />
                    Phone: +1 800-345-6789 <br />
                    Email: james@cinnafrag.com
                </p>
            </div>
            <div>
                <img src="img/people/support.jpg" alt="" />
                <p>
                    <span>Olivia White</span> Customer Service <br />
                    Phone: +1 800-456-7890 <br />
                    Email: olivia@cinnafrag.com
                </p>
            </div>
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