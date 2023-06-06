<?php

    include 'bas_style.php';

    // It checks that the variable is within the minimum and maximum length limits.
    function BAS_checkLength($var, $min_length, $max_length)
    {
        $length = strlen($var);
        
        if ($length >= $min_length && $length <= $max_length)
        {
            return true;
        }

        else
        {
            return false;
        }
    }

    // Displays a pop-up warning on the screen with the specified configurations.
    function BAS_alertMessage($message, $background_color)
    {
        echo
        '
            <div class="bas_alert" style="background-color: '.$background_color.';">
                <p class="bas_alert_message">'.$message.'</p>
            </div>
        ';
    }

    // It redirects to the specified page within the specified time.
    function BAS_redirect($URL, $interval)
    {
        header("Refresh: $interval; URL=$URL");
    }

?>
