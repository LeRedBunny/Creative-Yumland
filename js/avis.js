

function score (review) {
    /* Assigns a score to a review, used to sort them */
    return review['rating'] ** 3 * review['size'] * review['date'] / 3000000;
}


function getReviewHTML (review) {
    /* Returns the HTML to display the review */
    let html = '<br> <div> ' + review['firstname'] + ' - ';
    html += '★'.repeat(review['rating']) + '<br>';
    html += '<i> "' + review['text'] + '" <i>';
    html += '</div>' + new Date(review['creation_date'] * 1000).toUTCString() + '<br> <br>';
    return html;
}


async function getReviews () {
    /* Returns an array of all the reviews */

    const response = await fetch(getDomain() + '/php/avis.php');

    if (!response.ok) {
        throw new Error("Could not fetch reviews.");
    }

    const data = await response.json();
    

    let box = document.getElementById('review_box');
    box.innerHTML = '';
    data.forEach(review => {
        let html = getReviewHTML(review);
        console.log(html);
        box.innerHTML += html;
    });
}
