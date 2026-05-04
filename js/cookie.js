

function createCookie (name, value, lifespan=3600*24) {
    /* Creates a cookie with the given name, value and lifespan */

    let date = new Date();
    date.setTime(date.getTime() + lifespan);

    document.cookie = name + '=' + value + ';' + date.toUTCString();
}


function getCookie (name) {
    /* Returns the value of the cookie, returns null if not found */

    let string = document.cookie;

    let cookies = string.split(';');
    cookies.forEach(cookie => {
        
        if (cookie_name == cookie.split(';')[0]) {
            return cookie.split(';')[1];
        }

    });

    return null;
}