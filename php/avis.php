<?php

    function score (array $review) : int {
        /* Assigns a score to a review, used to sort them */
        return intval($review['rating'] ** 3 * $review['size'] * $review['date'] / 3e7);
    }

    function choice (array $reviews) : int {
        /* Returns a randomly chosen review, with each review weighted by its score */

        $weighted_reviews = array();

        foreach($reviews as $review) {
            for ($i = 0; $i < score($review); i++) {
                $weighted_reviews[] = $review;
            }
        }

        return $weighted_reviews[random_int(0, $total_weight)];
    }

    require('avis_json.php');

    $reviews = getReviews();
    $reviews_to_send = array();

    $SEND = 3;
    for ($i = 0; $i < $SEND; $i++) {
        $review = choice($reviews);
        array_splice($reviews, array_search($reviews, $review), 1);
        $reviews_to_send[] = $review;
    }

    echo json_encode($reviews_to_send);

?>