


function countLength () {
    /* */
    const MAX = 250;

    let input = document.getElementById('text');
    let length = input.value.length;

    if (length > MAX) {
        input.value = input.value.slice(0, MAX - 1);
    }

    let countDiv = document.getElementById('count');
    countDiv.innerHTML = MAX - length + '/' + MAX;

}