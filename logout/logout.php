<?php
session_start();
unset($_SESSION["donor"]);
unset($_SESSION["recipient"]);
unset($_SESSION["admin"]);


echo "<script>window.location.href = '../content/content.php'</script>"


?>
