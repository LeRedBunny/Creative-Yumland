
function toggleStyle () {
    /* Toggles between the two styles and updates the cookie */

    let styleTag = document.getElementById('style');

    let currentStyle = getCookie('style');
    let newStyle = (currentStyle == 'style') ? 'style2' : 'style';

    setCookie('style', newStyle);
    styleTag.href = '../css/' + newStyle + '.css';
}