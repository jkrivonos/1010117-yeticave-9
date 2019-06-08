<?php
require 'connection.php';


$con = connectionToBD();
session_start();
unset($_SESSION['user']);
header("Location: /index.php");?>