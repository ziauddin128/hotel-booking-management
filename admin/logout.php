<?php 
session_start();

unset($_SESSION['ADMIN_ID']);
unset($_SESSION['ADMIN_LOGIN']);

echo "<script>
window.location.assign('index');
</script>"; 

?>