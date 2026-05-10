<?php

    define('USER_JSON_PATH', '../json/utilisateurs.json');


    function getUserData () : array {
        // Returns all profiles

        if (!file_exists(USER_JSON_PATH)) { //morceau de code inutile?
            $file = fopen(USER_JSON_PATH, 'w');
            fclose($file);
        }

        $data = json_decode(file_get_contents(USER_JSON_PATH), true);//récupération du json traduit
        if (!$data) {   //si problème, renvoie un tableau vide
            return array();
        }
        return $data;   //retourne les données du json
    }


    function writeNewUser (array $newUser) : int {
        // Writes the new user's data, the id of the user

        $data = getUserData();  //get the json containing everything

        $profile = getUserFromEmail($newUser['email']); //return the user with that e-mail, or none if it doesn't exist yet
        if ($profile) { //if the user already exists, return error number
            return -1;
        }

        $newUser['id'] = count($data);  //get ID equal to the amount of data already stored (might cause bugs if users can be deleted)
        $newUser['creation_date'] = time(); //self-explanatory
        $data[] = $newUser;     //write all the data contained within the parameter array into the json, at the last position
        file_put_contents(USER_JSON_PATH, json_encode($data, JSON_PRETTY_PRINT));   //put back all the data into the json
        return $newUser['id'];  //return the ID of the new user, to serve as success code
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
            if ($profile['id'] == $new_info['id']) {//if the user is within the database, their data are merged with the old ones
                $data[$index] = array_merge($profile, $new_info);  
                $found = true;
                break;
            }
        }

        if (!$found) {  //the user is not within the database, then no updates can be done
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