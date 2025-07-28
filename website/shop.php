<?php
session_start();
include("include/connect.php");
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
    .search-container {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #DBA858; /* Darker background */
        padding: 10px;
        color: #031B28;
    }

    #category-filter,
    #search {
        padding: 6px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff; /* Light background for readability */
        color: #000; /* Dark text for contrast */
    }

    #search-btn {
        outline: none;
        border: none;
        padding: 10px 20px;
        background-color: #031B28; /* Lighter blue */
        color: #DBA858; /* White text for contrast */
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }

    #search-btn:hover {
        background-color: #3d7ed6; /* Darker blue on hover */
    }
    .pro-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .pro {
        border: 1px solid #ccc;
        padding: 15px;
        background-color: #112233;
        border-radius: 8px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .pro:hover {
        transform: scale(1.05);
    }

    .pro img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .des h5 {
        margin: 10px 0;
        font-size: 18px;
    }

    .star i {
        color: #f0c14b;
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
                <li><a class="active" href="shop.php">Shop</a></li>
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

    <section id="page-header" style="text-align: left;">
        <h2>Premium Fragrances</h2>
        <p>Save more with Coupons & up to 70% off!</p>
    </section>

    <div class="search-container">
        <form id="search-form" method="post">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search">
            <label for="category-filter">Category:</label>
            <select id="category-filter" name="cat">
                <option value="all">All</option>
                <option value="floral">Floral</option>
                <option value="woody">Woody</option>
                <option value="citrus">Citrus</option>
                <option value="oriental">Oriental</option>
                <option value="fresh">Fresh</option>
            </select>
            <button type="submit" id="search-btn" name="search1">Search</button>
        </form>
    </div>

    <?php
    if (isset($_POST['search1'])) {
        $search = $_POST['search'];
        $category = $_POST['cat'];

        // Construct the base query
        $query = "SELECT * FROM `products` WHERE qtyavail > 0";

        // Add category filter if it's not "all"
        if ($category != "all") {
            $query .= " AND category = '$category'";
        }

        // Add search filter if provided
        if (!empty($search)) {
            $query .= " AND (pname LIKE '%$search%' OR brand LIKE '%$search%' OR description LIKE '%$search%')";
        }

        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<section id='product1' class='section-p1'>
                    <div class='pro-container'>";
            
            while ($row = mysqli_fetch_assoc($result)) {
                $pid = $row['pid'];
                $pname = strlen($row['pname']) > 35 ? substr($row['pname'], 0, 35) . '...' : $row['pname'];
                $desc = $row['description'];
                $price = $row['price'];
                $img = $row['img'];
                $brand = $row['brand'];

                // Get average rating
                $query2 = "SELECT AVG(rating) AS average_rating FROM reviews WHERE pid = $pid";
                $result2 = mysqli_query($con, $query2);
                $row2 = mysqli_fetch_assoc($result2);
                $stars = $row2 ? round($row2['average_rating'], 0) : 0;
                $empty = 5 - $stars;

                echo "
                    <div class='pro' onclick='topage($pid)'>
                      <img src='product_images/$img' height='235px' width='235px' alt='' />
                      <div class='des'>
                        <span>$brand</span>
                        <h5>$pname</h5>
                        <div class='star'>";
                for ($i = 1; $i <= $stars; $i++) {
                    echo "<i class='fas fa-star'></i>";
                }
                for ($i = 1; $i <= $empty; $i++) {
                    echo "<i class='far fa-star'></i>";
                }
                echo "</div>
                        <h4>$$price</h4>
                      </div>
                      <a onclick='topage($pid)'><i class='fal fa-shopping-cart cart'></i></a>
                    </div>";
            }

            echo "</div></section>";
        }
    } else {
        // Display all products if no search/filter is applied
        $select = "SELECT * FROM products WHERE qtyavail > 0 ORDER BY RAND()";
        $result = mysqli_query($con, $select);

        if ($result) {
            echo "<section id='product1' class='section-p1'>
                    <div class='pro-container'>";

            while ($row = mysqli_fetch_assoc($result)) {
                $pid = $row['pid'];
                $pname = strlen($row['pname']) > 35 ? substr($row['pname'], 0, 35) . '...' : $row['pname'];
                $price = $row['price'];
                $img = $row['img'];
                $brand = $row['brand'];

                // Get average rating
                $query2 = "SELECT AVG(rating) AS average_rating FROM reviews WHERE pid = $pid";
                $result2 = mysqli_query($con, $query2);
                $row2 = mysqli_fetch_assoc($result2);
                $stars = $row2 ? round($row2['average_rating'], 0) : 0;
                $empty = 5 - $stars;

                echo "
                    <div class='pro' onclick='topage($pid)'>
                      <img src='product_images/$img' height='235px' width='235px' alt='' />
                      <div class='des'>
                        <span>$brand</span>
                        <h5>$pname</h5>
                        <div class='star'>";
                for ($i = 1; $i <= $stars; $i++) {
                    echo "<i class='fas fa-star'></i>";
                }
                for ($i = 1; $i <= $empty; $i++) {
                    echo "<i class='far fa-star'></i>";
                }
                echo "</div>
                        <h4>$$price</h4>
                      </div>
                      <a onclick='topage($pid)'><i class='fal fa-shopping-cart cart'></i></a>
                    </div>";
            }

            echo "</div></section>";
        }
    }
    ?>

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
    function topage(pid) {
        window.location.href = `sproduct.php?pid=${pid}`;
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