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

    // If the user is not logged in, the register page loads.
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['password_confirm']))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        // The user registration status is checked.
        $check_existence = "SELECT * FROM bas_users WHERE user_username = :username OR user_email = :email";
        $statement = $conn->prepare($check_existence);
        $statement->bindParam(':username', $username);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $check_result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // The password is encrypted and salted.
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to be executed if registration requirements are met.
        $sql = "INSERT INTO bas_users (user_firstname, user_lastname, user_username, user_email, user_password)
                VALUES (:firstname, :lastname, :username, :email, :hashed_password)";

        // First Name Checks
        if (!BAS_checkLength($firstname, $cfg_firstname_min_length, $cfg_firstname_max_length))
        {
            BAS_alertMessage($cfg_firstname_length_message, $cfg_danger_background_color);
        }
        else if (!preg_match("/^([[:alpha:]' ]+)$/u", $firstname))
        {
            BAS_alertMessage($cfg_firstname_invalid_message, $cfg_danger_background_color);
        }

        // Last Name Checks
        else if (!BAS_checkLength($lastname, $cfg_lastname_min_length, $cfg_lastname_max_length))
        {
            BAS_alertMessage($cfg_lastname_length_message, $cfg_danger_background_color);
        }
        else if (!preg_match("/^([[:alpha:]' ]+)$/u", $lastname))
        {
            BAS_alertMessage($cfg_lastname_invalid_message, $cfg_danger_background_color);
        }

        // Username Checks
        else if (!BAS_checkLength($username, $cfg_username_min_length, $cfg_username_max_length))
        {
            BAS_alertMessage($cfg_username_length_message, $cfg_danger_background_color);
        }
        else if(!ctype_alnum($username))
        {
            BAS_alertMessage($cfg_username_invalid_message, $cfg_danger_background_color);
        }

        // Email Checks
        else if (!BAS_checkLength($email, $cfg_email_min_length, $cfg_email_max_length))
        {
            BAS_alertMessage($cfg_email_length_message, $cfg_danger_background_color);
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            BAS_alertMessage($cfg_email_invalid_message, $cfg_danger_background_color);
        }

        // The user registration status is checked.
        else if (count($check_result) > 0)
        {
            BAS_alertMessage($cfg_username_or_email_already_exist_message, $cfg_danger_background_color);
        }

        // Password Checks
        else if (!BAS_checkLength($password, $cfg_password_min_length, $cfg_password_max_length))
        {
            BAS_alertMessage($cfg_password_length_message, $cfg_danger_background_color);
        }
        else if ($password != $password_confirm)
        {
            BAS_alertMessage($cfg_password_not_match_message, $cfg_danger_background_color);
        }

        // If all requirements are met, the user is registered.
        else
        {
            $statement = $conn->prepare($sql);
            $statement->bindParam(':firstname', $firstname);
            $statement->bindParam(':lastname', $lastname);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':hashed_password', $hashed_password);
            
            if ($statement->execute())
            {
                BAS_alertMessage($cfg_registration_successful_message, $cfg_success_background_color);
                $redirectURL = "/$cfg_after_register_redirect";
                BAS_redirect($redirectURL, $cfg_after_successful_alert_redirect_after_seconds);
            }
            else
            {
                echo "<h3 style ='font-family: Consolas'>(BAS) ---> (register_include.php) ---> An error occurred while adding the record. ---> " . $statement->errorInfo() . "</h3>";
                exit();
            }
        }
    }

?>
