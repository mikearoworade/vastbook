<?php
require_once(__DIR__.'/config/config.php');

// clear all the session variables and redirect to index
session_start();
session_unset();
session_write_close();
$url = BASE_URL;
header("Location: $url");