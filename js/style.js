import {createCookie, getCookie} from 'cookie.js';


function toggleStyle () {
    /* Toggles between the two styles and updates the cookie */

    let styleTag = document.getElementById('style');

    let currentStyle = getCookie('cookie');
    let newStyle = (currentStyle == 'style') ? 'style' : 'style2';

    createCookie('style', newStyle);
    styleTag.href = '../css/' + newStyle + '.css';
}