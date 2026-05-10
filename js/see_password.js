


function seePassword () {
    /* Toggles the password input from password to text */
    const TYPES = ['password', 'text'];
    let input = document.getElementById('password');
    console.log('current type:' + input.type);
    switch (input.type){
        case 'password':
            input.type=TYPES[1];
            break;

        case 'text':
            input.type=TYPES[0];
            break;
    }
    //input.type = TYPES[!TYPES.indexOf(input.type)];   for some reason, doesn't work alone, but reverts the action of the switch case when paired with it
    console.log('type after change:' + input.type);
}
