<?php
include("include/connect.php");

if (isset($_POST['ins'])) {
	$pname = $_POST['name'];
	$category = $_POST['category'];
	$description = $_POST['description'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	$brand = $_POST['brand'];
	$image = $_FILES['photo']['name'];
	$temp_image = $_FILES['photo']['tmp_name'];

	if ($category == "all") {
		echo "<script> alert('select category'); setTimeout(function(){ window.location.href = 'inventory.php'; }, 100); </script>";
		exit();
	}

	move_uploaded_file($temp_image, "product_images/$image");

	$query = "insert into `products`(pname, category, description, price, qtyavail, img, brand) values ('$pname', '$category', '$description', '$price', '$quantity', '$image', '$brand')";

	$result = mysqli_query($con, $query);

	if ($result) {
		echo "<script> alert('Successfully entered product') </script>";
	}
}

if (isset($_GET['pid'])) {

	$id = $_GET['pid'];
	$query = "DELETE FROM products WHERE pid = '$id'";

	mysqli_query($con, $query);

}

if (isset($_POST['submitt'])) {
	$pname = $_POST['name1'];
	$category = $_POST['category1'];
	$description = $_POST['description1'];
	$quantity = $_POST['quantity1'];
	$price = $_POST['price1'];
	$brand = $_POST['brand1'];
	$image = $_FILES['photo1']['name'];
	$temp_image = $_FILES['photo1']['tmp_name'];
	$pid2 = $_POST['pid1'];
	$image2 = $_POST['prevphoto'];
	$prevcat = $_POST['prev'];
	if ($category == "all") {
		$category = $prevcat;
	}

	if (!empty($image))
		move_uploaded_file($temp_image, "product_images/$image");

	if (!empty($image))
		$query = "Update `products` set pname = '$pname', category = '$category', description = '$description', qtyavail = $quantity, brand ='$brand', price = $price, img ='$image' where pid = $pid2";
	else
		$query = "Update `products` set pname = '$pname', category = '$category', description = '$description', qtyavail = $quantity, brand ='$brand', price = $price, img ='$image2' where pid = $pid2";

	$result = mysqli_query($con, $query);

	if ($result) {
		echo "<script> alert('Successfully updated product') </script>";
	}
}

if (isset($_GET['odd'])) {
	$oid = $_GET['odd'];

	$query = "UPDATE orders set datedel = CURDATE() where oid = $oid";

	$result = mysqli_query($con, $query);

	header("Location: inventory.php");
	exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Cinna Fragrances Inventory Management</title>
    <link rel="stylesheet" href="styles.css">
    <style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #ffffff; /* Deep navy background */
    color: #DBA858; /* Warm gold text color */
    margin: 0;
    padding: 20px;
}

h1, h2 {
    color: #DBA858; /* Gold color for headings */
    margin-bottom: 10px;
}

.container {
    display: flex;
    flex-direction: column;
    gap: 20px; /* Space between containers */
    margin: 20px 0;
}

.form-container, .search-container, .inventory-container, .order-container {
    background-color: #031B28; /* Darker container background */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Soft shadow for depth */
    padding: 20px;
    margin-bottom: 20px;
}

.form-container label,
.search-container label,
.order-container label {
    font-weight: bold; /* Bold labels */
    margin-bottom: 5px;
    color: #DBA858; /* Gold color for labels */
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #95a5a6; /* Light gray border */
    border-radius: 5px; /* Rounded corners */
    margin-bottom: 15px; /* Space below input fields */
    background-color: #031B28; /* Dark gray background for inputs */
    color: #DBA858; /* Gold text for inputs */
}

input[type="text"]:focus,
input[type="number"]:focus,
select:focus {
    border-color: #DBA858; /* Gold border on focus */
}

.insert-btn, #search-btn {
    background-color: #DBA858; /* Gold for buttons */
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.insert-btn:hover, #search-btn:hover {
    background-color: #b88a4a; /* Darker gold on hover */
}

#product-list {
    overflow-x: auto; /* Allow horizontal scrolling */
}

table {
    width: 100%;
    border-collapse: collapse; /* Merge table borders */
    margin-top: 10px;
}

th, td {
    text-align: left;
    padding: 10px; /* Cell padding */
    border-bottom: 1px solid #95a5a6; /* Light border for rows */
}

th {
    background-color: #DBA858; /* Gold for header */
    color: #031B28; /* Dark navy for header text */
    position: sticky;
    top: 0; /* Keep header fixed */
}

tr:hover {
    background-color: #2c3e50; /* Darker gray on hover */
}

.order-container {
    display: flex;
    flex-direction: column;
    gap: 10px; /* Space between elements in the order container */
}

.btns {
    display: flex;
    justify-content:space-around; /* Space out buttons */
    margin-bottom: 15px;
}

#all-btn, #delivered-btn, #undelivered-btn {
    background-color: #DBA858; /* Green for order buttons */
    color: #031B28;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
}

#all-btn:hover, #delivered-btn:hover, #undelivered-btn:hover {
    background-color: #219653; /* Darker green on hover */
}

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <h2 style="text-align: center;">Admin Panel</h2>
    <br>
    <div class="container1">
        <div class="form-container">
            <h3>Insert Product</h3><br><br>
            <form id="insert-form" action="inventory.php" enctype="multipart/form-data" method="post">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="category">Category:</label>
                <select id="category-filter" name="category" required>
                    <option value="all">All</option>
                    <option value='floral'>Floral</option>
                    <option value='woody'>Woody</option>
                    <option value='citrus'>Citrus</option>
                    <option value='oriental'>Oriental</option>
                    <option value='fresh'>Fresh</option>
                </select>
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required min='0'>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required min='0'><br>
                <label for="image">Image:</label>
                <input type="file" name="photo" id="fileInput" required><br><br>
                <label for="brand">Brand:</label>
                <input type="text" id="brand" name="brand" required>
                <button name="ins" type="submit" class="insert-btn">Save</button>
            </form>
        </div>
        <div class="search-container">
            <h3>Search Product</h3><br><br>
            <form id="search-form" action="inventory.php" method="post">
                <label for="search">Search:</label>
                <input type="text" id="search" name="search">
                <label for="category-filter">Category:</label>
                <select id="category-filter" name="cat">
                    <option value="all">All</option>
                    <option value='floral'>Floral</option>
                    <option value='woody'>Woody</option>
                    <option value='citrus'>Citrus</option>
                    <option value='oriental'>Oriental</option>
                    <option value='fresh'>Fresh</option>
                </select>
                <button type="submit" id="search-btn" name="search1">Search</button>
            </form>
            <div class="inventory-container">
                <div id="product-list">

                    <?php
					if (isset($_GET['pidd'])) {
						$id = $_GET['pidd'];
						$query = "select * FROM products WHERE pid = $id";

						$result = mysqli_query($con, $query);
						$row = mysqli_fetch_assoc($result);
						$pid = $row['pid'];
						$pname = $row['pname'];
						$desc = $row['description'];
						$qty = $row['qtyavail'];
						$price = $row['price'];
						$cat = $row['category'];
						$img = $row['img'];
						$brand = $row['brand'];
						echo "<form id='insert-form' action='inventory.php' enctype='multipart/form-data' method='post'>
									<input type='number' style='display: none;' name='pid1' value=$pid>
									<input type='text' style='display: none;' name='prevphoto' value=$img>
									<input type='text' style='display: none;' name='prev' value=$cat>
									<label for='name'>Product Name:</label>
									<input type='text' id='name' name='name1' value='$pname' required>
									<label for='category'>Category:</label>
                                    <label>Category:</label>
									<select id='category-filter' name='category1'>
                                    <option value='all'>Select Category</option>
                                    <option value='floral>Floral</option>
                                    <option value='woody'>Woody</option>
                                    <option value='citrus'>Citrus</option>
                                    <option value='oriental'>Oriental</option>
                                    <option value='fresh'>Fresh</option>
									</select>
									<label for='description' >Description:</label>
									<input type='text' id='description' name='description1' value='$desc' required>
									<label for='price'>Price:</label>
									<input type='number' id='price' name='price1' value=$price required min='0'>
									<label for='quantity'>Quantity:</label>
									<input type='number' id='quantity' name='quantity1' value=$qty required min='0'><br><br>
									<label for='image'>Image:</label>
									<input type='file' name='photo1' id='fileInput'>
									<label for='brand'>Brand:</label><br><br>
									<input type='text' id='brand' name='brand1' value='$brand' required>
									<button name='submitt' type='submitt' class='insert-btn'>Save</button>
								</form >";
					}
					if (isset($_POST['search1'])) {
						$search = $_POST['search'];
						$category = $_POST['cat'];
						$query = "";
						if (!empty($search))
							$query = "select* from `products` where ((pname like '%$search%') or (brand like '%$search%') or (description like '%$search%'))";
						else
							$query = "select * from `products`";

						if ($category != "all") {
							if (empty($search)) {
								$query = $query . "where category = '$category'";
							} else {
								$query = $query . "and category = '$category'";
							}
						}

						$result = mysqli_query($con, $query);

						if ($result) {
							echo "
										<table>
										<thead>
											<tr>
												<th>Product Name</th>
												<th>Description</th>
												<th>Category</th>
												<th>Price</th>
												<th>Quantity</th>
												<th>Image</th>
												<th>Brand</th>
												<th>Delete</th>
												<th>Update</th>
											</tr>
										</thead>
										<tbody>
										";
						}

						while ($row = mysqli_fetch_assoc($result)) {
							$pid = $row['pid'];
							$pname = $row['pname'];
							$desc = $row['description'];
							$qty = $row['qtyavail'];
							$price = $row['price'];
							$cat = $row['category'];
							$img = $row['img'];
							$brand = $row['brand'];

							echo "<tr>
										<td>$pname</td>
										<td style='max-width: 300px; max-height: 100px; overflow-x: auto; overflow-y: auto;'>$desc</td>
										<td>$cat</td>
										<td>$price</td>
										<td>$qty</td>
										<td><img src='product_images/$img' alt='' width='300px' height='250px'/></td>
										<td>$brand</td>
									
										<td><a href ='inventory.php?pid=$pid' class='insert-btn'>Delete</button></td>
										<td><a href ='inventory.php?pidd=$pid' class='insert-btn'>Update</button></td>

										</tr>";
						}

						if ($result) {
							echo "
										</tbody>
										</table>
										";
						}
					}
					?>


                </div>
            </div>

        </div>
    </div>



    <div class="container11">
        <div class="order-container">

            <h3>List of Orders</h3><br><br>
            <div class="btns">
                <a href='inventory.php?a=1'><button id="all-btn">All</button></a>
                <a href='inventory.php?d=1'><button id="delivered-btn">Delivered</button></a>
                <a href='inventory.php?u=1'><button id="undelivered-btn">Undelivered</button></a>

            </div>


            <table id="tab1" style="width: auto; margin: 0 auto;">
                <thead>
                    <tr>
                        <th>UserName</th>
                        <th>OrderID</th>
                        <th>DateOrdered</th>
                        <th>DateDelivered</th>
                        <th>PaymentMethod</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					if (isset($_GET['d'])) {
						include("include/connect.php");
						$query = "SELECT * FROM orders join accounts on orders.aid = accounts.aid where datedel is not NULL";


						$result = mysqli_query($con, $query);

						while ($row = mysqli_fetch_assoc($result)) {
							$aname = $row['username'];
							$oid = $row['oid'];
							$dateod = $row['dateod'];
							$datedel = $row['datedel'];
							$add = $row['address'];
                            $pri = $row['total'];

							if (empty($datedel))
								$datedel = "Not Delivered";
							echo "
										

										<tr>
										<td>$aname</td>
										<td>$oid</td>
												<td>$dateod</td>
												<td>$datedel</td>
										<td>$pri</td>
										<td>$add</td>
										";
							if ($datedel == "Not Delivered")
								echo "<td><a href='inventory.php?odd=$oid'><button id='oupdate-btn'>SET</button></a></td>";


							echo "</tr>";
						}
					} elseif (isset($_GET['u'])) {
						include("include/connect.php");
						$query = "SELECT * FROM orders join accounts on orders.aid = accounts.aid where datedel is NULL";


						$result = mysqli_query($con, $query);

						while ($row = mysqli_fetch_assoc($result)) {
							$aname = $row['username'];
							$oid = $row['oid'];
							$dateod = $row['dateod'];
							$datedel = $row['datedel'];
							$add = $row['address'];
                            $pri = $row['total'];

							if (empty($datedel))
								$datedel = "Not Delivered";
							echo "
										

										<tr>
										<td>$aname</td>
										<td>$oid</td>
												<td>$dateod</td>
												<td>$datedel</td>
										<td>$pri</td>
										<td>$add</td>
										";
							if ($datedel == "Not Delivered")
								echo "<td><a href='inventory.php?odd=$oid'><button id='oupdate-btn'>SET</button></a></td>";


							echo "</tr>";
						}
					} elseif (isset($_GET['a'])) {
						include("include/connect.php");
						$query = "SELECT * FROM orders join accounts on orders.aid = accounts.aid";


						$result = mysqli_query($con, $query);

						while ($row = mysqli_fetch_assoc($result)) {
							$aname = $row['username'];
							$oid = $row['oid'];
							$dateod = $row['dateod'];
							$datedel = $row['datedel'];
							$add = $row['address'];
                            $pri = $row['total'];

							if (empty($datedel))
								$datedel = "Not Delivered";
							echo "
										

										<tr>
										<td>$aname</td>
										<td>$oid</td>
												<td>$dateod</td>
												<td>$datedel</td>
										<td>$pri</td>
										<td>$add</td>
										";
							if ($datedel == "Not Delivered")
								echo "<td><a href='inventory.php?odd=$oid'><button id='oupdate-btn'>SET</button></a></td>";


							echo "</tr>";
						}
					} else {

						include("include/connect.php");
						$query = "SELECT * FROM orders join accounts on orders.aid = accounts.aid";


						$result = mysqli_query($con, $query);

						while ($row = mysqli_fetch_assoc($result)) {
							$aname = $row['username'];
							$oid = $row['oid'];
							$dateod = $row['dateod'];
							$datedel = $row['datedel'];
							$add = $row['address'];
                            $pri = $row['total'];


							if (empty($datedel))
								$datedel = "Not Delivered";
							echo "
										

										<tr>
										<td>$aname</td>
										<td>$oid</td>
												<td>$dateod</td>
												<td>$datedel</td>
										<td>$pri</td>
										<td>$add</td>
										";
							if ($datedel == "Not Delivered")
								echo "<td><a href='inventory.php?odd=$oid'><button id='oupdate-btn'>SET</button></a></td>";


							echo "</tr>";
						}

					}



					?>

                </tbody>
            </table>


        </div>
    </div>
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