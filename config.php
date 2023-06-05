<?php

    // Database Server Configuration
    $cfg_servername = "localhost";
    $cfg_username = "root";
    $cfg_password = "root";
    $cfg_database = "test";

    // Redirect Configuration
    $cfg_after_register_redirect = "index.php";
    $cfg_after_login_redirect = "index.php";
    $cfg_after_logout_redirect = "index.php";

    // Registration Requirements Configuration
    $cfg_firstname_min_length = 3;
    $cfg_firstname_max_length = 50;

    $cfg_lastname_min_length = 3;
    $cfg_lastname_max_length = 50;

    $cfg_username_min_length = 5;
    $cfg_username_max_length = 50;

    $cfg_email_min_length = 5;
    $cfg_email_max_length = 100;

    $cfg_password_min_length = 8;
    $cfg_password_max_length = 32;

    // Alert Messages Configuration

        // Register
        $cfg_firstname_length_message = "The length of the first name must be between ".$cfg_firstname_min_length."-".$cfg_firstname_max_length." characters.";
        $cfg_firstname_invalid_message = "Invalid first name format.";
        
        $cfg_lastname_length_message = "The length of the last name must be between ".$cfg_lastname_min_length."-".$cfg_lastname_max_length." characters.";
        $cfg_lastname_invalid_message = "Invalid last name format.";
        
        $cfg_username_length_message = "The length of the username must be between ".$cfg_username_min_length."-".$cfg_username_max_length." characters.";
        $cfg_username_invalid_message = "Invalid username format.";
        
        $cfg_email_length_message = "The length of the email must be between ".$cfg_email_min_length."-".$cfg_email_max_length." characters.";
        $cfg_email_invalid_message = "Invalid email format.";
        
        $cfg_username_or_email_already_exist_message = "The username or e-mail you entered is already registered in the system.";

        $cfg_password_length_message = "The length of the password must be between ".$cfg_password_min_length."-".$cfg_password_max_length." characters.";
        $cfg_password_not_match_message = "Passwords do not match.";
        
        $cfg_registration_successful_message = "Registration successful. Redirecting.";

        // Login
        $cfg_login_unsuccessful_message = "Incorrect login credentials.";
        $cfg_login_successful_message = "Login successful. Redirecting.";
    
        // Logout
        $cfg_logout_successful_message = "Logout successful. Redirecting.";

    // Alert Messages Style Configuration
    $cfg_alert_margin_top = "5vh";

    $cfg_alert_message_font_color = "#FFFFFF";
    $cfg_alert_message_font_family = "Arial";

    $cfg_success_background_color = "#34A853";
    $cfg_warning_background_color = "#FFCA28";
    $cfg_danger_background_color = "#D21404";

    $cfg_alert_border_radius = "2.5vh";
    $cfg_alert_fade_out_seconds = "7.5s";
    $cfg_alert_fade_out_milliseconds = "7500";
    $cfg_after_successful_alert_redirect_after_seconds = "3";

?>
