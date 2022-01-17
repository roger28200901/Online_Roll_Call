<?php
session_start();
date_default_timezone_set("Asia/Taipei");
error_reporting(4);
$mysqli = new mysqli('127.0.0.1', 'admin', '1234', 'midterm');
