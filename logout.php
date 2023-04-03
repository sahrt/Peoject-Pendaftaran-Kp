<?php 
session_start();

//kita tutup sessionya
$_SESSION=[];
session_unset();
session_destroy();

//menghapus cookie
setcookie("key1",'', time() -3600);
setcookie("key2",'', time() -3600);

header("Location: index.php");
exit;





 ?>