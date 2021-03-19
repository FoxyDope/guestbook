<?php

$mysqli = new mysqli("localhost", "my_user", "my_password", "world");
$username = $_GET['username'];
$result = mysqli_query($mysqli, 'SELECT * FROM users WHERE username="' . $username . '"');

