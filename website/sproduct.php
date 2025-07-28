<?php
session_start();

if (isset($_POST['submit'])) {
  include("include/connect.php");
  $pid = $_GET['pid'];
  $aid = $_SESSION['aid'];
  $qty = $_POST['qty'];

  if ($aid < 0) {
    header("Location: login.php");
    exit();
  }

  $query = "select * from `cart`  where aid = $aid and pid = $pid";

  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);

  if ($row) {
    echo "<script> alert('item already added to cart') </script>";

    header("Location: cart.php");
    exit();
  } else {

    $query = "INSERT INTO `cart` (aid, pid, cqty) values ($aid, $pid, $qty)";
    $result = mysqli_query($con, $query);
    header("Location: shop.php");
    exit();
  }

}
if (isset($_GET['w'])) {
  include("include/connect.php");
  $aid = $_SESSION['aid'];
  if ($aid < 0) {
    header("Location: login.php");
    exit();
  }
  $pid = $_GET['w'];

  $query = "INSERT INTO `WISHLIST` (aid, pid) values ($aid, $pid)";

  $result = mysqli_query($con, $query);
  header("Location: sproduct.php?pid=$pid");
  exit();
}
if (isset($_GET['nw'])) {
  include("include/connect.php");
  $aid = $_SESSION['aid'];
  $pid = $_GET['nw'];

  $query = "DELETE from `WISHLIST` where aid = $aid and pid = $pid";

  $result = mysqli_query($con, $query);
  header("Location: sproduct.php?pid=$pid");
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

/* Header and Navigation */
#header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
}

/* Product Details Section */
#prodetails {
    display: flex;
    gap: 30px; /* Increased space between image and details */
    margin-top: 30px; /* Space above the product details section */
}

.single-pro-image {
    flex: 1;
}

.single-pro-details {
    flex: 2;
    padding: 20px; /* Padding around product details */
    background-color: #031B28; /* Darker gray background for product details */
    border-radius: 8px; /* Rounded corners */
    color: #031B28;
}

.single-pro-details h4 {
    margin-top: 10px;
    font-size: 20px; /* Increased font size for emphasis */
    color: #031B28;
}

.single-pro-details span {
    display: block;
    margin-top: 10px;
    font-size: 16px; /* Consistent font size for product description */
    color: #031B28;
}

/* Buttons */
.insert-btn, #search-btn {
    background-color: #DBA858; /* Gold for buttons */
    color: #031B28; /* Dark navy text for contrast */
    padding: 10px 20px; /* Added padding for larger buttons */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px; /* Space above buttons */
    transition: background-color 0.3s ease; /* Smooth transition on hover */
}

.insert-btn:hover, #search-btn:hover {
    background-color: #b88a4a; /* Darker gold on hover */
    color: #ffffff; /* White text on hover for better contrast */
}

/* Review Section */
.rev {
    margin: 70px;
}

.tb {
    max-height: 400px;
    overflow-x: auto;
    overflow-y: auto;
    background-color: #031B28; /* Darker gray for table background */
    border-radius: 8px; /* Rounded corners */
    padding: 20px; /* Padding around the table */
}

.tb tr {
    height: 60px;
}

.tb td {
    text-align: center;
    padding: 10px;
    border-bottom: 1px solid #95a5a6; /* Light border for rows */
}

.tb th {
    background-color: #DBA858; /* Gold for header */
    color: #031B28; /* Dark navy for header text */
}

/* Responsive Styles */
@media (max-width: 768px) {
    #header {
        flex-direction: column;
        align-items: flex-start;
    }

    #navbar {
        flex-direction: column;
        width: 100%;
        gap: 10px;
    }

    footer {
        flex-direction: column;
        align-items: center;
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
        <li><a class="active" href="shop.php">Shop</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>

        <?php

        if ($_SESSION['aid'] < 0) {
          echo "   <li><a href='login.php'>Login</a></li>
            <li><a href='signup.php'>SignUp</a></li>
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

  <?php
  include("include/connect.php");

  if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $query = "SELECT* FROM PRODUCTS WHERE pid = $pid";

    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    $pidd = $row['pid'];
    $pname = $row['pname'];

    $desc = $row['description'];
    $qty = $row['qtyavail'];
    $price = $row['price'];
    $cat = $row['category'];
    $img = $row['img'];
    $brand = $row['brand'];

    $aid = $_SESSION['aid'];
    $query = "select * from wishlist where aid = $aid and pid = $pid";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);


    echo "
      <section id='prodetails' class='section-p1'>
        <div class='single-pro-image'>
          <img src='product_images/$img' width='100%' id='MainImg' alt=' ' />
        </div>
        <div class='single-pro-details'>
        
          <h2>$pname</h2>
          <h4>$cat - $brand</h4>
          <h4>$$price</h4>
          <form method='post'>
          <input type='number' name='qty' value='1' min='1' max='$qty' style='margin-right:20px;'/>
          <button class='normal' name='submit'>Add to Cart</button>";

    if ($row)
      echo "<a  class ='heart' href='sproduct.php?nw=$pid'><img src='img/full.png' style='
            margin-left: 20px; margin-top: 20px; width='40px' height='40px'   alt=' ' /></a>";
    else
      echo "<a class ='heart' href='sproduct.php?w=$pid'><img src='img/empty.png' style='
            margin-left: 20px; margin-top: 10px; width='40px' height='40px'  alt=' ' /></a>";

            echo "
            </form><br>
            <h4>Product Details</h4>
            <span>$desc
            </span>";

  echo "</div></section>";
}

$query = "select * from reviews join orders on reviews.oid = orders.oid join accounts on orders.aid = accounts.aid where reviews.pid = $pid";
$result = mysqli_query($con, $query);

$row = mysqli_fetch_assoc($result);

if (!empty($row))
{
  $result = mysqli_query($con, $query);

echo "
<div class = 'rev'>
<h2>Reviews</h2>
<div class='tb'>
<table><thead><tr><th>username</th>
<th style='min-width: 100px;'>rating</th>
<th>text</th></thead><tbody>";

while ($row = mysqli_fetch_assoc($result)) {
  $user = $row['username'];
  $rtext = $row['rtext'];
  $stars = $row['rating'];

  $empty = 5 - $stars;

  echo "<tr><td>$user</td>
           
            <td style='min-width: 200px;'><div class='star' >";
  for ($i = 1; $i <= $stars; $i++) {
    echo "<i class='fas fa-star'></i>";

  }
  for ($i = 1; $i <= $empty; $i++) {
    echo "<i class='far fa-star'></i>";

  }
  echo "</div></td>
            <td><span>$rtext<span></td></tr>";
}

echo "</tbody></table></div></div>";

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

  <script>
    var MainImg = document.getElementById("MainImg");
    var smallimg = document.getElementsByClassName("small-img");

    smallimg[0].onclick = function () {
      MainImg.src = smallimg[0].src;
    };
    smallimg[1].onclick = function () {
      MainImg.src = smallimg[1].src;
    };
    smallimg[2].onclick = function () {
      MainImg.src = smallimg[2].src;
    };
    smallimg[3].onclick = function () {
      MainImg.src = smallimg[3].src;
    };
  </script>
  <script src="script.js"></script>
</body>

</html>

<script>
    window.addEventListener("unload", function () {
      // Call a PHP script to log out the user
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "logout.php", false);
      xhr.send();
    });
  </script>