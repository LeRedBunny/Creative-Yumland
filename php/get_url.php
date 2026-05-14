<?php

    function getDomain () : String {
        /* Returns the domain (so something like "http://localhost:8000/Creative-Yumland") */

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')  {
            $url = "https";
        } else {
            $url = "http";
        }

        $url .= '://';
        $url .= $_SERVER['HTTP_HOST'];

        $path = explode('/', $_SERVER['PHP_SELF']);
        $url .= implode('/', array_slice($path, 0, count($path) - 2));

        return $url;
    }

?>