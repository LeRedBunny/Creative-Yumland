<?php

    define('JSON_PATH', '../json/utilisateurs.json');


    function getUserData () : array {
        // Returns all profiles

        if (!file_exists(JSON_PATH)) {
            echo "creating json file!";
            $file = fopen(JSON_PATH, 'w');
            fclose($file);
            return array();
        }

        return json_decode(file_get_contents(JSON_PATH), true);
    }


    function writeNewUser (array $newUser) : bool {
        // Writes the new user's data, returns true if done successfully

        $data = getUserData();

        $profile = getUserProfile($newUser['email']);
        if (isset($profile)) {
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


    function loadProfileIntoSession (array $profile) : void {
        // Loads some of the profile data into the current session

        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $profile['name'];
    }

?>