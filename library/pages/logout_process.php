<?php
session_start();
session_unset();
session_destroy();
header('Location: /library/index.php');
exit();
?>