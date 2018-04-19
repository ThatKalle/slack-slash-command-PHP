<?php
// Requred to use proper message formating
// https://api.slack.com/docs/message-formatting
header('Content-Type: application/json');

    // Require auhorization, config.php.
    // Break on failure.
    require 'config.php';
    // Action
    include 'functions/bot_respond.php';
    
    // Variables
    $req = $_REQUEST['text'];
      
    // Inputs
	switch ($req) {
        // Match on "/command help"
        case 'help': case 'Help': case 'HELP':
            bot_respond("Helpful message.");
            break;
        // Match on "/command Task"
        case 'Task':
            bot_respond("Do something.");
            break;
         // Match on "/command Task2"
        case 'Task2':
            bot_respond("Do something else.");
            break;
        // Match on everything else.
        default:
            bot_respond("Error message.");
            break;
    }

?>