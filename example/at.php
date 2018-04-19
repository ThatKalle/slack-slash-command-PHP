<?php
header('Content-Type: application/json');

    require 'config.php';
    include 'functions/bot_respond.php';
    
    // Variables
    $req = $_REQUEST['text'];
    $date = date('Ymd');
    $randomNum = substr(str_shuffle("0123456789"), 0, 4);
    // Swap wwX to match your location
    $autotaskUrl = "https://ww4.autotask.net/Autotask/AutotaskExtend/ExecuteCommand.aspx?Code=";
    $autotaskTicketDetail = "OpenTicketDetail&TicketNumber=";
    $autotaskTaskDetail = "OpenTaskDetail&TaskNumber=";
    $autotaskTicketUrl = $autotaskUrl . '' . $autotaskTicketDetail . '' . $req; //https://ww4.autotask.net/Autotask/AutotaskExtend/ExecuteCommand.aspx?Code=OpenTicketDetail&TicketNumber=T12341212.1234
    $autotaskTaskUrl = $autotaskUrl . '' . $autotaskTaskDetail . '' . $req; //https://ww4.autotask.net/Autotask/AutotaskExtend/ExecuteCommand.aspx?Code=OpenTaskDetail&TaskNumber=T12341212.1234
    
    // Inputs
	switch ($req) {
        // Match on help
        case 'help': case 'Help': case 'HELP':
            bot_respond("Generate links `/at T" . $date . "." . $randomNum . "`.\nFurther assistance `/at help`.");
            break;
        // Match on Autotask Ticket/Task "/at T12341212.1234"
        case preg_match('/^T[0-9]{8}.[0-9]{4}$/i', $req) ? $req : !$req:
            bot_respond('
            { 
                "response_type": "ephemeral",
                "attachments": [ 
                    { 
                        "title": "Autotask links generated successfully",
                        "text":"' . $req . '",
                        "color": "#3AA3E3",
                        "fallback": "Ticket: ' . $autotaskTicketUrl . '",
                        "actions": [ 
                            { 
                                "type": "button",
                                "text": "Ticket",
                                "url": "' . $autotaskTicketUrl . '"
                            },
                            { 
                                "type": "button",
                                "text": "Task",
                                "url": "' . $autotaskTaskUrl . '"
                            } 
                        ] 
                    } 
                ]
            }');
            break;
        // Match on anything else
        default:
            bot_respond("Try again!.\n`/at help`.");
            break;
    }

?>