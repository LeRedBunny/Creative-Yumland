<?php

    define('REVIEW_JSON_PATH', '../json/avis.json');


    function getReviews () : array {
        /* Returns an array of every review */

        if (!file_exists(REVIEW_JSON_PATH)) {
            $file = fopen(REVIEW_JSON_PATH, 'w');
            fclose($file);
        }

        $data = json_decode(file_get_contents(REVIEW_JSON_PATH), true);
        if (!$data) {
            return array();
        }
        return $data;
    }


    function writeReview (int $order_id, int $user_id, int $rating, String $text) : void {
        /* Writes the review in the json */

        $review = array();
        $review['order_id'] = $order_id;
        $review['user_id'] = $user_id;
        $review['rating'] = $rating;
        $review['text'] = $text;
        $review['creation_date'] = time();

        $reviews = getReviews();
        $reviews[] = $review;
        file_put_contents(REVIEW_JSON_PATH, json_encode($reviews, JSON_PRETTY_PRINT));
    }


    function getReview (int $order_id) : array {
        /* Returns the review associated with the given order, returns an empty array if not found */

        $reviews = getReviews();

        foreach($reviews as $review) {
            if ($review['order_id'] == $order_id) {
                return $review;
            }
        }

        return array();
    }



?>