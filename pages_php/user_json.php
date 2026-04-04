<?php

    define('USER_JSON_PATH', '../json/utilisateurs.json');


    function getUserData () : array {
        // Returns all profiles

        if (!file_exists(USER_JSON_PATH)) {
            $file = fopen(USER_JSON_PATH, 'w');
            fclose($file);
        }

        $data = json_decode(file_get_contents(USER_JSON_PATH), true);
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
        file_put_contents(USER_JSON_PATH, json_encode($data, JSON_PRETTY_PRINT));
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


    function deleteUser (String $email) : bool {
        // Deletes the user's profile, returns true if it was successful
        
        $data = getUserData();

        $found = false;
        foreach($data as $index => $user) {
            if ($user['email'] == $email) {
                unset($data[$index]);
                $found = true;
                break;
            }
        }

        if (!$found) {
            return false;
        }

        file_put_contents(USER_JSON_PATH, json_encode($data, JSON_PRETTY_PRINT));
        return true;
    }


    function updateUser (array $new_info) : bool {
        // Updates the user's information, returns true if it was successful

        $profile = getUserProfile($new_info['email']);
        if (empty($profile)) {
            return false;
        }

        $profile = array_merge($profile, $new_info);

        deleteUser($profile['email']);
        $success = writeNewUser($profile);
        return $success;
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
        if (isset($_SESSION['in_charge'])) {
            unset($_SESSION['in_charge']);
        }
    }

?>