


async function cancelOrder (id) {
    /* Cancels the given order and displays a message to indicate if it was a success */

    const response = await fetch(getDomain() + '/php/cancel_order.php?order=' + id);
    if (!response.ok) {
        document.getElementById('error_message').innerHTML = 'Une erreur est survenue';
        return;
    }

    const message = await response.text();
    document.getElementById('error_message').innerHTML = message;

}