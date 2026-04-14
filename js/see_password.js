


function seePassword () {
    /* Toggles the password input from password to text */
    const TYPES = ['password', 'text'];
    let input = document.getElementById('password');
    input.type = TYPES[(TYPES.indexOf(input.type) + 1) % 2];
}
