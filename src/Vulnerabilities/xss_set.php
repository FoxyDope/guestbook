<!--Vulnerability involving variables-->
<html>
<?php
$name = $_GET['name'];
$msg = 'Welcome '.$name;
?>
<head>
    <title><? echo($name); /* XSS 1 */ ?></title>
</head>
<body>
<? echo($msg); /* XSS 2 */ ?>
</body>
</html>

<!--Vulnerability filter input-->
<?php

$a = htmlentities($_GET['a']);
$b = $_GET['b'];
$c = $_GET['c'];
$d = htmlentities($b);

echo ($a); // safe
echo (htmlentities($b)); // safe
echo ($c); // XSS vulnerability
echo ($d); // safe
echo (htmlentities($_GET['id'])); // safe

?>

<!--Shorthand support-->
<?
$name = $_GET['name'];
?>
<?=$_GET['name']; //XSS 1 ?>
<?=$name // XSS 2 ?>

<!--PHP inside script tags-->
<html>
<script language="php">
$d = $_GET['d'];
echo($d); // XSS
</script>
</html>

