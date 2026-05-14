
function getDomain () {
    /* Returns the domain (so something like "http://localhost:8000/Creative-Yumland") */
    const url = window.location.href;
    return url.split('/').slice(0, -2).join('/'); 
}
