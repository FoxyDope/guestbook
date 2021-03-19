<html>
<? $name = $_GET['name']; // Comment ?><? echo($name); // XSS 1 ?>
<script>
    document.write('<? echo($_GET['city']); // XSS 2 ?>');
</script>
</html>