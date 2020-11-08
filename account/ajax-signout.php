<?php

session_start();
session_destroy();
$array_session = [
    $_SESSION['id'], 
    $_SESSION['name'], 
    $_SESSION['email']
];
foreach ($array_session as $session) {
    unset($session);
}


?>
<script>
   window.location.href = 'login.php';
</script>


