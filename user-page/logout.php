<?php
// user-page/logout.php

session_start();
require_once '../includes/user.php';

$user = new User();
$user->logout();

header("Location: ../index.php");
exit();
