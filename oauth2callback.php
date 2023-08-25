<?php
require_once 'vendor/autoload.php';
session_start();
$client = new Google_Client();
$client->setAuthConfig('credentials.json');

$client->addScope(Google_Service_Calendar::CALENDAR);
$client->setAccessType("offline");
$redirect_uri = 'http://localhost:5572/oauth2callback.php';
$client->setRedirectUri($redirect_uri);


if (!isset($_GET['code'])) {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $_SESSION['refresh_token'] = $client->getRefreshToken();

    header('Location: ' . filter_var('/index.php', FILTER_SANITIZE_URL));
}
