<?php
session_start();
session_unset();
// unset($_SESSION["user"]);
header("Location: /");
?>


