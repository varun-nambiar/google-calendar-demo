<?php
require_once 'vendor/autoload.php';
session_start();
$client = new Google_Client();
$client->setAuthConfig('credentials.json');

$client->addScope(Google_Service_Calendar::CALENDAR);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);

    $service = new Google_Service_Calendar($client);
    
    // Code to create and send invitations
    // Refer to Google Calendar API documentation for this part
    
    echo "<pre>";

    // print_r($_SESSION);

    $eventData = array(
        'summary' => 'Summary/Title',
        'location' => 'Location here',
        'description' => 'Description here',
        'start' => array(
            'dateTime' => '2023-08-25T21:00:00',
            'timeZone' => 'Asia/Kolkata',
        ),
        'end' => array(
            'dateTime' => '2023-08-25T21:30:00',
            'timeZone' => 'Asia/Kolkata',
        ),
        // https://yopmail.com/en/wm
        'attendees' => array(
            array('email' => 'user1@yopmail.com'),
            array('email' => 'user2@yopmail.com')
        ),
      );

    $event = new Google_Service_Calendar_Event($eventData);

    $calendarId = 'primary'; // Calendar ID of the user (primary calendar)
    $event = $service->events->insert($calendarId, $event, ['sendUpdates' => 'all']);

    echo 'Event created: ' . $event->htmlLink;

    echo "</pre>";
    
} else {
    $redirect_uri = 'http://localhost:5572/oauth2callback.php';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
