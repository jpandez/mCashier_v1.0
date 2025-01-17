<?php
session_start();
//$_SESSION['pagetoken'] = uniqid(mt_rand(), true);
//$_SESSION['pagetoken'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
echo $_SESSION['pagetoken'];
?>