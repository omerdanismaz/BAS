<?php

    session_start();

    include "bas_config.php";
    include "bas_functions.php";
    include "bas_connection.php";

    // If the user is already logged in, it redirects to the configured page.
    if (isset($_SESSION["user_id"]))
    {
        $redirectURL = "/$cfg_after_login_redirect";
        BAS_redirect($redirectURL, 0);
        exit();
    }

    // If the user is not logged in, the login page loads.
    if (isset($_POST['email_or_username'], $_POST['password']))
    {
        $email_or_username = $_POST['email_or_username'];
        $password = $_POST['password'];

        // The user registration status is checked.
        $query = "SELECT * FROM bas_users WHERE (user_email = :email_or_username OR user_username = :email_or_username)";
        $statement = $conn->prepare($query);
        $statement->bindParam(':email_or_username', $email_or_username);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // If the user is registered.
        if ($statement->rowCount() == 1)
        {
            $hashed_password = $result['user_password'];

            // The encrypted and salted password is verified.
            if (password_verify($password, $hashed_password))
            {
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['user_firstname'] = $result['user_firstname'];
                $_SESSION['user_lastname'] = $result['user_lastname'];
                $_SESSION['user_username'] = $result['user_username'];
                $_SESSION['user_email'] = $result['user_email'];
                $_SESSION['user_authoritylevel'] = $result['user_authoritylevel'];
                $_SESSION['user_mutestatus'] = $result['user_mutestatus'];
                $_SESSION['user_banstatus'] = $result['user_banstatus'];
                $_SESSION['user_registerdate'] = $result['user_registerdate'];
                $_SESSION['user_lastlogin'] = $result['user_lastlogin'];
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

                $user_id = $result['user_id'];
                $update_last_login = "UPDATE bas_users SET user_lastlogin = CURRENT_TIMESTAMP WHERE user_id = :user_id";
                $statement = $conn->prepare($update_last_login);
                $statement->bindParam(':user_id', $user_id);
                $statement->execute();

                BAS_alertMessage($cfg_login_successful_message, $cfg_success_background_color);
                $redirectURL = "/$cfg_after_login_redirect";
                BAS_redirect($redirectURL, $cfg_after_successful_alert_redirect_after_seconds);
            }

            // The encrypted and salted password is not verified.
            else
            {
                BAS_alertMessage($cfg_login_unsuccessful_message, $cfg_danger_background_color);
            }
        }

        // If the user is not registered.
        else
        {
            BAS_alertMessage($cfg_login_unsuccessful_message, $cfg_danger_background_color);
        }
    }

?>
