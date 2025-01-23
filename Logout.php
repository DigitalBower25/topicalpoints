<?php
session_start();

// Clear session data
$_SESSION = [];


// Destroy the session
session_destroy();



// Redirect to login page or show logout confirmation
header("Location: /");
//exit();
?>
<iframe id="logoutframe" src="https://accounts.google.com/logout" style="display: none"></iframe>
<script>
    google.accounts.id.signOut();
</script>


