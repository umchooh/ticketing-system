<?php
// Start or resume a session
session_start();
setcookie(session_name(), '', 100);
// Clear session data and destroy it, then redirect user to the login page
session_unset();
session_destroy();
header('Location: ../index.php');
exit();
?>
