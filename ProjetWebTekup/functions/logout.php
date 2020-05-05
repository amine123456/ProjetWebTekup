<?php

SESSION_START();
session_unset();
session_destroy();
header('Location: ../index.php');
exit;




?>