<?php
include 'Backend/domain-name.php';

echo"Hello";
session_start();
session_destroy();
	
	echo "<br>";
	echo"session destroyed";
    header("Location: $DOMAIN_NAME/index.php");

?>