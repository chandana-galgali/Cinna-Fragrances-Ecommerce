<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cinna Fragrances - Review</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="styles.css" />

    <style>
        .rating {
            display: inline-block;
            font-size: 0;
            line-height: 0;
            border: none;
            border-style: none;
        }

        .rating label {
            display: inline-block;
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
        }

        .rating label:before {
            content: '\2606';
        }

        .rating label.checked:before,
        .rating label:hover:before {
            content: '\2605';
            color: #ffc107;
        }

        input[type="radio"] {
            display: none;
        }
    </style>
</head>

<body>
  
<?php
if (isset($_GET['odd'])) {
    include("include/connect.php");

    $oid = $_GET['odd'];

    $query = "SELECT * FROM `order-details` WHERE oid = $oid";
    $result = mysqli_query($con, $query);

    echo "<form method='post' action='submit_review.php'> <!-- submit_review.php will handle the form submission -->
          <table><thead>
            <tr>
                <th>Img</th>
                <th>Name</th>
                <th>Price</th>
                <th>Review</th>
                <th>Rating</th>
            </tr>
          </thead><tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        $pid = $row['pid'];
        $query = "SELECT * FROM products WHERE pid = $pid";
        $result2 = mysqli_query($con, $query);
        $row2 = mysqli_fetch_assoc($result2);

        $img = $row2['img'];
        $pname = $row2['pname'];
        $price = $row2['price'];

        echo "<tr>
                <td><img src='product_images/$img' width='50' height='50' alt='Product Image'></td>
                <td>$pname</td>
                <td>$price</td>
                <td><input type='text' name='{$pid}-review'></td>
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

    echo "</tbody></table>
          <button type='submit' name='submit_review' class='btn'>Submit</button>
          </form>";
}
?>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".rating").forEach(function(ratingField) {
      const stars = ratingField.querySelectorAll("input[type='radio']");
      stars.forEach(function(star) {
        star.addEventListener("click", function() {
          stars.forEach(s => s.checked = s.value <= this.value); // Handle star filling
        });
      });
    });
  });
</script>

</body>
</html>