<?php


    function compare (array $review1, array $review2) : bool {
        /* Returns the most recent review of the two */
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

    usort($reviews, 'compare');
    echo json_encode(array_slice($reviews, 0, min(3, count($reviews))));

?>
