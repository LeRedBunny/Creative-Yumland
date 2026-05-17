<?php

    // function score (array $review) : int {
    //     /* Assigns a score to a review, used to sort them */
    //     return intval($review['rating'] ** 3 * strlen($review['text']) * $review['creation_date'] / 1e7);
    // }

    // function choice (array $reviews) : array {
    //     /* Returns a randomly chosen review, with each review weighted by its score */


    //     // Creates an array with copies of each review depending on the score, then returns a random element of that array
    //     $weighted_reviews = array();
    //     $total_weight = 0;

    //     foreach($reviews as $review) {

    //         $score = score($review);

    //         for ($i = 0; $i < $score; $i++) {
    //             $weighted_reviews[$total_weight + $i] = $review;
    //         }
            
    //         $total_weight += $score;
    //     }

    //     return $weighted_reviews[random_int(0, $total_weight - 1)];
    // }


    function compare (array $review1, array $review2) : bool {
        /* Returns the most recent */
        return $review1['creation_date'] <= $review2['creation_date'];
    } 


    
    
    //  Script

    require('avis_json.php');
    require('user_json.php');

    $reviews = getReviews();
    foreach($reviews as $key => $review) {
        $user = getUserProfile($review['user_id']);
        $reviews[$key] = array_merge($review, $user);
    }

    // $reviews_to_send = array();

    // // How many reviews will be displayed at once
    // $SEND = 3;

    // for ($i = 0; $i < $SEND; $i++) {
    //     $review = choice($reviews);
    //     array_splice($reviews, array_search($reviews, $review), 1);
    //     $reviews_to_send[] = $review;
    // }

    // echo json_encode($reviews_to_send);

    usort($reviews, 'compare');
    echo json_encode(array_slice($reviews, 0, min(3, count($reviews))));

?>