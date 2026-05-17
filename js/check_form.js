

function getChildren (tag) {
    /* Recursively gets all children tags of the tag */
    let children = Array.from(tag.children);
    children.forEach(child => {
        getChildren(child).forEach(grandchild => {
            children.push(grandchild);
        })
    })
    return children;
}

function checkForm (id) {
    /* Checks every input of the form to see if it can be sent */

    const form = document.getElementById(id);
    if (form.tagName != 'FORM') {
        console.log('check_form needs <FORM> id, given <' + form.tagName + '> instead');
        return;
    }

    let message = '';

    // Look through every input in the form and check its contents depending on the type
    getChildren(form).forEach(tag => {
        
        if (tag.tagName == 'INPUT') {

            switch (tag.type) {
            
                case 'password' :
                    const password = tag.value;
                    if (!password || password.length < 8) {
                        message += '- Le mot de passe doit faire 8 caractères ou plus.<br>';
                    }
                    break;
                
                case 'email' :
                    const email = tag.value;
                    if (!email || !email.includes("@") || !email.includes(".")) {
                        message += '- Veuillez entrer un email valide<br>';
                    }
                    break;
                
                case 'tel' :
                    const tel = tag.value;
                    if (!tel.startsWith('0') || isNaN(tel) || tel.length != 10) {
                        message += '- Veuillez entrer un numéro de téléphone valide<br>';
                    }
                    break;
                
                case 'number' :
                    const code = tag.value;
                    if (code.length != 5 || isNaN(code)) {
                        message += '- Veuillez entrer un code postal valide <br>'
                        // Ce système exclut certains endroits tels que la Corse, mais je pense pas qu'on livre là bas de toutes façons
                    }
                    break;

            }
        }
    });

    if (message !== '') {
        let errorMessage = document.getElementById('error_message');
        errorMessage.innerHTML = message;
    } else {
        form.submit();
    }
}