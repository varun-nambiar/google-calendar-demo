<?php
require_once 'vendor/autoload.php';
session_start();
$client = new Google_Client();
$client->setAuthConfig('credentials.json');

$client->addScope(Google_Service_Calendar::CALENDAR);
$client->fetchAccessTokenWithRefreshToken($_SESSION['refresh_token']);

$_SESSION['access_token'] = $client->getAccessToken();
$_SESSION['refresh_token'] = $client->getRefreshToken();

print_r($_SESSION);