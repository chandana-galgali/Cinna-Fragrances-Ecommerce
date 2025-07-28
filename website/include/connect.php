<?php
$con = mysqli_connect('localhost', 'root', ' ', 'cinna_fragrances');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
