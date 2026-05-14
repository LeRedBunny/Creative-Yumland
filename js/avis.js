

function score (review) {
    /* Assigns a score to a review, used to sort them */
    return review['rating'] ** 3 * review['size'] * review['date'] / 3000000;
}


function getReviewHTML (review, user) {
    /* Returns the HTML to display the review */
    return '<div> ' + user['firstname'] + '★'.repeat(review['rating']) + '<br> <div> ' + review['text'] + ' </div> </div>';
}


async function getReviews () {
    /* Returns an array of all the reviews */

    const response = await fetch(getDomain() + '/php/avis.php');

    if (!response.ok) {
        throw new Error("Could not fetch reviews.");
    }

    let data = await response.json();
    return data;
}