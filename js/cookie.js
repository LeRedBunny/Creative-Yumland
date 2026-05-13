

function setCookie (name, value, lifespan=3600*24) {
    /* Creates a cookie with the given name, value and lifespan in seconds*/

    let date = new Date();
    date.setTime(date.getTime() + lifespan * 1000);

    document.cookie = name + '=' + value + '; expires=' + date.toUTCString() + ';';
}


function getCookie (name) {
    /* Returns the value of the cookie, returns null if not found */

    const cookies = document.cookie.split(';');
    let row = cookies.find((row) => row.trim().startsWith(name + '='));

    if (row == null) {
        return null;
    }

    return row.split('=')[1];
}

