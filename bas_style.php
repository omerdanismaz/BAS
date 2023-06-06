<?php

    include 'bas_config.php';

    echo
    '
        <head>
            <style>
            .bas_alert {
                position: fixed;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 1vh;
                width: 100vh;
                height: auto;
                user-select: none;
                top: '.$cfg_alert_margin_top.';
                border-radius: '.$cfg_alert_border_radius.';
                animation: fade_out '.$cfg_alert_fade_out_seconds.' forwards;
            }

                @keyframes fade_out
                {
                    0% { opacity: 1; }
                    100% { opacity: 0; display: none; }
                }
                
                .bas_alert_message
                {
                    margin: 0;
                    font-size: 2.5vh;
                    text-align: center;
                    user-select: none;
                    color: '.$cfg_alert_message_font_color.';
                    font-family: '.$cfg_alert_message_font_family.';
                }
            </style>

            <script>
                setTimeout(function()
                {
                    var alert = document.querySelector(".bas_alert");
                    alert.style.display = "none";
                }, '.$cfg_alert_fade_out_milliseconds.');
            </script>
        </head>
    ';

?>
