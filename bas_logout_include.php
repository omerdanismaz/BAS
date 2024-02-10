<?php

    @session_start();

    include "bas_config.php";
    include "bas_functions.php";

    // If the user is not logged in, it redirects to the configured page.
    if (!isset($_SESSION["user_id"]))
    {
        $redirectURL = "/$cfg_after_register_redirect";
        BAS_redirect($redirectURL, 0);
        exit();
    }

    // If the user is logged in, the session is terminated and the session data is cleared.
    session_destroy();
    
    BAS_alertMessage($cfg_logout_successful_message, $cfg_success_background_color);
    $redirectURL = "/$cfg_after_logout_redirect";
    BAS_redirect($redirectURL, $cfg_after_successful_alert_redirect_after_seconds);

?>
