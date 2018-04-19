<?php
    $valid_tokens = array(
        // Add token from Slack - https://api.slack.com/apps/XXXXXXXXXX/general?
        "11vNqNWy22Um4zZ9vNq33yp4"
    );

    if (empty($_REQUEST['token'])) {
        die("Unauthorized token: Access to this resource is denied.");
    } else if (!in_array($_REQUEST['token'], $valid_tokens)) {
        die(":no_good: *Unauthorized token!*");
    };