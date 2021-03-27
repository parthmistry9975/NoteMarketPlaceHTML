<?php
session_start();
if(isset($_GET["msg"])){
    echo $_GET["msg"];
    echo '<p>once you verify mail go to login via below link</p><br>
<a href="login.html">Login</a>';
}else {
echo " ";
}
?>
