<?php
require_once 'vendor/autoload.php';
session_start();

echo json_encode($_SESSION, JSON_PRETTY_PRINT);


