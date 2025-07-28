<?php
session_start();

if (isset($_GET['lo'])) {
  $_SESSION['aid'] = -1;
  header("Location: index.php");
  exit();
}

if (isset($_POST['submit'])) {
  include("include/connect.php");
  $aid = $_SESSION['aid'];

  $firstname = $_POST['a1'];
  $lastname = $_POST['a2'];
  $email = $_POST['a3'];
  $phone = $_POST['a5'];
  $dob = $_POST['a6'];

  $query = "SELECT * FROM accounts WHERE (phone='$phone' OR email='$email') AND aid != $aid";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  if (!empty($row['aid'])) {
    echo "<script> alert('Credentials already exist!'); setTimeout(function(){ window.location.href = 'profile.php'; }, 10); </script>";
    exit();
  }
  if (strtotime($dob) > time()) {
    echo "<script> alert('Invalid date!'); setTimeout(function(){ window.location.href = 'profile.php'; }, 10); </script>";
    exit();
  }

  if (preg_match('/\D/', $phone) || strlen($phone) != 10) {
    echo "<script> alert('Invalid phone number!'); setTimeout(function(){ window.location.href = 'profile.php'; }, 10); </script>";
    exit();
  }

  $query = "UPDATE accounts SET afname = '$firstname', alname='$lastname', email='$email', phone='$phone', dob='$dob' WHERE aid = $aid";
  $result = mysqli_query($con, $query);
  header("Location: profile.php");
  exit();
}

if (isset($_POST['abc'])) {
  include("include/connect.php");

  // Enable error reporting for debugging
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // Verify that the connection is successful
  if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
  } else {
      echo "Connected to the database.<br>";
  }

  $oid = $_GET['odd'];
  echo "Order ID: $oid<br>";

  // Fetch the order details
  $query = "SELECT * FROM `order-details` WHERE oid = $oid";
  $result = mysqli_query($con, $query);

  if ($result) {
      // Loop through each product in the order
      while ($row = mysqli_fetch_assoc($result)) {
          $pid = $row['pid'];
          echo "Processing Product ID: $pid<br>";

          // Get the review text and rating from POST data
          $text = isset($_POST["$pid-te"]) ? $_POST["$pid-te"] : '';
          $star = isset($_POST["$pid-rating"]) ? $_POST["$pid-rating"] : null;

          // Show the retrieved text and rating values
          echo "Review Text: $text<br>";
          echo "Rating: $star<br>";

          // Only proceed if a rating has been selected
          if ($star !== null) {
              // Prepare the SQL query
              $query = empty($text)
                  ? "INSERT INTO `reviews` (oid, pid, rtext, rating) VALUES ($oid, $pid, NULL, $star)"
                  : "INSERT INTO `reviews` (oid, pid, rtext, rating) VALUES ($oid, $pid, '$text', $star)";
              
              // Execute the query and check for success
              if (mysqli_query($con, $query)) {
                  echo "Review successfully added for Product ID: $pid.<br>";
              } else {
                  echo "Error adding review for Product ID: $pid - " . mysqli_error($con) . "<br>";
              }
          } else {
              echo "No rating selected for Product ID: $pid.<br>";
          }
      }
  } else {
      echo "Error fetching order details: " . mysqli_error($con) . "<br>";
  }

  // Stop script execution to view debugging output
  exit();
}

if (isset($_POST['c'])) {
  header("Location: profile.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  echo '<pre>';
  print_r($_POST);  // Display the entire POST data
  echo '</pre>';
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cinna Fragrances - Profile</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="stylesheet" href="styles.css" />
  <style>
    /* Profile Sidebar */
    .sidenav {
      width: 220px;
      background-color: #1B263B;
      padding: 20px;
      color: #DBA858;
      border-radius: 10px;
      margin: 20px;
      float: left;
    }

    .sidenav .profile {
      text-align: center;
      margin-bottom: 20px;
    }

    .sidenav .name {
      font-size: 18px;
      font-weight: bold;
      color: #DBA858;
    }

    .sidenav .job {
      font-size: 14px;
      color: #DBA858;
    }

    .sidenav .btn.logup {
      background-color: #DBA858;
      color: #112233;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      display: block;
      width: 100%;
      margin: 10px 0;
      text-decoration: none;
    }

    .sidenav .btn.logup:hover {
      background-color: #DBA858;
    }

    /* Main Content */
    .main {
      margin-left: 260px;
      padding: 20px;
      color: #DBA858;
    }

    .main h2 {
      font-size: 24px;
      color: #DBA858;
      margin-bottom: 10px;
    }

    .card {
      background-color: #ffffff;
      border-radius: 10px;
      padding: 20px;
      color: #DBA858;
      margin-bottom: 20px;
    }

    .card-body table {
      width: 100%;
    }

    .card-body td {
      padding: 8px;
    }

    .card-body input[type="text"],
    .card-body input[type="date"],
    .card-body textarea {
      width: 95%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 15px;
    }

    .card-body .btn {
      padding: 10px 20px;
      background-color: #DBA858;
      color: #112233;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .card-body .btn:hover {
      background-color: #DBA858;
    }

    /* Order Table */
    .tb {
      max-height: 400px;
      overflow-y: auto;
      background-color: #1B263B;
      border-radius: 10px;
      color: #FFFFFF;
    }

    .tb th, .tb td {
      padding: 10px;
      text-align: left;
      color: #FFFFFF;
      border-bottom: 1px solid #DBA858;
    }

    .insert-btn {
      background-color: #DBA858;
      color: #112233;
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .insert-btn:hover {
      background-color: #DBA858;
    }
    
    /* Rating */
    .rating label.checked {
    color: #ffc107; /* Gold color for selected stars */
  }

  .rating label {
    font-size: 24px;
    color: #ddd; /* Default color for unselected stars */
    cursor: pointer;
  }

  .rating input[type="radio"] {
    display: none; /* Hide the radio buttons */
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
          echo "   <li><a href='login.php'>login</a></li>
            <li><a  href='signup.php'>SignUp</a></li>
            ";
        } else {
          echo "   <li><a class='active'  href='profile.php'>Profile</a></li>
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

    <div class="navbar-top">
        <div class="title">
            <h1 style='font-size: 30px; margin-left: 70px;'>Profile</h1>
        </div>
        <!-- End -->
    </div>
    <!-- End -->

    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            <?php

      include("include/connect.php");

      $aid = $_SESSION['aid'];
      $query = "SELECT * FROM ACCOUNTS WHERE aid = $aid";

      $result = mysqli_query($con, $query);

      $row = mysqli_fetch_assoc($result);

      $afname = $row['afname'];
      $alname = $row['alname'];
      $phone = $row['phone'];
      $email = $row['email'];
      $dob = $row['dob'];
      $user = $row['username'];
      $gender = $row['gender'];
      $name = $afname . " " . $alname;

      echo "
      <div class='name'>
        $name
      </div>
      <div class='job'>
        Customer
      </div>
    </div>
    "
        ?>

            <div class="sidenav-url">
                <div class="url">
                    <a href='profile.php?lo=1' class="btn logup">Log Out</a>
                    <hr allign="center">
                </div>
                <div class="url">
                    <a href='profile.php?upd=1' class="btn logup">Update</a>
                    <hr allign="center">
                </div>
                <?php
        if (isset($_GET['odd'])) {
          echo "
                    <div class='url'>
                    <a href='profile.php' class='btn logup'>Cancel</a>
                    <hr align='center'>
                    </div>
                    ";
        }
        ?>
            </div>
        </div>
        <!-- End -->

        <!-- Main -->
        <div class="main">
            <h2>My Profile</h2>
            <div class="card">
                <div class="card-body">
                    <i class="fa fa-pen fa-xs edit"></i>
                    <table>
                        <tbody>
                            <?php


              if (isset($_GET['upd'])) {
                include("include/connect.php");

                $aid = $_SESSION['aid'];

                $query = "SELECT * FROM ACCOUNTS WHERE aid = $aid";

                $result = mysqli_query($con, $query);

                $row = mysqli_fetch_assoc($result);

                $afname = $row['afname'];
                $alname = $row['alname'];
                $phone = $row['phone'];
                $email = $row['email'];
                $dob = $row['dob'];
                $user = $row['username'];
                $gender = $row['gender'];

                echo "
              <form class='form1' method='post'>
              <tr>
                <td>First Name</td>
                <td>:</td>
                <td><input name='a1' type='text' value='$afname'></td>
              </tr>
              <tr>
                <td>Last Name</td>
                <td>:</td>
                <td><input name='a2' type='text' value='$alname'></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td><input name='a3' type='text' value='$email'></td>
              </tr>
              <tr>
              <td>Phone</td>
              <td>:</td>
              <td><input name='a5' type='text' value='$phone'></td>
              </tr>
              <tr>
              <td>Date of Birth</td>
              <td>:</td>
              <td><input name='a6' type='date' value='$dob'></td>
              </tr>
              <tr>
              <td><button name='submit' type='submit' class='btn' style='width: 50%;'>Submit</button></td>
              </tr>
              </form>
              ";
              } else {
                include("include/connect.php");

                $aid = $_SESSION['aid'];
                $query = "SELECT * FROM ACCOUNTS WHERE aid = $aid";

                $result = mysqli_query($con, $query);

                $row = mysqli_fetch_assoc($result);

                $afname = $row['afname'];
                $alname = $row['alname'];
                $phone = $row['phone'];
                $email = $row['email'];
                $dob = $row['dob'];
                $user = $row['username'];
                $gender = $row['gender'];
                $name = $afname . " " . $alname;
                echo "
              <tr>
                <td>First Name</td>
                <td>:</td>
                <td>$afname</td>
              </tr>
              <tr>
                <td>Last Name</td>
                <td>:</td>
                <td>$alname</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td>$email</td>
              </tr>
              <tr>
              <td>Phone</td>
              <td>:</td>
              <td>$phone</td>
              </tr>
              <tr>
              <td>Date OF Birth</td>
              <td>:</td>
              <td>$dob</td>
              </tr>
              <tr>
              <td>Username</td>
              <td>:</td>
              <td>$user</td>
              </tr>
              <tr>
              <td>Gender</td>
              <td>:</td>
              <td>$gender</td>
              </tr>
              ";
              }
              ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php
   
          if (isset($_GET['odd'])) {
            $oid = $_GET['odd'];
            $query = "SELECT * FROM `order-details` WHERE oid = $oid";
            $result = mysqli_query($con, $query);

            echo "<h2>Review</h2>
                  <div class='card'>
                      <div class='card-body'>
                          <form method='post'><table class='tb'><thead>
                          <tr><th>Name</th><th>Image</th><th>Price</th><th>Review</th><th>Rating</th></tr></thead><tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                $pid = $row['pid'];
                $productQuery = "SELECT * FROM products WHERE pid = $pid";
                $productResult = mysqli_query($con, $productQuery);
                $product = mysqli_fetch_assoc($productResult);

                echo "<tr>
                        <td>{$product['pname']}</td>
                        <td><img src='product_images/{$product['img']}' width='50' height='50'></td>
                        <td>{$product['price']}</td>
                        <td><textarea name='{$pid}-te'></textarea></td>
                        <td>
                            <fieldset class='rating'>
                                <input type='radio' id='{$pid}-rating1' name='{$pid}-rating' value='1'><label for='{$pid}-rating1'>&#9733;</label>
                                <input type='radio' id='{$pid}-rating2' name='{$pid}-rating' value='2'><label for='{$pid}-rating2'>&#9733;</label>
                                <input type='radio' id='{$pid}-rating3' name='{$pid}-rating' value='3'><label for='{$pid}-rating3'>&#9733;</label>
                                <input type='radio' id='{$pid}-rating4' name='{$pid}-rating' value='4'><label for='{$pid}-rating4'>&#9733;</label>
                                <input type='radio' id='{$pid}-rating5' name='{$pid}-rating' value='5'><label for='{$pid}-rating5'>&#9733;</label>
                            </fieldset>
                        </td>
                      </tr>";
            }
            echo "</tbody></table><button name='abc' type='submit' class='btn'>Submit</button></form></div></div>";
        } else {
            echo "<h2>ORDER INFO</h2>
                  <div class='card'>
                      <div class='card-body'>
                          <table class='tb'><thead>
                          <tr><th>Order ID</th><th>Date Ordered</th><th>Date Delivered</th><th>Total Price</th><th>Address</th><th>Review</th></tr>
                          </thead><tbody>";

            $aid = $_SESSION['aid'];
            $orderQuery = "SELECT * FROM orders WHERE aid = $aid";
            $orderResult = mysqli_query($con, $orderQuery);

            while ($order = mysqli_fetch_assoc($orderResult)) {
                $oid = $order['oid'];
                echo "<tr>
                        <td>{$oid}</td>
                        <td>{$order['dateod']}</td>
                        <td>" . ($order['datedel'] ?? "Not Delivered") . "</td>
                        <td>{$order['total']}</td>
                        <td>{$order['address']}</td>
                        <td><a href='profile.php?odd={$oid}'><button class='insert-btn'>Review</button></a></td>
                      </tr>";
            }
            echo "</tbody></table></div></div>";
        }
          
      if (isset($_POST['abc'])) {
        include("include/connect.php");
    
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        $oid = $_GET['odd'];
        $query = "SELECT * FROM `order-details` WHERE oid = $oid";
        $result = mysqli_query($con, $query);
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $pid = $row['pid'];
                $text = isset($_POST["$pid-te"]) ? $_POST["$pid-te"] : '';
                $star = isset($_POST["$pid-rating"]) ? $_POST["$pid-rating"] : null;
    
                if ($star !== null) {
                    $query = empty($text)
                        ? "INSERT INTO `reviews` (oid, pid, rtext, rating) VALUES ($oid, $pid, NULL, $star)"
                        : "INSERT INTO `reviews` (oid, pid, rtext, rating) VALUES ($oid, $pid, '$text', $star)";
    
                    if (!mysqli_query($con, $query)) {
                        echo "Error adding review for Product ID $pid: " . mysqli_error($con);
                    } else {
                        echo "Review successfully added for Product ID: $pid.<br>";
                    }
                } else {
                    echo "No rating selected for Product ID: $pid.<br>";
                }
            }
        } else {
            echo "Error fetching order details: " . mysqli_error($con) . "<br>";
        }
    
        exit();
    }
    
      ?>

        </div>
        <!-- End -->

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
        // Get all the rating fields on the page
        function bruh(param) {
            console.log(param);
            const ratingFields = document.querySelectorAll('#a-' + param + '-rating');

            // Loop through each rating field
            ratingFields.forEach(ratingField => {
                // Get all the stars in this rating field
                const stars = ratingField.querySelectorAll('input[type="radio"]');

                // Loop through each star
                stars.forEach(star => {
                    // Listen for click events on this star
                    star.addEventListener('click', function() {
                        // Set the clicked star and all the stars before it to be checked and filled


                        for (let i = 0; i < star.value; i++) {
                            console.log('hello');
                            stars[i].checked = true;
                            stars[i].nextElementSibling.classList.add('checked');
                        }

                        // Set all the stars after the clicked star to be unchecked and empty
                        for (let i = star.value; i < stars.length; i++) {
                            stars[i].checked = false;
                            console.log('hello');

                            stars[i].nextElementSibling.classList.remove('checked');
                        }
                    });
                });
            });
        }
        </script>

</body>

</html>
<script>
        document.addEventListener("DOMContentLoaded", function () {
            const ratingFields = document.querySelectorAll('.rating');
            ratingFields.forEach(ratingField => {
                ratingField.addEventListener('click', function (event) {
                    const star = event.target;
                    if (star.tagName === 'INPUT') {
                        const stars = Array.from(ratingField.querySelectorAll('input[type="radio"]'));
                        const selectedValue = parseInt(star.value);
                        stars.forEach((input, index) => {
                            input.checked = (index + 1 <= selectedValue);
                            input.nextElementSibling.classList.toggle('checked', index + 1 <= selectedValue);
                        });
                    }
                });
            });
        });
    </script>
<script>
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
  function setupRatingListeners() {
    // Get all rating fields on the page
    const ratingFields = document.querySelectorAll('.rating');

    // Loop through each rating field
    ratingFields.forEach(ratingField => {
      const stars = ratingField.querySelectorAll('input[type="radio"]');
      const labels = ratingField.querySelectorAll('label');

      // Loop through each star and add click event listeners
      stars.forEach(star => {
        star.addEventListener('click', function () {
          // Set the clicked star and all previous stars as checked
          let selectedValue = parseInt(star.value);
          for (let i = 0; i < stars.length; i++) {
            stars[i].checked = (i < selectedValue);
            labels[i].classList.toggle('checked', i < selectedValue);
          }
        });
      });
    });
  }
  document.addEventListener("DOMContentLoaded", function () {
  const ratingFields = document.querySelectorAll('.rating');
  
  ratingFields.forEach(ratingField => {
    ratingField.addEventListener('click', function (event) {
      const star = event.target;
      if (star.tagName === 'INPUT') {
        const ratingValue = star.value;
        console.log(`Rating selected: ${ratingValue}`);
      }
    });
  });
});


  // Initialize listeners after page load
  document.addEventListener("DOMContentLoaded", setupRatingListeners);
</script>