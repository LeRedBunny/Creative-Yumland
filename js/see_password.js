


function seePassword () {
    /* Toggles the password input from password to text */
    const TYPES = ['password', 'text'];
    let input = document.getElementById('password');
    input.type = TYPES[(1 + TYPES.indexOf(input.type)) % 2];
}
