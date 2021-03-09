<?
/*
This was a XSS vulnerability. I commented it out
echo($_GET['name']);
*/
$name = $_GET['name']; // echo($name); Same here!
?>