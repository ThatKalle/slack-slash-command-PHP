<?php
header('Content-Type: application/json');

    require 'config.php';
    include 'functions/bot_respond.php';
    
    // Variables
    $req = $_REQUEST['text'];
    $date = date('Ymd');
    $weekday = date('w'); // 0 (for Sunday) through 6 (for Saturday)
    
    // Inputs
	switch ($req) {
        // Match on help
        case 'help': case 'Help': case 'HELP':
            bot_respond("Not that anyone cares what I say, but the Restaurant is on the other end of the universe. `/marvin lunch`.\nYou’ve already learned how to get help with `/marvin help`.");
            break;
        // Match on lunch
        case 'lunch': case 'Lunch': case 'LUNCH':
            $sotdData = array(
                // http://www.subway.com/sv-se/menunutrition/menu/sub-of-the-day
                "<http://www.subway.com/sv-se/menunutrition/menu/product?ProductId=4487&MenuCategoryId=445|Italian B.M.T.>", // Sunday[0]
                "<http://www.subway.com/sv-se/menunutrition/menu/product?ProductId=4486&MenuCategoryId=445|American Steakhouse Melt>", // Monday[1]
                "<http://www.subway.com/sv-se/menunutrition/menu/product?ProductId=4492&MenuCategoryId=445|Subway Melt>", // Tuesday[2]
                "<http://www.subway.com/sv-se/menunutrition/menu/product?ProductId=4483&MenuCategoryId=445|Spicy Italian>", // Wednesday[3]
                "<http://www.subway.com/sv-se/menunutrition/menu/product?ProductId=4488&MenuCategoryId=445|Kycklingbröst>", // Thursday[4]
                "<http://www.subway.com/sv-se/menunutrition/menu/product?ProductId=4494&MenuCategoryId=445|Tonfisk>", // Friday[5]
                "<http://www.subway.com/sv-se/menunutrition/menu/product?ProductId=4481&MenuCategoryId=445|Skinka>"); // Saturday[6]

            // Only show Friday Specials on Friday!
            $friday = ($weekday == "5")? 
                '{
                    "title": ":hamburger: Friday :hamburger:",
                    "value": "<http://www.burgerplace1.com/lunch|Burger Place 1>\n<http://burgerplace2.com/#meny|Burger Place 2>\n", 
                    "short": false 
                },' : "";

            bot_respond('
            {
                "response_type": "in_channel",
                "attachments": [
                    {
                        "fallback": "Menus fetched, check out the Channel!",
                        "color": "#3AA3E3",
                        "fields": [
                            ' . $friday . '
                            {
                                "title": "Local Menus",
                                "value": "<http://www.restaurant1.com/menu|Restaurant 1>\n<http://www.restaurant2.com/menu|Restaurant 2>",
                                "short": true
                            },
                            {
                                "title": "Sub of the Day",
                                "value": "' . $sotdData[$weekday] .'", 
                                "short": true
                            } 
                        ],
                        "footer": "Week: ' . date('W') . ' Day: ' . date('l') . '"
                    }
                ]
            }
            
            ');
            break;
        // Match on dev
        case 'dev':
            bot_respond("I have a million ideas. They all point to certain death.\ntext = $req");
            break;
        // Match on anything else
        default:
            bot_respond("I’d give you advice, but you wouldn’t listen. No one ever does.\n`/marvin help`.");
            break;
    }

?>