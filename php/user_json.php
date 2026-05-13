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


    function writeNewUser (array $newUser) : int {
        // Writes the new user's data, the id of the user

        $data = getUserData();

        $profile = getUserFromEmail($newUser['email']);
        if ($profile) {
            return -1;
        }

        $newUser['id'] = count($data);
        $newUser['creation_date'] = time();
        $data[] = $newUser;
        file_put_contents(USER_JSON_PATH, json_encode($data, JSON_PRETTY_PRINT));
        return $newUser['id'];
    }


    function getUserProfile (int $id) : array {
        // Returns the profile corresponding to the given id, returns an empty array if not found

        $data = getUserData();
        foreach ($data as $profile) {
            if ($profile['id'] == $id) {
                return $profile;
            }
        }

        return array();
    }

    function getUserFromEmail (String $email) : array {
        // Returns the profile corresponding to the given id, returns an empty array if not found

        $data = getUserData();
        foreach ($data as $profile) {
            if ($profile['email'] == $email) {
                return $profile;
            }
        }

        return array();
    }


    function updateUser (array $new_info) : bool {
        // Updates the user's information, returns true if it was successful. $new_info must contain the id.

        $data = getUserData();

        $found = false;
        foreach ($data as $index => $profile) {
            if ($profile['id'] == $new_info['id']) {
                $data[$index] = array_merge($profile, $new_info);
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


    function getAddress (String $address, String $code, String $city) {
        // Formats the address
        return $address.', '.$code.' '.$city;
    }


    function logIn (array $profile) : void {
        // Loads some of the profile data into the current session

        $_SESSION['logged_in'] = true;
        $profile['last_login'] = time();
        updateUser($profile);

        $_SESSION['name'] = $profile['name'];
        $_SESSION['email'] = $profile['email'];
        $_SESSION['status'] = $profile['status'];
        $_SESSION['user_id'] = $profile['id'];

        $_SESSION['address'] = $profile['address'];
        $_SESSION['code'] = intval($profile['code']);
        $_SESSION['city'] = $profile['city'];

        $_SESSION['panier'] = array();
    }

    function logOut () : void {
        // Removes user info from the session

        $_SESSION['logged_in'] = false;
        unset($_SESSION['name']);
        unset($_SESSION['status']);
        unset($_SESSION['email']);
        unset($_SESSION['user_id']);

        unset($_SESSION['address']);
        unset($_SESSION['code']);
        unset($_SESSION['city']);

        unset($_SESSION['panier']);

        if (isset($_SESSION['in_charge'])) {
            unset($_SESSION['in_charge']);
        }
    }

?>