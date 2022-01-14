<?php

include("connection.php");

$_SESSION['login'] = false;
header("Location: login.php");
