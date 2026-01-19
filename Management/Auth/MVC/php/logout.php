
<?php
session_start();
session_destroy();
header("Location: /web-tech-project/Management/Auth/MVC/html/login.php");
exit;

