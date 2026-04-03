<?php

    define('JSON_PATH', '../json/utilisateurs.json');


    function getUserData () : array {
        // Returns all profiles

        if (!file_exists(JSON_PATH)) {
            $file = fopen(JSON_PATH, 'w');
            fclose($file);
        }

        $data = json_decode(file_get_contents(JSON_PATH), true);
        if (!$data) {
            return array();
        }
        return $data;
    }


    function writeNewUser (array $newUser) : bool {
        // Writes the new user's data, returns true if done successfully

        $data = getUserData();

        $profile = getUserProfile($newUser['email']);
        if ($profile) {
            return false;
        }

        $newUser['id'] = count($data);
        $data[] = $newUser;
        file_put_contents(JSON_PATH, json_encode($data, JSON_PRETTY_PRINT));
        return true;
    }


    function getUserProfile (String $email) : array {
        // Returns the profile corresponding to the given email, returns an empty array if not found

        $data = getUserData();
        foreach ($data as $profile) {
            if ($profile['email'] == $email) {
                return $profile;
            }
        }

        return array();
    }


    function logIn (array $profile) : void {
        // Loads some of the profile data into the current session

        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $profile['name'];
        $_SESSION['email'] = $profile['email'];
        $_SESSION['status'] = $profile['status'];
    }

    function logOut () : void {
        // Removes user info from the session

        $_SESSION['logged_in'] = false;
        unset($_SESSION['name']);
        unset($_SESSION['status']);
        unset($_SESSION['email']);
    }

?>